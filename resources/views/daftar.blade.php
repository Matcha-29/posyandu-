<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>POSYANDU - Daftar</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  :root {
    --teal: #0E766D;
    --green: #0A5C52;
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
    max-width: 620px;
    margin: 20px auto 40px;
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
    margin: 0 auto 10px;
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
    margin-bottom: 8px;
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
    color: var(--black);
    font-size: 1rem;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
  }
  .input-wrap input::placeholder { color: #aab7b2; }
  .input-wrap input:focus {
    border-color: var(--teal);
    box-shadow: 0 0 0 5px rgba(14,118,109,.08);
  }
  .forgot-wrap {
    text-align: left;
    margin-top: 4px;
  }
  .forgot-wrap a {
    color: var(--teal);
    text-decoration: none;
    font-weight: 700;
    font-size: 0.92rem;
  }
  .submit-wrap {
    display: flex;
    justify-content: center;
    margin-top: 16px;
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
  .btn-login:hover { transform: translateY(-2px); box-shadow: 0 22px 40px rgba(0,0,128,.24); }
  .bottom-note {
    text-align: center;
    margin-top: 18px;
    font-size: 0.92rem;
    color: var(--mute);
  }
  .bottom-note a {
    color: var(--teal);
    text-decoration: none;
    font-weight: 700;
  }
  .footer {
    width: 100%;
    background: var(--teal);
    color: var(--white);
    padding: 40px 24px 30px;
  }
  .footer-grid {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.2fr 1fr 1fr 1fr;
    gap: 24px;
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
    gap: 12px;
  }
  .news-input {
    width: 100%;
    padding: 14px 16px;
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,.25);
    background: rgba(255,255,255,.12);
    color: #fff;
    outline: none;
  }
  .news-input::placeholder { color: rgba(255,255,255,.75); }
  .news-submit {
    width: 46px;
    height: 46px;
    border: none;
    border-radius: 50%;
    background: #fff;
    color: var(--teal);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
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
      <div class="form-inner">
        <div class="field">
          <label for="username">Masukan Email</label>
          <div class="input-wrap">
            <input type="email" id="username" placeholder="Email" autocomplete="username" />
          </div>
        </div>
        <div class="field">
          <label for="password">Masukan Password</label>
          <div class="input-wrap">
            <input type="password" id="password" placeholder="Password" autocomplete="current-password" />
          </div>
        </div>
        <div class="submit-wrap">
          <button class="btn-login" id="daftarBtn" type="button">DAFTAR</button>
        </div>
        <div class="bottom-note">Sudah punya akun? <a href="/login">Masuk</a></div>
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
        <input class="news-input" type="email" placeholder="Enter your email address" />
        <button class="news-submit" aria-label="Subscribe"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path d="M2.5 3.5L10 10l7.5-6.5M10 10v6.5" stroke="#0E766D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
      </div>
    </div>
    <div class="footer-bottom">© 2021 Posyandu</div>
  </div>  <script>
    document.getElementById('daftarBtn').addEventListener('click', () => {
      const email = document.getElementById('username').value.trim();
      const password = document.getElementById('password').value.trim();
      
      if (!email || !password) {
        alert('Email dan password wajib diisi.');
        return;
      }
      
      const users = JSON.parse(localStorage.getItem('users') || '[]');
      const existingUser = users.find(u => u.email === email);
      
      if (existingUser) {
        alert('Email sudah terdaftar. Silakan login.');
        window.location.href = '/login';
        return;
      }
      
      users.push({ email, password });
      localStorage.setItem('users', JSON.stringify(users));
      
      alert('Pendaftaran berhasil! Silakan login.');
      window.location.href = '/login';
    });
  </script></body>
</html>