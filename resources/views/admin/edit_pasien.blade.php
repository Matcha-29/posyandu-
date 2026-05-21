<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Data Pasien — POSYANDU</title>
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
            --muted: #888;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ── HEADER (polosan, kosong) ── */
        .top-bar {
            width: 100%;
            height: 80px;
            background: var(--teal);
            flex-shrink: 0;
            box-shadow: 0 2px 12px rgba(0,0,0,0.12);
        }

        /* ── WRAPPER ── */
        .wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 36px 20px 48px;
            gap: 28px;
            width: 100%;
        }

        .page-title-btn {
            background: var(--teal);
            color: var(--white);
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: .1em;
            padding: 18px 60px;
            border-radius: 14px;
            border: none;
            pointer-events: none;
            box-shadow: 0 4px 20px rgba(14,118,109,.25);
        }

        /* ── FORM CARD (tanpa logo panel) ── */
        .form-card {
            width: 100%;
            max-width: 900px;
            background: var(--white);
            border-radius: 18px;
            border: 1.5px solid var(--border);
            box-shadow: 0 4px 24px rgba(0,0,0,.07);
            overflow: hidden;
            animation: fadeUp .5s cubic-bezier(.22,.68,0,1.15) both;
        }
        @keyframes fadeUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:none; } }

        .form-panel {
            padding: 36px 40px 40px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 32px;
            row-gap: 0;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: .93rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 7px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-family: inherit;
            font-size: .92rem;
            color: var(--text);
            background: var(--white);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-group input::placeholder,
        .form-group textarea::placeholder { color: #ccc; }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(14,118,109,.1);
        }
        .form-group select { cursor: pointer; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' viewBox='0 0 24 24' stroke='%23888' stroke-width='2.5'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='m19 9-7 7-7-7'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px; }

        /* ── BUTTONS ── */
        .btn-wrap {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            margin-top: 24px;
        }
        .btn-simpan, .btn-batal {
            padding: 14px 40px;
            font-family: inherit;
            font-size: .95rem;
            font-weight: 800;
            letter-spacing: .08em;
            border-radius: 10px;
            cursor: pointer;
            transition: transform .15s, box-shadow .2s, background .2s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            white-space: nowrap;
        }
        .btn-simpan {
            background: var(--navy);
            color: var(--white);
            border: none;
            box-shadow: 0 4px 16px rgba(0,0,128,.25);
        }
        .btn-simpan:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,128,.32); background: #0000aa; }
        .btn-batal {
            background: #e0eeed;
            color: var(--teal);
            border: 1.5px solid var(--teal);
        }
        .btn-batal:hover { background: #d4eeeb; transform: translateY(-2px); }
        .btn-simpan:active, .btn-batal:active { transform: translateY(0); }

        /* ── TOAST ── */
        .toast {
            display: none;
            position: fixed;
            bottom: 32px; right: 32px;
            background: var(--teal);
            color: var(--white);
            padding: 14px 24px;
            border-radius: 10px;
            font-weight: 700;
            font-size: .9rem;
            box-shadow: 0 6px 24px rgba(14,118,109,.3);
            z-index: 999;
            animation: slideInRight .3s ease;
        }
        .toast.error { background: #ef4444; }
        @keyframes slideInRight { from { opacity:0; transform:translateX(40px); } to { opacity:1; transform:none; } }

        .span-2 { grid-column: span 2; }

        @media (max-width: 700px) {
            .form-grid { grid-template-columns: 1fr; }
            .span-2 { grid-column: span 1; }
            .form-panel { padding: 24px 20px; }
        }
    </style>
</head>
<body>

    <!-- Header Polosan (kosong) -->
    <div class="top-bar"></div>

    <div class="wrapper">
        <div class="page-title-btn">EDIT DATA PASIEN</div>

        <div class="form-card">
            <div class="form-panel">
                <div class="form-grid">

                    <!-- Kolom Kiri -->
                    <div>
                        <div class="form-group">
                            <label>Nama :</label>
                            <input type="text" id="nama" value="{{ $patient->nama }}" />
                        </div>
                        <div class="form-group">
                            <label>NIK :</label>
                            <input type="text" id="nik" value="{{ $patient->nik }}" maxlength="16" />
                        </div>
                        <div class="form-group">
                            <label>No. HP :</label>
                            <input type="text" id="noHp" value="{{ $patient->noHp ?? $patient->hp ?? '' }}" />
                        </div>
                        <div class="form-group">
                            <label>Alamat :</label>
                            <input type="text" id="alamat" value="{{ $patient->alamat }}" />
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div>
                        <div class="form-group">
                            <label>Dusun/RT/RW :</label>
                            <input type="text" id="dusun" value="{{ $patient->dusun }}" />
                        </div>
                        <div class="form-group">
                            <label>Kecamatan :</label>
                            <input type="text" id="kecamatan" value="{{ $patient->kecamatan }}" />
                        </div>
                        <div class="form-group">
                            <label>Anak Ke :</label>
                            <input type="number" id="anakKe" value="{{ $patient->anakKe ?? 1 }}" min="1" />
                        </div>

                        <!-- Tombol -->
                        <div class="btn-wrap">
                            <button class="btn-batal" onclick="location.href='/data_pasien'">BATAL</button>
                            <button class="btn-simpan" onclick="simpanPerubahan()">SIMPAN PERUBAHAN</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
        async function simpanPerubahan() {
            const payload = {
                nama:      document.getElementById('nama').value.trim(),
                nik:       document.getElementById('nik').value.trim(),
                noHp:      document.getElementById('noHp').value.trim(),
                alamat:    document.getElementById('alamat').value.trim(),
                dusun:     document.getElementById('dusun').value.trim(),
                kecamatan: document.getElementById('kecamatan').value.trim(),
                anakKe:    document.getElementById('anakKe').value,
            };

            if (!payload.nama || !payload.nik || !payload.alamat || !payload.dusun || !payload.kecamatan) {
                showToast('Nama, NIK, Alamat, Dusun, dan Kecamatan wajib diisi!', 'error');
                return;
            }

            const simpanBtn = document.querySelector('.btn-simpan');
            simpanBtn.disabled = true;
            simpanBtn.textContent = 'MENYIMPAN...';

            try {
                const response = await fetch('/patients/{{ $patient->id }}', {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (response.ok) {
                    showToast('✓ Data pasien berhasil diperbarui!', 'success');
                    setTimeout(() => { window.location.href = '/data_pasien'; }, 1800);
                } else {
                    const errMsg = result.errors
                        ? Object.values(result.errors).flat().join(' ')
                        : (result.message || 'Gagal menyimpan perubahan.');
                    showToast(errMsg, 'error');
                    simpanBtn.disabled = false;
                    simpanBtn.textContent = 'SIMPAN PERUBAHAN';
                }
            } catch (err) {
                showToast('Terjadi kesalahan koneksi.', 'error');
                simpanBtn.disabled = false;
                simpanBtn.textContent = 'SIMPAN PERUBAHAN';
            }
        }

        function showToast(msg, type) {
            const toast = document.getElementById('toast');
            toast.textContent = msg;
            toast.className = 'toast' + (type === 'error' ? ' error' : '');
            toast.style.display = 'block';
            if (type !== 'error') {
                setTimeout(() => { toast.style.display = 'none'; }, 2500);
            }
        }
    </script>
</body>
</html>
