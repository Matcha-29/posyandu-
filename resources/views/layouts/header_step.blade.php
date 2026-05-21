<div class="topbar" style="width: 100%; height: 80px; background: #0E766D; display: flex; align-items: center; justify-content: space-between; padding: 0 40px; box-shadow: 0 2px 12px rgba(0,0,0,0.12);">
  <!-- Left Side: Logo -->
  <div style="display: flex; align-items: center;">
    <img src="{{ asset('image/logo.png') }}" style="height: 64px; width: auto;" alt="Logo POSYANDU" />
  </div>
  <!-- Right Side: Profile -->
  <div style="display: flex; align-items: center; gap: 12px;">
    <div style="text-align: right; color: white;">
      <p style="font-size: 14px; font-weight: 700; line-height: 1; margin: 0;">{{ Auth::user()->name }}</p>
      <p style="font-size: 11px; opacity: 0.8; text-transform: uppercase; letter-spacing: 1px; margin: 4px 0 0 0;">{{ Auth::user()->role }}</p>
    </div>
    <img style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #e8f5f4; box-shadow: 0 1px 3px rgba(0,0,0,0.1);" src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=80&h=80&q=80' }}" alt="Petugas" />
  </div>
</div>
