<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-blue: #2563eb;
        --dark-slate: #1e293b;
        --success-green: #10b981;
        --danger-red: #ef4444;
        --warning-orange: #f59e0b;
    }

    body {
        background-color: #f8fafc;
        font-family: 'Inter', sans-serif;
        color: #334155;
    }

    /* Hero Dashboard Section */
    .dashboard-hero {
        background: linear-gradient(135deg, var(--dark-slate) 0%, #334155 100%);
        padding: 40px;
        border-radius: 20px;
        color: white;
        margin-top: 25px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }

    .dashboard-hero h1 {
        font-weight: 700;
        letter-spacing: -1px;
        margin-bottom: 10px;
    }

    .dashboard-hero p {
        opacity: 0.8;
        font-weight: 300;
    }

    /* Stat Cards */
    .stat-card-modern {
        background: white;
        border: none;
        border-radius: 16px;
        padding: 24px;
        display: flex;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }

    .stat-card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.5rem;
    }

    /* Table Styling */
    .card-table {
        background: white;
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .table thead th {
        background-color: #f1f5f9;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 15px;
        border: none;
    }

    .table td {
        padding: 15px;
        vertical-align: middle;
        color: #334155;
        border-top: 1px solid #f1f5f9;
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    /* Stok Kritis Design */
    .kritis-item {
        background: white;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 12px;
        border-left: 4px solid var(--danger-red);
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
</style>

<div class="container pb-5">
    <div class="dashboard-hero mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="badge bg-primary mb-2 px-3 py-2">Sistem Informasi Perpustakaan</span>
                <h1>Selamat Datang di BUKUSTAN</h1>
                <p class="mb-0">Kelola koleksi buku dan pantau peminjaman dalam satu dashboard terintegrasi.</p>
            </div>
            <div class="col-md-4 text-md-end d-none d-md-block">
                <i class="fas fa-chart-line" style="font-size: 80px; opacity: 0.2;"></i>
            </div>
        </div>
    </div>

    <?php if(session()->get('role') == 'admin'): ?>
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="stat-card-modern">
                <div class="stat-icon bg-primary-subtle text-primary">
                    <i class="fas fa-book"></i>
                </div>
                <div>
                    <small class="text-muted d-block uppercase fw-bold" style="font-size: 0.7rem;">TOTAL KOLEKSI</small>
                    <h3 class="m-0 fw-bold"><?= $total_buku ?> <span class="fs-6 fw-normal text-muted">Buku</span></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card-modern">
                <div class="stat-icon bg-success-subtle text-success">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <small class="text-muted d-block uppercase fw-bold" style="font-size: 0.7rem;">TOTAL ANGGOTA</small>
                    <h3 class="m-0 fw-bold"><?= $total_anggota ?> <span class="fs-6 fw-normal text-muted">Orang</span></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card-modern">
                <div class="stat-icon bg-danger-subtle text-danger">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <small class="text-muted d-block uppercase fw-bold" style="font-size: 0.7rem;">TERLAMBAT</small>
                    <h3 class="m-0 fw-bold text-danger"><?= $terlambat ?> <span class="fs-6 fw-normal text-muted">Pinjaman</span></h3>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <?php if(session()->get('role') == 'admin'): ?>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold m-0"><i class="fas fa-history me-2 text-primary"></i>Log Aktivitas Terbaru</h5>
                </div>
                <div class="card-table">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($log_aktivitas as $log): ?>
                            <tr>
                                <td class="fw-semibold"><?= $log['nama'] ?></td>
                                <td><?= $log['judul'] ?></td>
                                <td>
                                    <span class="badge-status <?= $log['status'] == 'dipinjam' ? 'bg-warning-subtle text-warning' : 'bg-success-subtle text-success' ?> border">
                                        <i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i>
                                        <?= strtoupper($log['status']) ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php else: ?>
                <h5 class="fw-bold mb-3"><i class="fas fa-bookmark me-2 text-primary"></i>Pinjaman Aktif Anda</h5>
                <?php if(empty($pinjaman_saya)): ?>
                    <div class="card-table p-5 text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" style="width: 80px; opacity: 0.3;" class="mb-3">
                        <p class="text-muted">Anda tidak memiliki pinjaman aktif saat ini.</p>
                        <a href="<?= base_url('buku') ?>" class="btn btn-primary btn-sm rounded-pill px-4">Cari Buku</a>
                    </div>
                <?php else: ?>
                    <?php foreach($pinjaman_saya as $p): 
                        $sisa = ceil((strtotime($p['tgl_kembali']) - time()) / (60 * 60 * 24));
                    ?>
                    <div class="card-table p-3 mb-3 d-flex align-items-center border-start border-primary border-4">
                        <img src="<?= base_url('uploads/buku/'.($p['foto'] ?: 'default.jpg')) ?>" class="rounded shadow-sm" style="width: 60px; height: 80px; object-fit: cover;">
                        <div class="ms-4">
                            <h6 class="fw-bold mb-1 text-dark"><?= $p['judul'] ?></h6>
                            <div class="d-flex align-items-center">
                                <span class="badge <?= $sisa <= 1 ? 'bg-danger' : 'bg-info' ?> me-2">
                                    <i class="fas fa-hourglass-half me-1"></i> <?= $sisa ?> Hari Lagi
                                </span>
                                <small class="text-muted">Batas: <?= date('d M Y', strtotime($p['tgl_kembali'])) ?></small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <?php if(session()->get('role') == 'admin'): ?>
  
                <?php foreach($stok_kritis as $sk): ?>
                    <div class="kritis-item">
                        <span class="fw-medium text-dark small text-truncate" style="max-width: 70%;"><?= $sk['judul'] ?></span>
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Sisa: <?= $sk['stok'] ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h5 class="fw-bold mb-3">✨ Koleksi Terbaru</h5>
                <div class="row g-2">
                    <?php foreach($buku_baru as $bb): ?>
                        <div class="col-6">
                            <a href="<?= base_url('buku/detail/'.$bb['id_buku']) ?>" class="text-decoration-none">
                                <div class="card border-0 shadow-sm overflow-hidden rounded-3">
                                    <img src="<?= base_url('uploads/buku/'.($bb['foto'] ?: 'default.jpg')) ?>" class="w-100" style="height: 140px; object-fit: cover;">
                                    <div class="p-2">
                                        <small class="text-dark fw-bold text-truncate d-block"><?= $bb['judul'] ?></small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>