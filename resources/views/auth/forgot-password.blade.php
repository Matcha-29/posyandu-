<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lupa Password — POSYANDU</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --teal: #0E766D;
            --navy: #000080;
            --white: #ffffff;
            --bg: #eaf2f0;
            --border: #c8dbd8;
            --text: #1a1a1a;
            --muted: #7a9e93;
            --error: #d94f4f;
        }
        html, body {
            width: 100%;
            min-height: 100%;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .header-bar {
            width: 100%;
            height: 80px;
            background: var(--teal);
            flex-shrink: 0;
        }
        .page-wrap {
            width: 100%;
            max-width: 480px;
            padding: 0 24px 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 auto;
        }
        .logo-wrap {
            margin-top: 10px;
            margin-bottom: 28px;
            display: flex;
            justify-content: center;
        }
        .logo-wrap img {
            width: 130px;
            height: 130px;
            object-fit: contain;
        }
        .alert {
            display: none;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: .84rem;
            font-weight: 600;
            margin-bottom: 16px;
            width: 100%;
        }
        .alert.show { display: flex; animation: pop .25s ease; }
        @keyframes pop { from{opacity:0;transform:translateY(-4px)}to{opacity:1} }
        .alert-error   { background:#fff0f0; color:var(--error); border:1px solid #f5c6c6; }
        .alert-success { background:#edfaf5; color:#1a7a4a; border:1px solid #b3e6cc; }
        .pesan-box {
            margin-bottom: 30px;
            width: 100%;
            text-align: left;
        }
        .pesan-label {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 4px;
            display: block;
        }
        .pesan-text {
            color: var(--teal);
            font-size: 1.08rem;
            margin-top: 2px;
            font-weight: 500;
        }
        .field { margin-bottom: 20px; width: 100%; }
        .field label {
            display: block;
            font-size: 1rem;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 8px;
        }
        .input-wrap { position: relative; }
        .input-wrap input {
            width: 100%;
            padding: 14px 18px;
            border: 1.5px solid var(--border);
            border-radius: 50px;
            font-size: .97rem;
            font-family: inherit;
            color: var(--text);
            background: var(--white);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .input-wrap input::placeholder { color: #aac5c1; }
        .input-wrap input:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(14,118,109,.12);
        }
        .btn-wrap { display: flex; justify-content: center; width: 100%; }
        .btn-kirim {
            width: 220px;
            padding: 15px;
            background: var(--navy);
            color: var(--white);
            font-family: inherit;
            font-size: .95rem;
            font-weight: 800;
            letter-spacing: .1em;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: transform .15s, box-shadow .2s;
            box-shadow: 0 6px 20px rgba(0,0,128,.28);
        }
        .btn-kirim:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,0,128,.36); }
        .btn-kirim:active { transform: translateY(0); }
        .btn-kirim:disabled { opacity:.6; cursor:not-allowed; transform:none; }
        .spinner {
            display: none;
            width: 20px; height: 20px;
            border: 2.5px solid rgba(255,255,255,.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
            margin: 0 auto;
        }
        @keyframes spin { to{transform:rotate(360deg)} }
        .btn-kirim.loading .btn-text { display:none; }
        .btn-kirim.loading .spinner  { display:block; }
        .bottom-note {
            margin-top: 18px;
            font-size: 0.92rem;
            color: var(--muted);
        }
        .bottom-note a {
            color: var(--teal);
            text-decoration: none;
            font-weight: 700;
        }
        .verification-section {
            display: none;
            width: 100%;
            margin-top: 20px;
        }
        .verification-section.show { display: block; }
        .field-code { margin-bottom: 20px; width: 100%; }
        .field-code label {
            display: block;
            font-size: 1rem;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 8px;
        }
        .input-wrap-code { position: relative; }
        .input-wrap-code input {
            width: 100%;
            padding: 14px 18px;
            border: 1.5px solid var(--border);
            border-radius: 50px;
            font-size: .97rem;
            font-family: inherit;
            color: var(--text);
            background: var(--white);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .input-wrap-code input:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(14,118,109,.12);
        }
        .btn-wrap { display: flex; justify-content: center; width: 100%; gap: 12px; }
        .btn-verify {
            width: 120px;
            padding: 15px;
            background: var(--navy);
            color: var(--white);
            font-family: inherit;
            font-size: .95rem;
            font-weight: 800;
            letter-spacing: .1em;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: transform .15s, box-shadow .2s;
            box-shadow: 0 6px 20px rgba(0,0,128,.28);
        }
        .btn-verify:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,0,128,.36); }
        .btn-verify:disabled { opacity:.6; cursor:not-allowed; transform:none; }
        .btn-back {
            width: 120px;
            padding: 15px;
            background: var(--muted);
            color: var(--white);
            font-family: inherit;
            font-size: .95rem;
            font-weight: 800;
            letter-spacing: .1em;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: background .2s;
        }
        .btn-back:hover { background: #888; }
        .reset-section {
            display: none;
            width: 100%;
            margin-top: 20px;
        }
        .reset-section.show { display: block; }
        .field-reset { margin-bottom: 20px; width: 100%; }
        .field-reset label {
            display: block;
            font-size: 1rem;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 8px;
        }
        .btn-reset {
            width: 220px;
            padding: 15px;
            background: var(--navy);
            color: var(--white);
            font-family: inherit;
            font-size: .95rem;
            font-weight: 800;
            letter-spacing: .1em;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: transform .15s, box-shadow .2s;
            box-shadow: 0 6px 20px rgba(0,0,128,.28);
        }
        .btn-reset:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,0,128,.36); }
    </style>
</head>
<body>
<div class="header-bar"></div>
<div class="page-wrap">
    <div class="logo-wrap">
        <img src="{{ asset('image/logo.png') }}" alt="Logo POSYANDU" />
    </div>
    <div class="pesan-box">
        <span class="pesan-label">Pesan</span>
        <span class="pesan-text">Masukan email anda dan tunggu kode etik akan dikirimkan</span>
    </div>
    <div class="alert" id="alertBox">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </svg>
        <span id="alertMsg"></span>
    </div>
    <form id="forgotForm" novalidate style="width:100%">
        <div class="field">
            <label for="email">Masukan Email</label>
            <div class="input-wrap">
                <input type="email" id="email" placeholder="Email" autocomplete="email" />
            </div>
        </div>
        <div class="btn-wrap">
            <button type="submit" class="btn-kirim" id="kirimBtn">
                <span class="btn-text">KIRIM</span>
                <div class="spinner"></div>
            </button>
        </div>
    </form>
    
    <div class="verification-section" id="verificationSection">
        <div class="field-code">
            <label for="verificationCode">Masukan Kode Verifikasi</label>
            <div class="input-wrap-code">
                <input type="text" id="verificationCode" placeholder="Kode Verifikasi" />
            </div>
        </div>
        <div class="btn-wrap">
            <button type="button" class="btn-verify" id="verifyBtn">VERIFIKASI</button>
            <button type="button" class="btn-back" id="backBtn">KEMBALI</button>
        </div>
    </div>
    
    <div class="reset-section" id="resetSection">
        <div class="field-reset">
            <label for="newPassword">Password Baru</label>
            <div class="input-wrap">
                <input type="password" id="newPassword" placeholder="Password Baru" />
            </div>
        </div>
        <div class="field-reset">
            <label for="confirmPassword">Konfirmasi Password</label>
            <div class="input-wrap">
                <input type="password" id="confirmPassword" placeholder="Konfirmasi Password" />
            </div>
        </div>
        <div class="btn-wrap">
            <button type="button" class="btn-reset" id="resetBtn">UBAH PASSWORD</button>
        </div>
    </div>
    
    <div class="bottom-note">Ingat password? <a href="/login">Masuk</a></div>
</div>
<script>
    const form = document.getElementById('forgotForm');
    const kirimBtn = document.getElementById('kirimBtn');
    const alertBox = document.getElementById('alertBox');
    const alertMsg = document.getElementById('alertMsg');
    const verificationSection = document.getElementById('verificationSection');
    const resetSection = document.getElementById('resetSection');
    const verifyBtn = document.getElementById('verifyBtn');
    const backBtn = document.getElementById('backBtn');
    const resetBtn = document.getElementById('resetBtn');

    let verificationCode = '';
    let resetEmail = '';

    function showAlert(msg, type) {
        alertBox.className = 'alert show alert-' + type;
        alertMsg.textContent = msg;
    }

    function hideAlert() {
        alertBox.className = 'alert';
    }

    form.addEventListener('submit', e => {
        e.preventDefault();
        hideAlert();
        const email = document.getElementById('email').value.trim();
        if (!email) { showAlert('Email wajib diisi.', 'error'); return; }
        
        const users = JSON.parse(localStorage.getItem('users') || '[]');
        const user = users.find(u => u.email === email);
        if (!user) { showAlert('Email tidak terdaftar.', 'error'); return; }
        
        resetEmail = email;
        verificationCode = Math.floor(100000 + Math.random() * 900000).toString(); // Generate 6-digit code
        
        kirimBtn.classList.add('loading');
        kirimBtn.disabled = true;
        setTimeout(() => {
            kirimBtn.classList.remove('loading');
            kirimBtn.disabled = false;
            alert('Kode verifikasi: ' + verificationCode + ' (Simulasi - kode ini muncul di alert)');
            form.style.display = 'none';
            verificationSection.classList.add('show');
        }, 1200);
    });

    verifyBtn.addEventListener('click', () => {
        const code = document.getElementById('verificationCode').value.trim();
        if (code === verificationCode) {
            verificationSection.classList.remove('show');
            resetSection.classList.add('show');
        } else {
            showAlert('Kode verifikasi salah.', 'error');
        }
    });

    backBtn.addEventListener('click', () => {
        verificationSection.classList.remove('show');
        form.style.display = 'block';
        hideAlert();
    });

    resetBtn.addEventListener('click', () => {
        const newPassword = document.getElementById('newPassword').value.trim();
        const confirmPassword = document.getElementById('confirmPassword').value.trim();
        
        if (!newPassword || !confirmPassword) {
            showAlert('Password wajib diisi.', 'error');
            return;
        }
        
        if (newPassword !== confirmPassword) {
            showAlert('Password tidak cocok.', 'error');
            return;
        }
        
        const users = JSON.parse(localStorage.getItem('users') || '[]');
        const userIndex = users.findIndex(u => u.email === resetEmail);
        if (userIndex !== -1) {
            users[userIndex].password = newPassword;
            localStorage.setItem('users', JSON.stringify(users));
            showAlert('Password berhasil diubah! Silakan login.', 'success');
            setTimeout(() => {
                window.location.href = '/login';
            }, 2000);
        }
    });

    document.getElementById('email').focus();
</script>
</body>
</html>
