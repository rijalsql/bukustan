<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUKUSTAN - Digital Library</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --sidebar-width: 280px;
            --primary-color: #2563eb; /* Blue Modern */
            --bg-light: #f8fafc;
            --sidebar-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-main);
            margin: 0;
            display: flex;
        }

        /* Sidebar Modern Styling */
        .sidebar-bukustan {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--sidebar-bg);
            border-right: 1px solid #e2e8f0;
            position: fixed;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: var(--transition-speed);
        }

        .brand-area {
            padding: 2.5rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .brand-name {
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--text-main);
            letter-spacing: -0.5px;
            text-transform: uppercase;
        }

        /* Navigasi */
        .nav-container {
            flex-grow: 1;
            padding: 0 1rem;
            overflow-y: auto;
        }

        .nav-label {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 1.5rem 0.75rem 0.5rem;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.8rem 1rem;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .nav-link-custom i {
            font-size: 1.2rem;
            transition: 0.2s;
        }

        .nav-link-custom:hover {
            background-color: #f1f5f9;
            color: var(--primary-color);
        }

        .nav-link-custom.active {
            background-color: rgba(37, 99, 235, 0.08);
            color: var(--primary-color);
            font-weight: 600;
        }

        /* User Footer Sidebar */
        .user-footer {
            padding: 1.5rem;
            border-top: 1px solid #e2e8f0;
            background: #fdfdfd;
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #e2e8f0;
            object-fit: cover;
        }

        .user-details {
            overflow: hidden;
        }

        .user-name {
            display: block;
            font-weight: 600;
            font-size: 0.9rem;
            white-space: nowrap;
            text-overflow: ellipsis;
            color: var(--text-main);
        }

        .user-role {
            display: block;
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: capitalize;
        }

        .btn-logout {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            background: #fff1f2;
            color: #e11d48;
            border: 1px solid #fecdd3;
            font-weight: 600;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-logout:hover {
            background: #e11d48;
            color: white;
        }

        /* Main Content area */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            width: calc(100% - var(--sidebar-width));
        }

        .content-header {
            padding: 1.5rem 2rem;
            background: transparent;
        }

        .content-body {
            padding: 0 2rem 3rem;
            flex-grow: 1;
        }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .sidebar-bukustan {
                width: 80px;
            }
            .brand-name, .nav-label, .nav-link-custom span, .user-details, .btn-logout span {
                display: none;
            }
            .main-wrapper {
                margin-left: 80px;
                width: calc(100% - 80px);
            }
            .nav-link-custom {
                justify-content: center;
                padding: 1rem;
            }
            .brand-area {
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar-bukustan">
        <a href="<?= base_url('/') ?>" class="brand-area">
            <div class="brand-logo">
                <i class="fas fa-book-reader"></i>
            </div>
            <span class="brand-name">Bukustan</span>
        </a>

        <div class="nav-container">
            <div class="nav-label">Menu Utama</div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="<?= base_url('/') ?>" class="nav-link-custom <?= url_is('/') ? 'active' : '' ?>">
                        <i class="bi bi-grid-1x2-fill"></i> <span>Dashboard</span>
                    </a>
                </li>

                <?php $role = strtolower(session()->get('role') ?? ''); ?>

                <?php if ($role == 'admin' || $role == 'petugas') : ?>
                    <div class="nav-label">Manajemen</div>
                    <li class="nav-item">
                        <a href="<?= base_url('/users') ?>" class="nav-link-custom <?= url_is('users*') ? 'active' : '' ?>">
                            <i class="bi bi-people-fill"></i> <span>Data Pengguna</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/buku') ?>" class="nav-link-custom <?= url_is('buku*') ? 'active' : '' ?>">
                            <i class="bi bi-journal-bookmark-fill"></i> <span>Katalog Buku</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/peminjaman') ?>" class="nav-link-custom <?= url_is('peminjaman*') ? 'active' : '' ?>">
                            <i class="bi bi-arrow-left-right"></i> <span>Sirkulasi</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($role == 'anggota') : ?>
                    <div class="nav-label">E-Library</div>
                    <li class="nav-item">
                        <a href="<?= base_url('/stan') ?>" class="nav-link-custom <?= url_is('stan*') ? 'active' : '' ?>">
                            <i class="bi bi-book-half"></i> <span>Jelajah Buku</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('peminjaman/riwayat') ?>" class="nav-link-custom <?= url_is('peminjaman/riwayat*') ? 'active' : '' ?>">
                            <i class="bi bi-clock-history"></i> <span>Riwayat Pinjam</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/inbox-anggota') ?>" class="nav-link-custom <?= url_is('inbox-anggota*') ? 'active' : '' ?>">
                            <i class="bi bi-chat-dots-fill"></i> <span>Pesan</span>
                        </a>
                    </li>
                <?php endif; ?>

                <div class="nav-label">Pengaturan</div>
                <li class="nav-item">
                    <a href="<?= base_url('users/edit/' . session('id')) ?>" class="nav-link-custom <?= url_is('users/edit*') ? 'active' : '' ?>">
                        <i class="bi bi-person-gear"></i> <span>Profil Saya</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="user-footer">
            <div class="user-card">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode(session('nama')) ?>&background=0D8ABC&color=fff" class="user-avatar" alt="User">
                <div class="user-details">
                    <span class="user-name"><?= session('nama'); ?></span>
                    <span class="user-role"><?= $role ?></span>
                </div>
            </div>
            
            <?php if ($role == 'admin') : ?>
                <a href="<?= base_url('/backup') ?>" class="btn btn-outline-secondary btn-sm w-100 mb-2 border-0" style="font-size: 11px;">
                    <i class="bi bi-database-fill-gear"></i> Backup Database
                </a>
            <?php endif; ?>

            <a href="<?= base_url('/logout') ?>" class="btn-logout" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                <i class="bi bi-box-arrow-right"></i> <span>Keluar Sistem</span>
            </a>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="content-header">
            </header>

        <main class="content-body">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>