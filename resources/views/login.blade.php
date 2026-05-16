<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>POSYANDU - Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --teal: #0E766D;
      --navy: #0B1760;
      --white: #ffffff;
      --bg: #f6fbfb;
      --surface: #f2f6f5;
      --border: #d9e7e4;
      --text: #1c1c1c;
      --mute: #556c6a;
    }
    html, body {
      width: 100%;
      min-height: 100%;
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
    }
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .top-bar {
      width: 100%;
      height: 80px;
      background: var(--teal);
      flex-shrink: 0;
      display: flex;
      align-items: center;
      padding: 0 40px;
    }
    .page-content {
      width: 100%;
      max-width: 520px;
      margin: 40px auto 40px;
      padding: 0 20px;
      display: flex;
      justify-content: center;
    }
    .card {
      width: 100%;
      background: transparent;
      border-radius: 0;
      box-shadow: none;
      padding: 0;
      position: relative;
    }
    .logo-wrap {
      width: 140px;
      height: 140px;
      border-radius: 24px;
      background: transparent;
      display: flex;
      align-items: center;
      justify-content: center;
      position: static;
      transform: none;
      box-shadow: none;
      margin: 20px auto 10px;
    }
    .logo-wrap img {
      width: 140px;
      height: auto;
      object-fit: contain;
    }
    .form-inner {
      margin-top: 0;
      display: flex;
      flex-direction: column;
      gap: 18px;
    }
    .field label {
      display: block;
      margin-bottom: 10px;
      font-size: 0.95rem;
      font-weight: 700;
      color: var(--text);
    }
    .input-wrap {
      position: relative;
    }
    .input-wrap input {
      width: 100%;
      padding: 18px 20px;
      border-radius: 42px;
      border: 2px solid var(--border);
      background: var(--surface);
      color: var(--text);
      font-size: 1rem;
      outline: none;
      transition: border-color .2s, box-shadow .2s;
    }
    .input-wrap input:focus {
      border-color: var(--teal);
      box-shadow: 0 0 0 5px rgba(14,118,109,.08);
    }
    .input-wrap .eye-btn {
      position: absolute;
      right: 18px;
      top: 50%;
      transform: translateY(-50%);
      border: none;
      background: none;
      cursor: pointer;
      color: var(--mute);
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .input-wrap .eye-btn:hover {
      color: var(--teal);
    }
    .text-link {
      text-align: right;
      margin-top: 6px;
      font-size: 0.92rem;
    }
    .text-link a {
      color: var(--teal);
      text-decoration: none;
      font-weight: 700;
    }
    .bottom-note {
      text-align: center;
      margin-top: 14px;
      font-size: 0.92rem;
      color: var(--mute);
    }
    .bottom-note a {
      color: var(--teal);
      text-decoration: none;
      font-weight: 700;
    }
    .submit-wrap {
      display: flex;
      justify-content: center;
      margin-top: 4px;
    }
    .btn-login {
      width: 220px;
      padding: 16px 0;
      border-radius: 999px;
      background: var(--navy);
      color: var(--white);
      font-size: 0.95rem;
      font-weight: 800;
      border: none;
      cursor: pointer;
      box-shadow: 0 18px 34px rgba(0,0,128,.2);
      transition: transform .15s, box-shadow .2s;
    }
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 22px 40px rgba(0,0,128,.24);
    }
    .footer {
      width: 100%;
      background: var(--teal);
      color: var(--white);
      padding: 40px 24px 30px;
    }
    .footer-grid {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1.5fr 1fr 1fr 1.2fr 1.2fr;
      gap: 32px;
    }
    .footer-partners {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-left: 40px;
    }

    .partners-logos {
      display: flex;
      gap: 20px;
      align-items: center;
    }

    .partners-logos img {
      height: 60px;
      width: auto;
      max-width: 160px;
      object-fit: contain;
      transition: transform 0.3s ease;
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }



    .partners-logos img:hover {
      transform: scale(1.1);
      opacity: 1;
    }
    .footer-deco {
      position: absolute;
      bottom: 0;
      right: 0;
      width: 200px;
      opacity: 0.1;
      pointer-events: none;
    }

    .footer-brand h2 {
      font-size: 1.35rem;
      margin-bottom: 12px;
    }
    .footer-brand p {
      font-size: 0.95rem;
      line-height: 1.8;
      color: rgba(255,255,255,.85);
    }
    .footer-title {
      font-size: 0.95rem;
      font-weight: 700;
      margin-bottom: 14px;
      letter-spacing: .06em;
    }
    .footer-links,
    .footer-contact {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .footer-links a,
    .footer-contact span {
      color: rgba(255,255,255,.9);
      text-decoration: none;
      font-size: 0.92rem;
    }
    .footer-links a:hover { opacity: .8; }
    .newsletter {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    .newsletter p {
      font-size: 0.85rem;
      color: rgba(255,255,255,0.7);
      line-height: 1.5;
      margin-bottom: 5px;
    }
    .news-input {
      flex: 1;
      padding: 16px 20px;
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,.2);
      background: rgba(255,255,255,.08);
      color: #fff;
      font-size: 0.9rem;
      outline: none;
      transition: all 0.3s ease;
    }
    .news-input:focus {
      background: rgba(255,255,255,.15);
      border-color: rgba(255,255,255,0.5);
    }
    .news-submit {
      width: 52px;
      height: 52px;
      border: none;
      border-radius: 12px;
      background: #fff;
      color: var(--teal);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .news-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    .footer-bottom {
      margin-top: 28px;
      border-top: 1px solid rgba(255,255,255,.18);
      padding-top: 18px;
      font-size: 0.88rem;
      text-align: center;
      color: rgba(255,255,255,.75);
    }
    @media (max-width: 920px) {
      .footer-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 680px) {
      .page-content { margin-top: -40px; }
      .card { padding: 26px 22px 24px; }
      .footer-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
  <div class="top-bar"></div>
  <div class="page-content">
    <div class="card">
      <div class="logo-wrap">
        <img src="{{ asset('image/logo.png') }}" alt="Logo POSYANDU" />
      </div>
        <form action="/login" method="POST" class="form-inner">
          @csrf
          <div class="field">
            <label for="email">Masukan Email</label>
            <div class="input-wrap">
              <input type="email" name="email" id="email" placeholder="Email" autocomplete="username" required value="{{ old('email') }}" />
            </div>
            @error('email')
              <div style="color: #e74c3c; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
          </div>
          <div class="field">
            <label for="password">Masukan Password</label>
            <div class="input-wrap">
              <input type="password" name="password" id="password" placeholder="Password" autocomplete="current-password" required />
              <button type="button" class="eye-btn" id="eyeBtn" aria-label="Tampilkan password">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="22" height="22">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.27 2.943 9.542 7-1.272 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
              </button>
            </div>
            @error('password')
              <div style="color: #e74c3c; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
            <div class="text-link"><a href="/forgot-password">Lupa Password?</a></div>
          </div>
          <div class="submit-wrap">
            <button class="btn-login" id="loginBtn" type="submit">LOGIN</button>
          </div>
          <div class="bottom-note">Belum punya akun? <a href="/daftar">Daftar</a></div>
        </form>
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="footer-grid">
      <div class="footer-brand">
        <h2>POSYANDU</h2>
        <p>Leading the Way in Medical Excellence, Trusted Care.</p>
      </div>
      <div class="footer-links">
        <div class="footer-title">Important Links</div>
        <a href="#">Appointment</a>
        <a href="#">Doctors</a>
        <a href="#">Services</a>
        <a href="#">About Us</a>
      </div>
      <div class="footer-contact">
        <div class="footer-title">Contact Us</div>
        <span>Call: (237) 681-812-255</span>
        <span>Email: fidlineoesoe@gmail.com</span>
        <span>Address: 0123 Some place</span>
        <span>Some country</span>
      </div>
      <div class="newsletter">
        <div class="footer-title">Newsletter</div>
        <p>Subscribe to get latest updates and news.</p>
        <div style="display: flex; gap: 10px; align-items: center;">
          <input class="news-input" type="email" placeholder="Email address" />
          <button class="news-submit" aria-label="Subscribe">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
          </button>
        </div>
      </div>
      <div class="footer-partners">
        <div class="footer-title">Supported By</div>
        <div class="partners-logos">
          <img src="{{ asset('image/logo_polije.png') }}" alt="Polije Logo" title="Politeknik Negeri Jember" />
          <img src="{{ asset('image/logo_trkk.png') }}" alt="TRK Logo" title="Teknologi Rekayasa Komputer" />
        </div>
      </div>
    </div>
    <img src="https://www.transparenttextures.com/patterns/cubes.png" class="footer-deco" alt="" />
    <div class="footer-bottom">© 2024 Posyandu - Dedicated to Health & Excellence</div>
  </div>
  <script>
    const eyeBtn = document.getElementById('eyeBtn');
    const passInput = document.getElementById('password');
    let passwordVisible = false;

    eyeBtn.addEventListener('click', () => {
      passwordVisible = !passwordVisible;
      passInput.type = passwordVisible ? 'text' : 'password';
      eyeBtn.innerHTML = passwordVisible
        ? '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0 1 12 19.5c-4.478 0-8.27-2.943-9.542-7a9.956 9.956 0 0 1 2.223-3.268M6.867 6.867A9.953 9.953 0 0 1 12 4.5c4.478 0 8.27 2.943 9.542 7a9.955 9.955 0 0 1-1.259 2.657M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/></svg>'
        : '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.27 2.943 9.542 7-1.272 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>';
    });

  </script>
</body>
</html>
