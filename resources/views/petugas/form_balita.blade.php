<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Balita — POSYANDU</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --teal:  #0E766D;
            --navy:  #000080;
            --white: #ffffff;
            --bg:    #f5f7f6;
            --border:#d0e4e0;
            --text:  #1a1a1a;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
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
            gap: 16px;
        }
        .top-bar .back-btn {
            background: rgba(255,255,255,.2);
            border: none; border-radius: 8px;
            color: var(--white); cursor: pointer;
            width: 34px; height: 34px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; transition: background .2s;
            text-decoration: none;
        }
        .top-bar .back-btn:hover { background: rgba(255,255,255,.3); }
        .top-bar .brand { font-size: 1.1rem; font-weight: 800; color: var(--white); letter-spacing: .08em; }

        .wrapper {
            flex: 1; display: flex; flex-direction: column;
            align-items: center; padding: 36px 20px 48px;
            gap: 28px; width: 100%;
        }

        .page-title-btn {
            background: var(--teal); color: var(--white);
            font-size: 1rem; font-weight: 800; letter-spacing: .1em;
            padding: 18px 60px; border-radius: 14px;
            border: none; pointer-events: none;
            box-shadow: 0 4px 20px rgba(14,118,109,.25);
        }

        .form-card {
            width: 100%; max-width: 1100px;
            background: var(--white);
            border-radius: 18px;
            border: 1.5px solid var(--border);
            box-shadow: 0 4px 24px rgba(0,0,0,.07);
            display: flex; overflow: hidden;
            animation: fadeUp .5s cubic-bezier(.22,.68,0,1.15) both;
        }
        @keyframes fadeUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:none; } }

        .logo-panel {
            width: 280px; flex-shrink: 0;
            border-right: 1.5px solid var(--border);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 40px 24px; background: #fafcfb;
        }
        .logo-panel img { width: 160px; height: 160px; object-fit: contain; }

        .form-panel { flex: 1; padding: 36px 40px 40px; }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 32px;
        }

        .form-group { margin-bottom: 18px; }
        .form-group label {
            display: block; font-size: .93rem; font-weight: 700;
            color: var(--text); margin-bottom: 7px;
        }
        .form-group input, .form-group select {
            width: 100%; padding: 11px 14px;
            border: 1.5px solid var(--border); border-radius: 8px;
            font-family: inherit; font-size: .92rem; color: var(--text);
            background: var(--white); outline: none;
            transition: border-color .2s, box-shadow .2s;
            appearance: none;
        }
        .form-group input:focus, .form-group select:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(14,118,109,.1);
        }

        /* buttons — bottom right */
        .btn-simpan-wrap {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            margin-top: 24px;
        }
        .btn-simpan, .btn-kembali {
            padding: 14px 40px;
            font-family: inherit;
            font-size: .95rem;
            font-weight: 800;
            letter-spacing: .08em;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: transform .15s, box-shadow .2s, background .2s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-simpan {
            background: var(--navy);
            color: var(--white);
            box-shadow: 0 4px 16px rgba(0,0,128,.25);
        }
        .btn-simpan:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,128,.32); background: #0000aa; }
        
        .btn-kembali {
            background: #e0eeed;
            color: var(--teal);
            border: 1.5px solid var(--teal);
        }
        .btn-kembali:hover { background: #d4eeeb; transform: translateY(-2px); }
        .btn-simpan:active, .btn-kembali:active { transform: translateY(0); }

        .toast {
            display: none; position: fixed;
            bottom: 32px; right: 32px;
            background: var(--teal); color: var(--white);
            padding: 14px 24px; border-radius: 10px;
            font-weight: 700; font-size: .9rem;
            box-shadow: 0 6px 24px rgba(14,118,109,.3); z-index: 999;
        }

        @media (max-width: 800px) {
            .form-card { flex-direction: column; }
            .logo-panel { width: 100%; border-right: none; border-bottom: 1.5px solid var(--border); }
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="top-bar">
</div>

<div class="wrapper">
    <div class="page-title-btn">FORM PENDAFTARAN PASIEN</div>

    <div class="form-card">
        <div class="logo-panel">
            <img src="{{ asset('image/logo.png') }}" alt="Logo POSYANDU" />
        </div>

        <div class="form-panel">
            <div class="form-grid">

                <!-- Kolom Kiri -->
                <div>
                    <div class="form-group">
                        <label>Nama Balita :</label>
                        <input type="text" id="nama" />
                    </div>
                    <div class="form-group">
                        <label>NIK :</label>
                        <input type="text" id="nik" maxlength="16" />
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir :</label>
                        <input type="date" id="tglLahir" />
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin :</label>
                        <select id="jenisKelamin">
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Orang Tua :</label>
                        <input type="text" id="namaOrangTua" />
                    </div>
                    <div class="form-group">
                        <label>No. Hp :</label>
                        <input type="text" id="noHp" />
                    </div>
                    <div class="form-group">
                        <label>Alamat :</label>
                        <input type="text" id="alamat" />
                    </div>
                    <div class="form-group">
                        <label>Dusun/RT / RW</label>
                        <input type="text" id="dusun" />
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div>
                    <div class="form-group">
                        <label>Desa/Kelurahan :</label>
                        <input type="text" id="desa" />
                    </div>
                    <div class="form-group">
                        <label>Kecamatan :</label>
                        <input type="text" id="kecamatan" />
                    </div>
                    <div class="form-group">
                        <label>Berat Badan (kg) :</label>
                        <input type="number" id="beratBadan" step="0.1" />
                    </div>
                    <div class="form-group">
                        <label>Tinggi Badan (cm) :</label>
                        <input type="number" id="tinggiBadan" />
                    </div>
                    <div class="form-group">
                        <label>Lingkar Kepala (cm) :</label>
                        <input type="number" id="lingkarKepala" step="0.1" />
                    </div>
                    <div class="form-group">
                        <label>Status Gizi :</label>
                        <select id="statusGizi">
                            <option value="">-- Pilih --</option>
                            <option value="baik">Baik</option>
                            <option value="kurang">Kurang</option>
                            <option value="lebih">Lebih</option>
                            <option value="buruk">Buruk</option>
                        </select>
                    </div>

                    <div class="btn-simpan-wrap">
                        <button type="button" class="btn-kembali" onclick="location.href='/list_data_pasien'">KEMBALI</button>
                        <button class="btn-simpan" onclick="simpan()">SIMPAN</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="toast" id="toast">✓ Data berhasil disimpan!</div>

<script>
    async function simpan() {
        const payload = {
            nama: document.getElementById('nama').value.trim(),
            nik: document.getElementById('nik').value.trim(),
            tglLahir: document.getElementById('tglLahir').value,
            noHp: document.getElementById('noHp').value.trim(),
            alamat: document.getElementById('alamat').value.trim(),
            dusun: document.getElementById('dusun').value.trim(),
            kecamatan: document.getElementById('kecamatan').value.trim(),
            kategori: 'balita'
        };

        if (!payload.nama || !payload.nik || !payload.noHp) {
            alert('Nama balita, NIK, dan No. HP wajib diisi.');
            return;
        }

        try {
            const response = await fetch('/patients', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            if (response.ok) {
                const toast = document.getElementById('toast');
                toast.style.display = 'block';
                setTimeout(() => {
                    toast.style.display = 'none';
                    window.location.href = '/list_data_pasien';
                }, 1800);
            } else {
                const err = await response.json();
                alert('Gagal menyimpan: ' + (err.message || 'Cek kembali data Anda'));
            }
        } catch (error) {
            console.error(error);
            alert('Terjadi kesalahan jaringan');
        }
    }
</script>
</body>
</html>
