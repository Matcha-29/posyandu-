<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * 3.0 Kelola Data Akun (DFD Level 1: 3.1 + 3.2)
 * Hanya bisa diakses Admin.
 */
class AkunController extends Controller
{
    // 3.1 — daftar semua akun
    public function index(Request $request)
    {
        $users = User::when($request->filled('role'), fn($q) =>
                    $q->where('role', $request->role)
                  )
                  ->when($request->filled('search'), fn($q) =>
                    $q->where('name', 'like', '%'.$request->search.'%')
                      ->orWhere('email', 'like', '%'.$request->search.'%')
                  )
                  ->latest()
                  ->get();

        if ($request->wantsJson()) {
            return response()->json($users);
        }
        return view('admin.data_akun', compact('users'));
    }

    // 3.2 — simpan akun baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6|confirmed',
            'role'      => 'required|in:admin,petugas',
            'is_active' => 'boolean',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        if ($request->wantsJson()) {
            return response()->json($user, 201);
        }
        return redirect('/data_akun')->with('success', 'Akun berhasil dibuat.');
    }

    // 3.2 — perbarui akun
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'      => 'sometimes|required|string|max:100',
            'email'     => 'sometimes|required|email|unique:users,email,'.$user->id,
            'password'  => 'nullable|string|min:6|confirmed',
            'role'      => 'sometimes|required|in:admin,petugas',
            'is_active' => 'boolean',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        if ($request->wantsJson()) {
            return response()->json($user);
        }
        return redirect('/data_akun')->with('success', 'Akun berhasil diperbarui.');
    }

    // Hapus akun
    public function destroy(User $user)
    {
        $user->delete();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Akun dihapus.']);
        }
        return redirect('/data_akun')->with('success', 'Akun dihapus.');
    }
}
