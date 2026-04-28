<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-blue: #2563eb;
        --bg-body: #f8fafc;
        --text-main: #1e293b;
        --border-color: #e2e8f0;
    }

    body {
        background-color: var(--bg-body);
        font-family: 'Inter', sans-serif;
    }

    .log-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    /* Admin Alert Section */
    .admin-banner {
        background: #eff6ff;
        border-left: 5px solid var(--primary-blue);
        border-radius: 12px;
        padding: 1.25rem;
        color: #1e40af;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 2rem;
    }

    /* Header Styling */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .page-header h2 {
        font-weight: 800;
        color: var(--text-main);
        letter-spacing: -0.5px;
    }

    /* Table Styling */
    .table-card {
        background: white;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        overflow: hidden;
    }

    .modern-table thead {
        background: #f1f5f9;
        color: #64748b;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .modern-table th {
        padding: 1rem 1.5rem;
        border: none;
    }

    .modern-table td {
        padding: 1.2rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Badge & Status */
    .status-badge {
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        display: inline-block;
    }

    .status-dipesan { background: #fef3c7; color: #92400e; }
    .status-dipinjam { background: #dcfce7; color: #166534; }
    .status-proses { background: #dbeafe; color: #1e40af; }
    .status-selesai { background: #f1f5f9; color: #475569; }

    /* Action Buttons */
    .btn-action-sm {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 8px;
        transition: 0.2s;
    }

    .btn-acc { background: var(--primary-blue); color: white; border: none; }
    .btn-acc:hover { background: #1d4ed8; color: white; }

    .btn-tagih { background: #fff1f2; color: #e11d48; border: none; }
    .btn-tagih:hover { background: #ffe4e6; }

    /* Modal Styling */
    .modal-content-modern {
        border-radius: 20px;
        border: none;
    }

    .modal-header-modern {
        border-bottom: 1px solid var(--border-color);
        padding: 1.5rem;
    }
</style>

<div class="log-container">
    
    <?php if(session()->get('role') == 'admin'): ?>
        <div class="admin-banner">
            <i class="fas fa-shield-alt fa-2x"></i>
            <div>
                <h6 class="mb-0 fw-bold">Mode Administrator Aktif</h6>
                <p class="mb-0 small opacity-75">Anda memiliki otoritas penuh untuk memverifikasi transaksi dan bukti pembayaran.</p>
            </div>
        </div>
    <?php endif; ?>

    <div class="page-header">
        <div>
            <h2 class="mb-0">Log Transaksi</h2>
            <p class="text-muted small">Kelola peminjaman dan pengembalian buku anggota.</p>
        </div>
        <span class="badge bg-dark rounded-pill px-3 py-2">
            Total Arsip: <?= count($peminjaman) ?>
        </span>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table modern-table mb-0">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Deadline</th>
                        <th>Status & Denda</th>
                        <th class="text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($peminjaman as $p): 
                        $tgl_deadline = strtotime($p['tgl_kembali']);
                        $is_telat = (time() > $tgl_deadline && $p['status'] != 'kembali');
                        $hari_telat = ($is_telat) ? floor((time() - $tgl_deadline) / (60 * 60 * 24)) : 0;
                        $total_denda = ($p['status'] == 'kembali') ? $p['total_denda'] : ($hari_telat * 2000);
                    ?>
                    <tr>
                        <td class="text-center text-muted small">#<?= $p['id_pinjam'] ?></td>
                        <td>
                            <div class="fw-bold text-dark"><?= htmlspecialchars($p['nama']); ?></div>
                            <small class="text-muted">UID: <?= $p['id_user'] ?></small>
                        </td>
                        <td>
                            <div class="fw-medium"><?= htmlspecialchars($p['judul']); ?></div>
                            <small class="text-primary">BID: <?= $p['id_buku'] ?></small>
                        </td>
                        <td>
                            <div class="<?= $is_telat ? 'text-danger fw-bold' : 'text-dark' ?>">
                                <?= date('d M Y', strtotime($p['tgl_kembali'])); ?>
                            </div>
                            <?php if($is_telat): ?>
                                <span class="badge bg-danger" style="font-size: 10px;">Terlambat <?= $hari_telat ?> Hari</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php 
                            $status_class = ''; $status_text = '';
                            if($p['status'] == 'pending_pinjam') { $status_class = 'status-dipesan'; $status_text = 'DIPESAN'; }
                            elseif($p['status'] == 'dipinjam') { $status_class = 'status-dipinjam'; $status_text = 'DIPINJAM'; }
                            elseif($p['status'] == 'pending_kembali') { $status_class = 'status-proses'; $status_text = 'DICEK ADMIN'; }
                            elseif($p['status'] == 'kembali') { $status_class = 'status-selesai'; $status_text = 'SELESAI'; }
                            ?>
                            <span class="status-badge <?= $status_class ?> mb-1"><?= $status_text ?></span>
                            
                            <?php if($total_denda > 0): ?>
                                <div class="small fw-bold <?= ($p['status_bayar'] == 'lunas') ? 'text-success' : 'text-danger' ?>">
                                    Rp <?= number_format($total_denda, 0, ',', '.') ?> 
                                    <i class="fas <?= ($p['status_bayar'] == 'lunas') ? 'fa-check-circle' : 'fa-exclamation-circle' ?>"></i>
                                </div>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <div class="d-flex flex-column gap-2 align-items-center">
                                <?php if(session()->get('role') == 'admin'): ?>
                                    <?php if($p['status'] == 'pending_pinjam'): ?>
                                        <button class="btn btn-acc btn-action-sm w-100" data-bs-toggle="collapse" data-bs-target="#accBox<?= $p['id_pinjam'] ?>">
                                            Konfirmasi Pinjam
                                        </button>
                                        <div class="collapse mt-2" id="accBox<?= $p['id_pinjam'] ?>">
                                            <form action="<?= base_url('peminjaman/konfirmasi/'.$p['id_pinjam'].'/setuju_pinjam') ?>" method="post">
                                                <input type="date" name="tgl_kembali" value="<?= $p['tgl_kembali'] ?>" class="form-control form-control-sm mb-1">
                                                <button type="submit" class="btn btn-success btn-sm w-100">Simpan & ACC</button>
                                            </form>
                                        </div>
                                    <?php elseif($p['status_bayar'] == 'proses'): ?>
                                        <a href="<?= base_url('peminjaman/setujui_pembayaran/'.$p['id_pinjam']) ?>" class="btn btn-acc btn-action-sm w-100">ACC Bayar Denda</a>
                                    <?php elseif($p['status'] == 'pending_kembali'): ?>
                                        <a href="<?= base_url('peminjaman/konfirmasi/'.$p['id_pinjam'].'/setuju_kembali') ?>" class="btn btn-acc btn-action-sm w-100">Terima Buku</a>
                                    <?php elseif($p['status'] == 'dipinjam'): ?>
                                        <a href="<?= base_url('peminjaman/kirim_peringatan/'.$p['id_pinjam']) ?>" class="btn btn-tagih btn-action-sm w-100">Kirim Tagihan</a>
                                    <?php endif; ?>
                                    
                                    <?php if($p['bukti_bayar']): ?>
                                        <button onclick="bukaBukti('<?= $p['id_pinjam'] ?>')" class="btn btn-light btn-action-sm w-100 border text-muted">
                                            <i class="fas fa-image"></i> Cek Bukti
                                        </button>
                                    <?php endif; ?>

                                <?php else: ?>
                                    <?php if($p['status'] == 'dipinjam'): ?>
                                        <?php if($is_telat && $p['status_bayar'] != 'lunas'): ?>
                                            <button type="button" class="btn btn-danger btn-action-sm w-100" data-bs-toggle="modal" data-bs-target="#modalBayar<?= $p['id_pinjam'] ?>">
                                                Upload Bukti Denda
                                            </button>
                                        <?php else: ?>
                                            <a href="<?= base_url('peminjaman/ajukan_kembali/'.$p['id_pinjam']) ?>" class="btn btn-acc btn-action-sm w-100">Kembalikan</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalBayar<?= $p['id_pinjam'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content modal-content-modern p-3">
                                <div class="modal-header-modern">
                                    <h5 class="fw-bold mb-0">Upload Bukti Pembayaran</h5>
                                </div>
                                <form action="<?= base_url('peminjaman/upload_bukti/'.$p['id_pinjam']) ?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body py-4">
                                        <p class="text-muted">Silakan unggah tangkapan layar bukti transfer denda sebesar:</p>
                                        <h3 class="text-danger fw-bold mb-4">Rp <?= number_format($total_denda, 0, ',', '.') ?></h3>
                                        <input type="file" name="bukti_bayar" class="form-control" required accept="image/*">
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary px-4">Kirim Bukti</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalLihatBukti" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-modern">
            <div class="modal-header-modern d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Konfirmasi Bukti Transfer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-4" id="wadahFoto">
                </div>
        </div>
    </div>
</div>

<script>
function bukaBukti(id) {
    const wadah = document.getElementById('wadahFoto');
    wadah.innerHTML = '<div class="spinner-border text-primary py-4"></div>';
    
    var myModal = new bootstrap.Modal(document.getElementById('modalLihatBukti'));
    myModal.show();

    fetch('<?= base_url('peminjaman/lihat_bukti/') ?>' + id)
        .then(response => response.text())
        .then(html => {
            wadah.innerHTML = html;
        })
        .catch(err => {
            wadah.innerHTML = '<span class="text-danger">Gagal memuat bukti pembayaran.</span>';
        });
}
</script>

<?= $this->endSection() ?>