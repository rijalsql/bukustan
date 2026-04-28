<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .page-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -1px;
    }

    /* Modern Table Card */
    .table-container {
        background: white;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.02);
        overflow: hidden;
    }

    .table-modern {
        margin-bottom: 0;
    }

    .table-modern thead th {
        background: #f8fafc;
        padding: 1.2rem 1rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #64748b;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-modern tbody td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        color: #334155;
        font-size: 0.9rem;
    }

    /* Book Info Slot */
    .book-slot {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .book-cover-sm {
        width: 45px;
        height: 65px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* Status Badges */
    .status-badge {
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .badge-pending { background: #f1f5f9; color: #475569; }
    .badge-borrowed { background: #fffbeb; color: #b45309; }
    .badge-process { background: #eff6ff; color: #1d4ed8; }
    .badge-lost { background: #fef2f2; color: #b91c1c; }
    .badge-success { background: #f0fdf4; color: #15803d; }

    /* Action Buttons */
    .btn-action {
        padding: 8px 12px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: 0.2s;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .btn-return { background: #2563eb; color: white; }
    .btn-wa { background: #fbbf24; color: #78350f; }
    .btn-upload { background: #f97316; color: white; }
    .btn-delete { background: #fee2e2; color: #ef4444; }

    .btn-action:hover {
        transform: translateY(-2px);
        filter: brightness(1.1);
        color: inherit;
    }

    /* Rating Form */
    .rating-box {
        background: #f8fafc;
        padding: 10px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }

    .rating-input, .review-input {
        width: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        font-size: 0.8rem;
        margin-bottom: 5px;
        padding: 5px;
    }

    .notif-alert {
        border-radius: 12px;
        font-weight: 600;
        padding: 1rem;
        border: none;
    }
</style>

<div class="page-header">
    <h2 class="page-title">Riwayat Peminjaman Saya</h2>
    <p class="text-muted">Pantau aktivitas pinjaman buku dan status denda Anda di sini.</p>
</div>

<?php if(session()->getFlashdata('success')): ?>
    <div id="notif-success" class="alert alert-success notif-alert shadow-sm mb-4">
        <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div id="notif-error" class="alert alert-danger notif-alert shadow-sm mb-4">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="table-container shadow-sm">
    <div class="table-responsive">
        <table class="table table-modern align-middle">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Informasi Buku</th>
                    <th>Jadwal</th>
                    <th class="text-center">Denda</th>
                    <th class="text-center">Status</th>
                    <th>Rating & Ulasan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($riwayat as $r): 
                    $tgl_deadline = strtotime($r['tgl_kembali']);
                    $tgl_sekarang = time();
                    $is_telat = ($tgl_sekarang > $tgl_deadline && !in_array($r['status'], ['kembali', 'hilang']));
                    $denda_tampil = ($is_telat) ? floor(($tgl_sekarang - $tgl_deadline) / (60 * 60 * 24)) * 2000 : 0;
                ?>
                <tr>
                    <td class="text-center fw-bold text-muted"><?= $no++; ?></td>
                    <td>
                        <div class="book-slot">
                            <img src="<?= base_url('uploads/buku/' . ($r['foto'] ?: 'default.jpg')) ?>" class="book-cover-sm">
                            <div>
                                <div class="fw-bold text-dark"><?= $r['judul']; ?></div>
                                <div class="text-muted small">ID: #<?= $r['id_pinjam'] ?></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="small"><i class="bi bi-calendar-check text-primary"></i> <?= date('d M Y', strtotime($r['tgl_pinjam'])); ?></div>
                        <div class="small fw-bold <?= $is_telat ? 'text-danger' : 'text-muted' ?>">
                            <i class="bi bi-calendar-x"></i> <?= date('d M Y', strtotime($r['tgl_kembali'])); ?>
                        </div>
                    </td>
                    <td class="text-center">
                        <?php if ($r['status'] == 'hilang'): ?>
                            <span class="text-danger fw-bold small">GANTI BUKU</span>
                        <?php elseif ($r['status'] == 'kembali'): ?>
                            <span class="text-success small fw-bold">Rp <?= number_format($r['total_denda'], 0, ',', '.') ?> <i class="bi bi-patch-check-fill"></i></span>
                        <?php elseif ($is_telat): ?>
                            <span class="text-danger fw-bold">Rp <?= number_format($denda_tampil, 0, ',', '.') ?></span>
                        <?php else: ?>
                            <span class="text-muted small">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php if($r['status'] == 'pending_pinjam'): ?>
                            <span class="status-badge badge-pending">Menunggu</span>
                        <?php elseif($r['status'] == 'dipinjam'): ?>
                            <span class="status-badge badge-borrowed">Aktif</span>
                        <?php elseif($r['status'] == 'pending_kembali'): ?>
                            <span class="status-badge badge-process">Validasi</span>
                        <?php elseif($r['status'] == 'hilang'): ?>
                            <span class="status-badge badge-lost">Hilang</span>
                        <?php else: ?>
                            <span class="status-badge badge-success">Selesai</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($r['status'] == 'kembali'): ?>
                            <?php if($r['rating'] == null): ?>
                                <div class="rating-box">
                                    <form action="<?= base_url('peminjaman/beri_rating/' . $r['id_pinjam']) ?>" method="post">
                                        <select name="rating" class="rating-input">
                                            <option value="5">⭐⭐⭐⭐⭐ (Sempurna)</option>
                                            <option value="4">⭐⭐⭐⭐ (Bagus)</option>
                                            <option value="3">⭐⭐⭐ (Cukup)</option>
                                            <option value="2">⭐⭐ (Kurang)</option>
                                            <option value="1">⭐ (Buruk)</option>
                                        </select>
                                        <input type="text" name="ulasan" class="review-input" placeholder="Tulis kesan Anda...">
                                        <button type="submit" class="btn btn-sm btn-dark w-100 py-1" style="font-size: 0.7rem;">Kirim Review</button>
                                    </form>
                                </div>
                            <?php else: ?>
                                <div class="text-warning mb-1">
                                    <?php for($i=1; $i<=$r['rating']; $i++) echo "★"; ?>
                                </div>
                                <div class="text-muted small fst-italic">"<?= $r['ulasan']; ?>"</div>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-muted small">Belum tersedia</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <div class="d-flex flex-column gap-2 align-items-center">
                            <?php if($r['status'] == 'dipinjam'): ?>
                                <?php if($is_telat && $r['status_bayar'] != 'lunas'): ?>
                                    <?php if($r['status_bayar'] == 'proses'): ?>
                                        <span class="badge-lock small text-primary"><i class="bi bi-hourglass-split"></i> Verifikasi...</span>
                                    <?php else: ?>
                                        <a href="https://wa.me/6281234567890?text=Halo Admin Bukustan, saya ingin membayar denda keterlambatan buku: *<?= $r['judul'] ?>*" 
                                           target="_blank" class="btn-action btn-wa">
                                           <i class="bi bi-wallet2"></i> Bayar DANA
                                        </a>
                                        <form action="<?= base_url('peminjaman/upload_bukti/' . $r['id_pinjam']) ?>" method="post" enctype="multipart/form-data" class="w-100">
                                            <input type="file" name="bukti_bayar" required class="form-control form-control-sm mb-1" style="font-size: 0.7rem;">
                                            <button type="submit" class="btn-action btn-upload w-100 justify-content-center">
                                                <i class="bi bi-upload"></i> Upload
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <a href="<?= base_url('peminjaman/ajukan_kembali/' . $r['id_pinjam']) ?>" class="btn-action btn-return" onclick="return confirm('Kembalikan buku sekarang?')">
                                        <i class="bi bi-arrow-counterclockwise"></i> Kembalikan
                                    </a>
                                <?php endif; ?>
                            <?php elseif($r['status'] == 'kembali'): ?>
                                <a href="<?= base_url('peminjaman/hapus_riwayat/' . $r['id_pinjam']) ?>" class="btn-action btn-delete" onclick="return confirm('Hapus riwayat ini?')">
                                    <i class="bi bi-trash3"></i> Hapus
                                </a>
                            <?php else: ?>
                                <span class="text-muted small fst-italic">No Action</span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    setTimeout(function() {
        ['notif-success', 'notif-error'].forEach(id => {
            var notif = document.getElementById(id);
            if (notif) {
                notif.style.transition = "all 0.5s ease";
                notif.style.opacity = "0";
                notif.style.transform = "translateY(-10px)";
                setTimeout(() => notif.remove(), 500);
            }
        });
    }, 4000);
</script>

<?= $this->endSection() ?>