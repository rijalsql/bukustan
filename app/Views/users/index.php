<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    
    
    :root {
        --primary-blue: #2563eb;
        --secondary-slate: #64748b;
        --dark-slate: #1e293b;
        --soft-bg: #f8fafc;
    }

    body {
        background-color: var(--soft-bg);
        font-family: 'Inter', sans-serif;
        color: #334155;
    }

    .page-header {
        margin-bottom: 2rem;
        padding-top: 1rem;
    }

    .page-title {
        font-weight: 700;
        color: var(--dark-slate);
        letter-spacing: -0.5px;
    }

    /* Modern Card Filter */
    .filter-card {
        background: white;
        border: none;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }

    .form-label-custom {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--secondary-slate);
        margin-bottom: 0.5rem;
    }

    .form-control-modern {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
    }

    .form-control-modern:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* Modern Table Styling */
    .table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .table thead th {
        background: #f1f5f9;
        color: #475569;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 1rem;
        border: none;
    }

    .table tbody tr {
        transition: background 0.2s;
    }

    .table tbody tr:hover {
        background-color: #f8fafc;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid #f1f5f9;
    }

    /* Profile Frame */
    .avatar-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .avatar-placeholder {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: var(--dark-slate);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    /* Badges */
    .badge-modern {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.7rem;
        letter-spacing: 0.02em;
    }

    .role-admin { background: #dcfce7; color: #15803d; }
    .role-petugas { background: #dbeafe; color: #1d4ed8; }
    .role-anggota { background: #f1f5f9; color: #475569; }

    /* Buttons */
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: 0.2s;
        border: 1px solid #e2e8f0;
        background: white;
        color: #64748b;
    }

    .btn-action:hover {
        background: #f1f5f9;
        color: var(--primary-blue);
        border-color: var(--primary-blue);
    }

    .btn-print {
        background: var(--dark-slate);
        color: white;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.6rem 1.2rem;
        transition: 0.3s;
    }

    .btn-print:hover {
        background: #0f172a;
        color: white;
        transform: translateY(-1px);
    }
    /* Menyesuaikan warna pagination active dengan tema dashboard */
.pagination .page-item.active .page-link {
    background-color: #2563eb !important; /* Warna Primary Blue */
    color: white !important;
}

.pagination .page-link {
    padding: 8px 14px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.pagination .page-link:hover {
    background-color: #f1f5f9;
    transform: translateY(-2px);
}
</style>

<div class="container-fluid px-4">
    
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h3 class="page-title mb-1">Manajemen Pengguna</h3>
            <p class="text-muted small mb-0">Total data pengguna terdaftar dalam sistem BUKUSTAN.</p>
        </div>
        <a href="<?= base_url('users/print?' . http_build_query($_GET)) ?>" target="_blank" class="btn btn-print shadow-sm">
            <i class="fas fa-file-export me-2"></i> Ekspor Laporan
        </a>
    </div>

    <div class="card filter-card">
        <div class="card-body p-4">
            <form method="get" action="" class="row g-3">
                <div class="col-md-5">
                    <label class="form-label-custom">Cari Pengguna</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="keyword" class="form-control form-control-modern border-start-0" placeholder="Ketik nama atau username..." value="<?= $_GET['keyword'] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label-custom">Filter Peran</label>
                    <select name="role" class="form-select form-control-modern">
                        <option value="">Semua Peran</option>
                        <option value="admin" <?= (($_GET['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Administrator</option>
                        <option value="petugas" <?= (($_GET['role'] ?? '') == 'petugas') ? 'selected' : '' ?>>Petugas Perpustakaan</option>
                        <option value="anggota" <?= (($_GET['role'] ?? '') == 'anggota') ? 'selected' : '' ?>>Anggota</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary px-4 fw-600 rounded-8" style="height: 42px; border-radius: 8px;">Filter Data</button>
                    <a href="<?= base_url('users') ?>" class="btn btn-outline-secondary px-4 d-flex align-items-center" style="height: 42px; border-radius: 8px;">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center" role="alert" style="border-radius: 8px;">
            <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 70px;">ID</th>
                        <th>Informasi Pengguna</th>
                        <th>Kontak</th>
                        <th>Akses</th>
                        <?php if (session()->get('role') == 'admin') : ?>
                            <th class="text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td class="text-center text-muted fw-bold" style="font-size: 0.85rem;">#<?= $u['id'] ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <?php if ($u['foto']): ?>
                                                <img src="<?= base_url('uploads/users/' . $u['foto']) ?>" class="avatar-circle">
                                            <?php else: ?>
                                                <div class="avatar-placeholder">
                                                    <?= strtoupper(substr($u['nama'], 0, 1)) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark"><?= $u['nama'] ?></div>
                                            <small class="text-muted">@<?= $u['username'] ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size: 0.9rem;"><i class="far fa-envelope me-2 text-muted"></i><?= $u['email'] ?></div>
                                </td>
                                <td>
                                    <?php 
                                        $roleClass = 'role-anggota';
                                        if($u['role'] == 'admin') $roleClass = 'role-admin';
                                        elseif($u['role'] == 'petugas') $roleClass = 'role-petugas';
                                    ?>
                                    <span class="badge-modern <?= $roleClass ?>">
                                        <?= strtoupper($u['role']) ?>
                                    </span>
                                </td>

                                <?php if (session()->get('role') == 'admin') : ?>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="<?= base_url('users/detail/' . $u['id']) ?>" class="btn-action" title="Detail">
                                                <i class="fas fa-eye fa-sm"></i>
                                            </a>
                                            <a href="<?= base_url('users/edit/' . $u['id']) ?>" class="btn-action" title="Edit">
                                                <i class="fas fa-pen fa-sm"></i>
                                            </a>
                                            <a href="<?= base_url('users/wa/' . $u['id']) ?>" target="_blank" class="btn-action text-success" title="WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                            <a href="<?= base_url('users/delete/' . $u['id']) ?>" class="btn-action text-danger" title="Hapus" onclick="return confirm('Hapus pengguna ini?')">
                                                <i class="fas fa-trash-alt fa-sm"></i>
                                            </a>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" style="width: 60px; opacity: 0.2;" class="mb-3 d-block mx-auto">
                                <p class="text-muted">Data tidak ditemukan.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <?= $pager->links('default', 'bootstrap_pagination') ?>
    </div>

</div>

<?= $this->endSection() ?>