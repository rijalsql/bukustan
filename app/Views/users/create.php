<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Kroco Baru</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Crimson+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --hp-red: #740001;
            --hp-gold: #ffc500;
            --hp-ink: #3d2b1f;
            --hp-parchment: #f4e1d2;
        }

        body {
            background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), 
                        url('https://images.unsplash.com/photo-1551269901-5c5e14c25df7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Crimson Text', serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
        }

        .hp-card-register {
            background-color: var(--hp-parchment);
            background-image: url('https://www.transparenttextures.com/patterns/parchment.png');
            width: 100%;
            max-width: 550px;
            border-radius: 5px;
            padding: 40px;
            border: 3px solid var(--hp-ink);
            box-shadow: 0 0 50px rgba(0,0,0,0.9);
            position: relative;
        }

        /* Wax Seal Decoration */
        .hp-card-register::before {
            content: 'H';
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 60px;
            background: #ae0001;
            border-radius: 50%;
            border: 2px solid #800000;
            box-shadow: 0 4px 10px rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--hp-gold);
            font-family: 'MedievalSharp';
            font-size: 30px;
            z-index: 10;
        }

        .hp-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px double var(--hp-ink);
            padding-bottom: 10px;
        }

        .hp-header h4 {
            font-family: 'MedievalSharp', cursive;
            color: var(--hp-red);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: bold;
        }

        .hp-label {
            font-family: 'MedievalSharp', cursive;
            color: var(--hp-ink);
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.85rem;
            margin-bottom: 5px;
        }

        .hp-input, .hp-select {
            background: rgba(255, 255, 255, 0.3) !important;
            border: none !important;
            border-bottom: 2px solid var(--hp-ink) !important;
            border-radius: 0 !important;
            padding: 8px 12px !important;
            color: #2b2b2b !important;
            margin-bottom: 20px;
        }

        .hp-input:focus, .hp-select:focus {
            background: rgba(255, 255, 255, 0.6) !important;
            box-shadow: none !important;
            border-bottom-color: var(--hp-red) !important;
        }

        .hp-upload-section {
            border: 1px dashed var(--hp-ink);
            padding: 15px;
            background: rgba(255, 255, 255, 0.2);
            margin-bottom: 25px;
        }

        .btn-hp-save {
            background: var(--hp-red);
            color: var(--hp-gold);
            border: 2px solid var(--hp-gold);
            font-family: 'MedievalSharp', cursive;
            padding: 12px;
            width: 100%;
            font-size: 1.2rem;
            text-transform: uppercase;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        .btn-hp-save:hover {
            background: var(--hp-gold);
            color: var(--hp-red);
            border-color: var(--hp-red);
            transform: translateY(-2px);
        }

        .hp-footer-link {
            text-align: center;
            margin-top: 20px;
        }

        .hp-link {
            font-family: 'MedievalSharp', cursive;
            color: var(--hp-ink);
            text-decoration: none;
            transition: 0.3s;
        }

        .hp-link:hover {
            color: var(--hp-red);
            text-decoration: underline;
        }

        .hp-error-alert {
            background: #3d2b1f;
            color: var(--hp-gold);
            border-left: 5px solid var(--hp-red);
            padding: 10px;
            margin-bottom: 20px;
            font-style: italic;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

    <div class="hp-card-register">
        <div class="hp-header">
            <h4>Pendaftaran Kroco Baru</h4>
            <p class="text-muted small italic">Selesaikan pendaftaran untuk memasuki Aplikasi BUKUSTAN</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="hp-error-alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row">
                <div class="col-md-12">
                    <label class="hp-label">Nama Lengkap </label>
                    <input type="text" name="nama" class="form-control hp-input" placeholder="Masukkan nama lengkap..." required>
                </div>

                <div class="col-md-6">
                    <label class="hp-label">E-mail</label>
                    <input type="email" name="email" class="form-control hp-input" placeholder="kroco@gmail.com" required>
                </div>

                <div class="col-md-6">
                    <label class="hp-label">Username</label>
                    <input type="text" name="username" class="hp-input form-control" placeholder="Username..." required>
                </div>

                <div class="col-md-6">
                    <label class="hp-label">Password</label>
                    <input type="password" name="password" class="hp-input form-control" placeholder="Password..." required>
                </div>

                <div class="col-md-6">
                    <label class="hp-label">Role</label>
                    <select name="role" class="form-select hp-select" required>
                        <option value="" disabled selected>-- Pilih Peran --</option>
                        <option value="admin">Admin </option>
                        <option value="petugas">Petugas </option>
                        <option value="anggota" selected>Anggota </option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="hp-label">Foto Profil</label>
                    <div class="hp-upload-section">
                        <input type="file" name="foto" class="form-control form-control-sm hp-input mb-0" accept="image/*">
                        <small class="text-muted d-block mt-2 italic" style="font-size: 0.75rem;">Format: JPG/PNG (Maks 2MB). Kosongkan jika belum ada foto.</small>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-hp-save">
                <i class="fas fa-feather-alt me-2"></i> Kirim Formulir
            </button>

            <div class="hp-footer-link">
                <a href="<?= base_url('login') ?>" class="hp-link">
                    <i class="fas fa-door-open me-1"></i> Sudah terdaftar? Balik
                </a>
            </div>
        </form>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>