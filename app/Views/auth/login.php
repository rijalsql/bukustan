<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUKUSTAN </title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Crimson+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="icon" href="<?= base_url('uploads/users/IJAL.png') ?>">
    <style>
        :root {
            --hp-red: #740001;
            --hp-gold: #ffc500;
            --hp-dark: #1a1a1a;
            --hp-parchment: #f4e1d2;
            --hp-ink: #3d2b1f;
        }

        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('https://images.unsplash.com/photo-1551269901-5c5e14c25df7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            font-family: 'Crimson Text', serif;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hp-card {
            background-color: var(--hp-parchment);
            background-image: url('https://www.transparenttextures.com/patterns/parchment.png');
            width: 420px;
            border-radius: 10px;
            padding: 40px;
            border: 3px solid var(--hp-ink);
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.8), inset 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .hp-card::after {
            content: 'H';
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 60px;
            background: #ae0001;
            border-radius: 50%;
            border: 2px solid #800000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--hp-gold);
            font-family: 'MedievalSharp';
            font-size: 30px;
            line-height: 60px;
            text-align: center;
        }

        .hp-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px double var(--hp-ink);
            padding-bottom: 15px;
        }

        .hp-header h2 {
            font-family: 'MedievalSharp', cursive;
            color: var(--hp-red);
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 5px;
            letter-spacing: 2px;
        }

        .hp-header span {
            font-style: italic;
            color: #5d4037;
            font-size: 0.9rem;
            display: block;
            line-height: 1.2;
        }

        .hp-label {
            color: var(--hp-ink);
            font-size: 0.9rem;
            margin-left: 5px;
            margin-bottom: 5px;
            font-weight: 700;
            text-transform: uppercase;
            display: block;
            font-family: 'MedievalSharp', cursive;
        }

        .hp-input {
            background: rgba(255, 255, 255, 0.4);
            border: none;
            border-bottom: 2px solid var(--hp-ink);
            border-radius: 0;
            padding: 10px 15px;
            font-size: 1.1rem;
            width: 100%;
            margin-bottom: 25px;
            transition: 0.3s;
            color: #2b2b2b;
        }

        .hp-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.7);
            border-bottom-color: var(--hp-red);
        }

        .btn-hp {
            background: var(--hp-red);
            color: var(--hp-gold);
            border: 2px solid var(--hp-gold);
            padding: 12px;
            border-radius: 5px;
            font-family: 'MedievalSharp', cursive;
            font-size: 1.3rem;
            width: 100%;
            transition: 0.4s;
            text-transform: uppercase;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-hp:hover {
            transform: scale(1.02);
            background: #8e0001;
            box-shadow: 0 0 20px rgba(186, 0, 1, 0.4);
            color: #fff;
        }

        /* Styling baru untuk Link Daftar */
        .hp-register-box {
            margin-top: 25px;
            text-align: center;
            border-top: 1px dashed var(--hp-ink);
            padding-top: 15px;
        }

        .hp-link {
            font-family: 'MedievalSharp', cursive;
            color: var(--hp-ink);
            text-decoration: none;
            font-size: 1rem;
            transition: 0.3s;
        }

        .hp-link:hover {
            color: var(--hp-red);
            text-decoration: underline;
        }

        .hp-alert {
            background: #3d2b1f;
            color: var(--hp-gold);
            border-left: 5px solid var(--hp-red);
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 20px;
            text-align: center;
            font-style: italic;
        }
    </style>
</head>

<body>

    <div class="hp-card">
        <div class="hp-header">
            <h2>BUKUSTAN</h2>
            <span>"Manusia Punya Rencana Tetapi Allah Punya Kuasa"</span>
        </div>

        <?php if (session()->getFlashdata('error') || session()->getFlashdata('salahpw')): ?>
            <div class="hp-alert">
                <i class="fas fa-bolt me-2"></i>
                <?= session()->getFlashdata('error') ?? session()->getFlashdata('salahpw') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/proses-login') ?>" method="post">
            <?= csrf_field() ?> <div>
                <label class="hp-label">Username</label>
                <input type="text" name="username" class="hp-input" placeholder="Siapa namamu?" required autocomplete="off">
            </div>

            <div class="mb-2">
                <label class="hp-label">Password</label>
                <input type="password" name="password" class="hp-input" placeholder="Masukkan sandi..." required>
            </div>

            <button type="submit" class="btn-hp">
                <i class="fas fa-wand-magic-sparkles me-2"></i> MASUK KE BUKUSTAN
            </button>
        </form>

        <div class="hp-register-box">
            <span class="text-muted small">Belum terdaftar di BUKUSTAN?</span><br>
            <a href="<?= base_url('users/create') ?>" class="hp-link">
                <i class="fas fa-feather-alt me-1"></i> Daftar Heula Atuh
            </a>
            <a href="<?= base_url('restore') ?>" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-database"></i> Restore DB
            </a>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>