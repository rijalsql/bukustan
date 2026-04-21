<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUKUSTAN - Hogwarts Library</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,700;1,400&family=MedievalSharp&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --hp-gold: #ffc500;
            --hp-dark-red: #740001; /* Gryffindor Red */
            --hp-parchment: #f4e1d2;
            --hp-ink: #2b2b2b;
            --hp-border: #3d2b1f;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #1a1a1a;
            background-image: url('https://www.transparenttextures.com/patterns/dark-matter.png');
            font-family: 'Crimson Text', serif;
            color: var(--hp-parchment);
        }

        .custom-navbar {
            background-color: var(--hp-dark-red);
            background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://www.transparenttextures.com/patterns/wood-pattern.png');
            padding: 0 5%;
            height: 90px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 9999;
            border-bottom: 4px solid var(--hp-gold);
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
        }

        .nav-logo {
            font-family: 'MedievalSharp', cursive;
            font-size: 30px;
            color: var(--hp-gold) !important;
            text-decoration: none !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            letter-spacing: 3px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
            height: 100%;
        }

        .nav-item {
            font-family: 'Crimson Text', serif;
            text-decoration: none !important;
            color: var(--hp-parchment);
            font-size: 19px;
            font-weight: 700;
            padding: 5px 15px;
            transition: 0.3s;
            position: relative;
            border-bottom: 2px solid transparent;
        }

        .nav-item:hover {
            color: var(--hp-gold);
            border-bottom: 2px solid var(--hp-gold);
            text-shadow: 0 0 10px rgba(255, 197, 0, 0.5);
        }

        .notif-badge {
            background: #ae0001;
            color: var(--hp-gold);
            font-size: 12px;
            padding: 2px 7px;
            border-radius: 50%;
            border: 1px solid var(--hp-gold);
            position: absolute;
            top: -5px;
            right: -5px;
            box-shadow: 0 0 5px rgba(0,0,0,0.5);
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-left: 20px;
            border-left: 2px solid var(--hp-gold);
        }

        .user-name {
            font-size: 18px;
            color: var(--hp-gold);
            font-style: italic;
        }

        .user-name b {
            font-family: 'MedievalSharp', cursive;
            color: var(--hp-parchment);
            letter-spacing: 1px;
        }

        .btn-logout {
            background-color: transparent;
            color: var(--hp-parchment);
            padding: 8px 15px;
            border: 1px solid var(--hp-gold);
            text-decoration: none !important;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
            text-transform: uppercase;
        }

        .btn-logout:hover {
            background-color: var(--hp-gold);
            color: var(--hp-dark-red);
            box-shadow: 0 0 15px var(--hp-gold);
        }

        .main-content {
            padding-top: 40px;
            padding-bottom: 60px;
            min-height: 100vh;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--hp-border);
            border: 2px solid var(--hp-gold);
        }
    </style>
</head>
<body>

<nav class="custom-navbar">
    <a href="<?= base_url('dashboard') ?>" class="nav-logo">
        <i class="fas fa-hat-wizard me-2"></i>BUKUSTAN
    </a>

    <div class="nav-links">
        <a href="<?= base_url('dashboard') ?>" class="nav-item">Dashboard</a>
        <a href="<?= base_url('buku') ?>" class="nav-item">Rak Buku</a>
        
        <?php if(session()->get('role') == 'admin'): ?>
            <a href="<?= base_url('peminjaman') ?>" class="nav-item">
                Manajemen Peminjaman
                <?php if(isset($notif_konfirmasi) && $notif_konfirmasi > 0): ?>
                    <span class="notif-badge"><?= $notif_konfirmasi ?></span>
                <?php endif; ?>
            </a>
            <a href="<?= base_url('users') ?>" class="nav-item">Kroco List</a>
        <?php else: ?>
            <a href="<?= base_url('peminjaman/riwayat') ?>" class="nav-item">
                <i class="fas fa-history me-1"></i> Pinjaman Saya
            </a>
        <?php endif; ?>

        <div class="nav-user">
            <span class="user-name">Penyihir: <b><?= session()->get('nama') ?></b></span>
            <a href="<?= base_url('logout') ?>" class="btn-logout" onclick="return confirm('Meninggalkan Hogwarts?')">
                <i class="fas fa-feather-alt me-1"></i> Keluar
            </a>
        </div>
    </div>
</nav>

<div class="main-content">
    <div class="container">
        <?= $this->renderSection('content') ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>