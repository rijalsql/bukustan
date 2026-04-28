<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUKUSTAN - Sistem Perpustakaan Modern</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    
    

    <style>
        :root {
            --primary-color: #2c3e50; /* Navy Professional */
            --accent-color: #3498db;  /* Biru Modern */
            --bg-light: #f8f9fa;
            --text-main: #333333;
            --text-muted: #6c757d;
        }

        body {
            background: #f0f2f5;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Inter', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 400px;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-header img {
            width: 70px;
            margin-bottom: 15px;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        }

        .login-header h2 {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .login-header p {
            color: var(--text-muted);
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .form-label {
            color: var(--primary-color);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            background: #fdfdfd;
            border: 1.5px solid #e1e5eb;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
            outline: none;
            background: #fff;
        }

        .btn-primary-custom {
            background: var(--primary-color);
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 10px;
            font-size: 1rem;
        }

        .btn-primary-custom:hover {
            background: #1a252f;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 62, 80, 0.2);
        }

        .register-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .register-footer a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }

        .alert-custom {
            background: #fff5f5;
            color: #c53030;
            border-radius: 10px;
            padding: 12px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            border: 1px solid #feb2b2;
            display: flex;
            align-items: center;
        }

        .restore-btn {
            display: inline-block;
            margin-top: 15px;
            font-size: 0.75rem;
            color: #e53e3e;
            text-decoration: none;
            border: 1px solid #feb2b2;
            padding: 5px 12px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .restore-btn:hover {
            background: #fff5f5;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-header">
            
            <h2>BUKUSTAN</h2>
            <p>"Manusia Punya Rencana, Allah Punya Kuasa"</p>
        </div>

        <?php if (session()->getFlashdata('error') || session()->getFlashdata('salahpw')): ?>
            <div class="alert-custom">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= session()->getFlashdata('error') ?? session()->getFlashdata('salahpw') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/proses-login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autocomplete="off">
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-primary-custom">
                Masuk ke Dashboard
            </button>
        </form>

        <div class="register-footer">
            <span>Belum memiliki akun?</span><br>
            <a href="<?= base_url('users/create') ?>">
                Buat Akun Sekarang
            </a>
            <br>
            <a href="<?= base_url('restore') ?>" class="restore-btn">
                <i class="fas fa-database me-1"></i> Restore Database
            </a>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>