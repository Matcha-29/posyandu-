<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sasaran — POSYANDU</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --teal: #0E766D;
            --navy: #000080;
            --white: #ffffff;
            --bg: #eaf2f0;
            --border: #c8dbd8;
            --text: #1a1a1a;
            --error: #d94f4f;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            display: flex;
            flex-direction: column;
            align-items: stretch;
            min-height: 100vh;
        }

        .header-bar {
            width: 100%;
            height: 80px;
            background: var(--teal);
            flex-shrink: 0;
        }

        .main-content {
            display: flex;
            align-items: center;
            justify-content: center;

            height: calc(100vh - 80px);
            width: 100%;
        }

        .content-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 60px;
            /* jarak logo & form */
        }

        .logo-wrap {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            height: 340px;
            min-width: 220px;
            max-width: 220px;
            flex-shrink: 0;

            margin-left: -280px;
            /* buang -500px */
        }

        .logo-wrap img {
            width: 140px;
            height: 140px;
            object-fit: contain;
        }

        .form-card {
            background: transparent;
            box-shadow: none;
            padding: 0;

            min-width: 420px;
            max-width: 420px;
            width: 100%;

            margin-left: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* 🔥 biar isi ke tengah */
        }

        .title {
            background: var(--teal);
            color: #fff;
            border-radius: 14px;
            padding: 13px 0;
            font-size: 1.18em;
            font-weight: 700;
            margin-bottom: 32px;
            width: 80%;
            text-align: center;
            /* ini udah bener */
            letter-spacing: .08em;
        }

        .form-group {
            margin-bottom: 22px;
            text-align: left;
            width: 100%;
            /* 🔥 penting */
        }

        label {
            font-weight: 700;
            color: var(--navy);
            font-size: 1em;
            margin-bottom: 7px;
            display: block;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;

            width: 100%;
            padding: 13px 40px 13px 18px;
            /* kanan dikasih ruang */

            border-radius: 50px;
            border: 1.5px solid var(--border);
            background-color: var(--white);

            /* 🔥 PANAH */
            background-image: url("data:image/svg+xml;utf8,<svg fill='%23000080' height='20' viewBox='0 0 20 20' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M5 7l5 5 5-5z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
        }

        select:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(14, 118, 109, .12);
        }

        .btn-wrap {
            display: flex;
            justify-content: center;
            /* tengah horizontal */
            width: 100%;
        }

        .btn-daftar {
            width: 180px;
            padding: 13px;
            background: var(--navy);
            color: var(--white);
            font-family: inherit;
            font-size: .97rem;
            font-weight: 800;
            letter-spacing: .1em;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: transform .15s, box-shadow .2s;
            box-shadow: 0 6px 20px rgba(0, 0, 128, .18);
            margin-top: 10px;
        }

        .btn-daftar:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(0, 0, 128, .26);
        }

        .btn-daftar:active {
            transform: translateY(0);
        }

        .btn-daftar:disabled {
            opacity: .6;
            cursor: not-allowed;
            transform: none;
        }

        @media (max-width: 900px) {
            .main-content {
                flex-direction: column;
                align-items: center;
                padding-top: 100px;
            }

            .logo-wrap {
                margin-bottom: 0;
                margin-top: 0;
                min-width: 120px;
                height: 120px;
            }

            .form-card {
                margin-left: 0;
                margin-top: 18px;
            }
        }
    </style>
</head>

<body>


    <div class="header-bar"></div>

    <div class="main-content">
        <div class="content-wrap">
            <div class="logo-wrap">
                <img src="{{ asset('image/logo.png') }}" alt="Logo POSYANDU" />
            </div>
            <div class="form-card">
                <div class="title">SASARAN</div>
                <form action="/sasaran" method="POST" style="width:100%">
                    <div class="form-group">
                        <label for="kelompok_umur">Kelompok Umur</label>
                        <select name="kelompok_umur" id="kelompok_umur" required>
                            <option value="">Pilih Kelompok Umur</option>
                            <option value="balita">Balita</option>
                            <option value="remaja">Remaja</option>
                            <option value="dewasa">Dewasa</option>
                            <option value="lansia">Lansia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="ibu_hamil">Ibu Hamil</option>
                            <option value="ibu_menyusui">Ibu Menyusui</option>
                            <option value="anak">Anak</option>
                        </select>
                    </div>
                    <div class="btn-wrap">
                        <button type="submit" class="btn-daftar">DAFTAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>