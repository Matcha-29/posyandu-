<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect('/dashboard');
            }
            return redirect('/list_data_pasien');
        }
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        $user = Auth::user();

        if (!$user->is_active) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun Anda tidak aktif. Hubungi administrator.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        if ($user->role === 'admin') {
            return redirect('/dashboard');
        }

        return redirect('/list_data_pasien');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Kirim kode verifikasi reset password
    public function sendResetCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->email;

        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Email tidak terdaftar.'], 404);
        }

        // Generate 6-digit code
        $code = rand(100000, 900000);

        // Auto-create table if it doesn't exist (safety fallback)
        if (!\Illuminate\Support\Facades\Schema::hasTable('password_reset_tokens')) {
            \Illuminate\Support\Facades\Schema::create('password_reset_tokens', function ($table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }

        // Save token to password_reset_tokens
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => $code, 'created_at' => now()]
        );

        // Send Email
        try {
            \Mail::send([], [], function ($message) use ($email, $code) {
                $message->to($email)
                    ->subject('Kode Reset Password - POSYANDU')
                    ->html('
                        <div style="font-family: \'Plus Jakarta Sans\', sans-serif; max-width: 500px; margin: 0 auto; padding: 20px; border: 1px solid #e0ebe9; border-radius: 12px; background-color: #fafcfb;">
                            <div style="text-align: center; margin-bottom: 20px;">
                                <h2 style="color: #0E766D; margin: 0; font-size: 24px; font-weight: 800; letter-spacing: -0.5px;">POSYANDU</h2>
                                <p style="color: #7a9e93; margin: 5px 0 0 0; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">Dekat Balita, Dekat Ibu, Dekat Kita</p>
                            </div>
                            <div style="background-color: #ffffff; padding: 24px; border-radius: 8px; border: 1px solid #c8dbd8; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                                <h3 style="color: #000080; margin-top: 0; font-size: 16px; font-weight: 700;">Halo,</h3>
                                <p style="color: #1a1a1a; font-size: 14px; line-height: 1.6; margin-bottom: 20px;">Anda menerima email ini karena ada permintaan untuk mereset password akun Anda di sistem POSYANDU.</p>
                                <div style="background-color: #e8f5f4; border: 1.5px dashed #0E766D; padding: 16px; text-align: center; border-radius: 8px; margin-bottom: 20px;">
                                    <span style="display: block; font-size: 10px; font-weight: 800; color: #0E766D; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px;">KODE VERIFIKASI ANDA</span>
                                    <span style="font-size: 32px; font-weight: 800; color: #000080; letter-spacing: 6px;">' . $code . '</span>
                                </div>
                                <p style="color: #888; font-size: 11px; line-height: 1.5; margin: 0;">Kode verifikasi ini hanya berlaku selama 15 menit. Jika Anda tidak merasa melakukan permintaan ini, abaikan saja email ini.</p>
                            </div>
                        </div>
                    ');
            });
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal mengirim email: ' . $e->getMessage()], 500);
        }

        return response()->json(['status' => 'success']);
    }

    // Verifikasi kode reset password
    public function verifyResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code'  => 'required|string|size:6'
        ]);

        $record = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$record || $record->token !== $request->code) {
            return response()->json(['status' => 'error', 'message' => 'Kode verifikasi salah.'], 400);
        }

        // Check expiry (15 minutes)
        if (strtotime($record->created_at) < strtotime('-15 minutes')) {
            return response()->json(['status' => 'error', 'message' => 'Kode verifikasi sudah kedaluwarsa.'], 400);
        }

        // Save progress to session securely
        session([
            'reset_email'    => $request->email,
            'reset_verified' => true
        ]);

        return response()->json(['status' => 'success']);
    }

    // Reset password ke yang baru
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed'
        ]);

        $email = session('reset_email');
        $verified = session('reset_verified');

        if (!$email || !$verified) {
            return response()->json(['status' => 'error', 'message' => 'Sesi reset password tidak valid atau kedaluwarsa.'], 400);
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User tidak ditemukan.'], 404);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Clean up token & session
        \DB::table('password_reset_tokens')->where('email', $email)->delete();
        session()->forget(['reset_email', 'reset_verified']);

        return response()->json(['status' => 'success']);
    }
}
