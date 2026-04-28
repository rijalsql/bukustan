<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Anggota Baru - Bukustan</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-body: #f8fafc;
            --text-dark: #1e293b;
        }

        body {
            background: linear-gradient(135deg, #e0e7ff 0%, #f8fafc 100%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 500px;
            border-radius: 24px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h4 {
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .auth-header p {
            color: #64748b;
            font-size: 0.9rem;
        }

        .form-label {
            font-weight: 700;
            color: #475569;
            font-size: 0.85rem;
            margin-left: 4px;
        }

        .form-control-modern {
            background: white;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control-modern:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        .role-badge-box {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #64748b;
        }

        .upload-zone {
            border: 2px dashed #e2e8f0;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            background: #f8fafc;
            transition: 0.2s;
        }

        .upload-zone:hover {
            border-color: var(--primary);
            background: #eff6ff;
        }

        .btn-register {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            width: 100%;
            font-weight: 700;
            font-size: 1rem;
            margin-top: 10px;
            transition: 0.3s;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        }

        .btn-register:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 15px 20px -3px rgba(37, 99, 235, 0.4);
        }

        .auth-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: #64748b;
        }

        .auth-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
        }

        .auth-link:hover {
            text-decoration: underline;
        }

        .alert-modern {
            border-radius: 12px;
            border: none;
            background: #fee2e2;
            color: #b91c1c;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 12px;
        }
    </style>
</head>

<body>

    <div class="auth-card">
        <div class="auth-header">
            <h4>Daftar Bukustan</h4>
            <p>Ayo bergabung dan mulai jelajahi koleksi buku kami.</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-modern mb-4">
                <i class="fas fa-circle-exclamation me-2"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control form-control-modern" placeholder="Contoh: Rijal Ahmad" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control form-control-modern" placeholder="email@gmail.com" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control form-control-modern" placeholder="Username" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control form-control-modern" placeholder="••••••••" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Peran</label>
                    <div class="role-badge-box">
                        <i class="fas fa-user-check text-primary"></i> 
                        <span class="small fw-bold">Anggota</span>
                    </div>
                    <input type="hidden" name="role" value="anggota">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Foto Profil (Opsional)</label>
                <div class="upload-zone">
                    <input type="file" name="foto" class="form-control form-control-sm" accept="image/*" style="border: none; background: transparent;">
                    <div class="text-muted mt-2" style="font-size: 0.7rem;">JPG, PNG atau JPEG (Maks. 2MB)</div>
                </div>
            </div>

            <button type="submit" class="btn-register">
                Buat Akun Sekarang
            </button>

            <div class="auth-footer">
                Sudah punya akun? <a href="<?= base_url('login') ?>" class="auth-link">Masuk di sini</a>
            </div>
        </form>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>