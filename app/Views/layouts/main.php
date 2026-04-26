<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUKUSTAN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,700;1,400&family=MedievalSharp&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        /* Sidebar Styling */
        .sidebar-bukustan {
            width: 260px;
            background-image: url('https://www.transparenttextures.com/patterns/dark-wood.png');
            background-color: #740001; /* Merah Marun */
            border-right: 4px solid #d4af37; /* Garis Emas */
            color: white;
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .brand-area {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
            text-decoration: none;
        }

        .brand-area b {
            font-family: 'MedievalSharp', cursive;
            color: #d4af37;
            font-size: 1.6rem;
            display: block;
            margin-top: 10px;
        }

        /* Menu Navigasi Sidebar */
        .nav-links {
            list-style: none;
            padding: 20px 0;
            margin: 0;
            flex-grow: 1;
            overflow-y: auto;
        }

        .nav-links li {
            padding: 5px 15px;
        }

        .nav-links a {
            color: #f4e1d2;
            text-decoration: none;
            font-weight: 500;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-links a i {
            font-size: 1.2rem;
            width: 25px;
            text-align: center;
        }

        .nav-links a:hover {
            background: rgba(212, 175, 55, 0.15);
            color: #d4af37;
            padding-left: 20px;
        }

        .nav-links a.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-left: 4px solid #d4af37;
            font-weight: bold;
        }

        /* User Section di Bawah Sidebar */
        .user-section {
            padding: 20px;
            background: rgba(0, 0, 0, 0.2);
            border-top: 1px solid rgba(212, 175, 55, 0.3);
        }

        .user-info-text {
            margin-bottom: 15px;
        }

        .user-info-text span {
            font-size: 0.8rem;
            color: #d4af37;
            font-style: italic;
        }

        .user-info-text strong {
            font-size: 1rem;
            display: block;
        }

        .btn-keluar {
            display: block;
            border: 1px solid #d4af37;
            padding: 8px;
            text-align: center;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            background: #9d0000;
            transition: 0.3s;
        }

        .btn-keluar:hover {
            background: #d4af37;
            color: #740001;
        }

        /* Main Content Area */
        .main-content {
            flex-grow: 1;
            margin-left: 260px; /* Sesuai lebar sidebar */
            padding: 40px;
            width: calc(100% - 260px);
        }

        @media (max-width: 768px) {
            .sidebar-bukustan {
                width: 70px;
            }
            .sidebar-bukustan b, .sidebar-bukustan span, .user-section {
                display: none;
            }
            .main-content {
                margin-left: 70px;
                width: calc(100% - 70px);
            }
            .nav-links a {
                justify-content: center;
                padding: 15px 0;
            }
            .nav-links a i {
                margin: 0;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar-bukustan">
        <a href="<?= base_url('/') ?>" class="brand-area">
            <img src="https://cdn-icons-png.flaticon.com/512/1067/1067357.png" height="50" alt="Logo">
            <b>BUKUSTAN</b>
        </a>

        <ul class="nav-links">
            <li>
                <a href="<?= base_url('/') ?>" class="<?= url_is('/') ? 'active' : '' ?>">
                    <i class="bi bi-house"></i> <span>Dashboard</span>
                </a>
            </li>

            <?php $role = strtolower(session()->get('role') ?? ''); ?>

            <?php if ($role == 'admin' || $role == 'petugas') : ?>
                <li><a href="<?= base_url('/users') ?>" class="<?= url_is('users*') ? 'active' : '' ?>"><i class="bi bi-people"></i> <span>Data Users</span></a></li>
                <li><a href="<?= base_url('/buku') ?>" class="<?= url_is('buku*') ? 'active' : '' ?>"><i class="bi bi-journal-bookmark"></i> <span>Rak Buku</span></a></li>
                <li><a href="<?= base_url('/peminjaman') ?>" class="<?= url_is('peminjaman*') ? 'active' : '' ?>"><i class="bi bi-journal-check"></i> <span>Peminjaman</span></a></li>
            <?php endif; ?>

            <?php if ($role == 'anggota') : ?>
                <li><a href="<?= base_url('/stan') ?>" class="<?= url_is('stan*') ? 'active' : '' ?>"><i class="bi bi-book"></i> <span>Rak Buku</span></a></li>
                <li><a href="<?= base_url('peminjaman/riwayat') ?>" class="<?= url_is('peminjaman/riwayat*') ? 'active' : '' ?>"><i class="bi bi-clock-history"></i> <span>Pinjaman Saya</span></a></li>
                <li><a href="<?= base_url('/inbox-anggota') ?>" class="<?= url_is('inbox-anggota*') ? 'active' : '' ?>"><i class="bi bi-envelope"></i> <span>Kotak Pesan</span></a></li>
            <?php endif; ?>

            <li><a href="<?= base_url('users/edit/' . session('id')) ?>" class="<?= url_is('users/edit*') ? 'active' : '' ?>"><i class="bi bi-person-circle"></i> <span>Profil Saya</span></a></li>
        </ul>

        <div class="user-section">
            <div class="user-info-text">
                <span>Selamat Datang,</span>
                <strong><?= session('nama'); ?></strong>
            </div>
            
            <?php if ($role == 'admin') : ?>
                <a href="<?= base_url('/backup') ?>" class="btn btn-success btn-sm w-100 mb-2" style="font-size: 11px;">Backup Database</a>
            <?php endif; ?>

            <a href="<?= base_url('/logout') ?>" class="btn-keluar" onclick="return confirm('Yakin ingin keluar?')">
                <i class="bi bi-door-open"></i> KELUAR
            </a>
        </div>
    </aside>

    <main class="main-content">
        <div class="container-fluid">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>