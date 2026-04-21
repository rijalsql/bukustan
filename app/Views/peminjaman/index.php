<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Crimson+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

<style>
    :root {
        --hp-gold: #ffc500;
        --hp-red: #740001;
        --hp-ink: #2b2b2b;
        --hp-parchment: #f4e1d2;
    }

    .hp-container {
        padding: 30px;
        font-family: 'Crimson Text', serif;
    }

    .hp-alert-admin {
        background-color: var(--hp-red);
        color: var(--hp-gold);
        border: 2px double var(--hp-gold);
        border-radius: 0;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    .hp-title {
        font-family: 'MedievalSharp', cursive;
        color: var(--hp-gold);
        text-shadow: 2px 2px 4px #000;
    }

    .hp-card-table {
        background-color: var(--hp-parchment);
        background-image: url('https://www.transparenttextures.com/patterns/parchment.png');
        border: 3px solid #3d2b1f;
        border-radius: 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .table thead {
        background: #3d2b1f;
        color: var(--hp-parchment);
        font-family: 'MedievalSharp', cursive;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .hp-badge {
        font-family: 'MedievalSharp', cursive;
        border-radius: 0;
        padding: 6px 12px;
        text-transform: uppercase;
        font-size: 10px !important;
        letter-spacing: 1px;
    }

    .bg-hp-warning { background: #b8860b; color: #fff; } 
    .bg-hp-info { background: #2f4f4f; color: #fff; }    
    .bg-hp-primary { background: #000080; color: #fff; } 
    .bg-hp-success { background: #1b4d3e; color: #fff; }

    .btn-hp-action {
        font-family: 'MedievalSharp', cursive;
        font-size: 11px;
        text-transform: uppercase;
        border-radius: 0;
    }
</style>

<div class="hp-container">
    
    <?php if(session()->get('role') == 'admin'): ?>
        <div class="alert hp-alert-admin d-flex align-items-center mb-4">
            <div class="fs-3 me-3">📜</div>
            <div>
                <strong style="font-family: 'MedievalSharp';">Otoritas Pengelola Perpustakaan Aktif!</strong> 
                Cek bukti transfer dan verifikasi naskah yang kembali.
            </div>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="hp-title mb-1">Log Transaksi Kitab</h2>
        <span class="badge" style="background: var(--hp-gold); color: var(--hp-red); border: 1px solid var(--hp-red); font-family: 'MedievalSharp';">
            Total Arsip: <?= count($peminjaman) ?>
        </span>
    </div>

    <div class="card hp-card-table">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center py-3">No</th>
                        <th>Anggota</th>
                        <th>Detail Buku</th>
                        <th>Batas Waktu</th>
                        <th>Denda</th>
                        <th class="text-center">Bukti Bayar</th> 
                        <th class="text-center">Status</th>
                        <th class="text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody style="color: #3d2b1f;">
                    <?php $no=1; foreach($peminjaman as $p): 
                        $tgl_deadline = strtotime($p['tgl_kembali']);
                        $tgl_sekarang = time();
                        $is_telat = ($tgl_sekarang > $tgl_deadline && $p['status'] != 'kembali');
                        $hari_telat = ($is_telat) ? floor(($tgl_sekarang - $tgl_deadline) / (60 * 60 * 24)) : 0;
                        $total_denda = ($p['status'] == 'kembali') ? $p['total_denda'] : ($hari_telat * 2000);
                    ?>
                    <tr>
                        <td class="text-center" style="font-family: 'MedievalSharp'; opacity: 0.7;"><?= $no++; ?></td>
                        <td>
                            <div class="fw-bold"><?= htmlspecialchars($p['nama']); ?></div>
                            <small>ID: #<?= $p['id_user'] ?></small>
                        </td>
                        <td>
                            <div class="fw-bold text-truncate" style="max-width: 150px;"><?= htmlspecialchars($p['judul']); ?></div>
                            <small class="text-muted">Buku ID: <?= $p['id_buku'] ?></small>
                        </td>
                        <td>
                            <div class="small fw-bold <?= $is_telat ? 'text-danger' : '' ?>">
                                <?= date('d/m/Y', strtotime($p['tgl_kembali'])); ?>
                            </div>
                        </td>
                        <td>
                            <?php if($total_denda > 0): ?>
                                <span class="<?= ($p['status_bayar'] == 'lunas') ? 'text-success' : 'text-danger' ?> fw-bold">
                                    Rp <?= number_format($total_denda, 0, ',', '.') ?>
                                </span>
                            <?php else: ?>
                                <span class="text-muted small">-</span>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <?php if($p['bukti_bayar']): ?>
                                <button type="button" class="btn btn-sm btn-info btn-hp-action" style="font-size: 9px;" onclick="bukaBukti('<?= $p['id_pinjam'] ?>')">
                                    👁️ Lihat Foto
                                </button>
                            <?php else: ?>
                                <small class="text-muted italic">Belum ada</small>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <?php 
                            $class = 'bg-secondary'; $txt = $p['status'];
                            if($p['status'] == 'pending_pinjam') { $class = 'bg-hp-warning'; $txt = 'Dipesan'; }
                            elseif($p['status'] == 'dipinjam') { $class = 'bg-hp-info'; $txt = 'Dipinjam'; }
                            elseif($p['status'] == 'pending_kembali') { $class = 'bg-hp-primary'; $txt = 'Proses Balik'; }
                            elseif($p['status'] == 'kembali') { $class = 'bg-hp-success'; $txt = 'Selesai'; }
                            ?>
                            <span class="badge hp-badge <?= $class ?>"><?= $txt ?></span>
                            <?php if($p['status_bayar'] == 'proses'): ?>
                                <div style="font-size: 8px;" class="text-danger fw-bold mt-1">MENUNGGU ACC</div>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <div class="btn-group-vertical w-100">
                                <?php if(session()->get('role') == 'admin'): ?>
                                    <?php if($p['status'] == 'pending_pinjam'): ?>
                                        <form action="<?= base_url('peminjaman/konfirmasi/'.$p['id_pinjam'].'/setuju_pinjam') ?>" method="post">
                                            <div class="p-2 mb-1" style="background: rgba(0,0,0,0.05); border: 1px solid var(--hp-gold);">
                                                <input type="date" name="tgl_pinjam" value="<?= $p['tgl_pinjam'] ?>" class="form-control form-control-sm mb-1" style="font-size: 10px;">
                                                <input type="date" name="tgl_kembali" value="<?= $p['tgl_kembali'] ?>" class="form-control form-control-sm" style="font-size: 10px;">
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success btn-hp-action w-100">ACC Pinjam</button>
                                        </form>
                                    <?php elseif($p['status_bayar'] == 'proses'): ?>
                                        <a href="<?= base_url('peminjaman/setujui_pembayaran/'.$p['id_pinjam']) ?>" class="btn btn-sm btn-success btn-hp-action" onclick="return confirm('Konfirmasi dana sudah masuk?')">ACC Bayar Denda</a>
                                    <?php elseif($p['status'] == 'pending_kembali'): ?>
                                        <a href="<?= base_url('peminjaman/konfirmasi/'.$p['id_pinjam'].'/setuju_kembali') ?>" class="btn btn-sm btn-primary btn-hp-action">Terima Buku</a>
                                    <?php elseif($p['status'] == 'dipinjam'): ?>
                                        <a href="<?= base_url('peminjaman/hilang/'.$p['id_pinjam']) ?>" class="btn btn-sm btn-danger btn-hp-action" onclick="return confirm('Tandai hilang?')">Hilang</a>
                                    <?php else: ?>
                                        <a href="<?= base_url('peminjaman/hapus_riwayat/'.$p['id_pinjam']) ?>" class="btn btn-sm btn-outline-danger btn-hp-action" onclick="return confirm('Hapus permanen?')">Hapus</a>
                                    <?php endif; ?>

                                <?php else: ?>
                                    <?php if($p['status'] == 'dipinjam'): ?>
                                        <?php if($is_telat && $p['status_bayar'] != 'lunas'): ?>
                                            <?php if($p['status_bayar'] == 'proses'): ?>
                                                <button class="btn btn-sm btn-secondary btn-hp-action" disabled>Dicek Admin</button>
                                            <?php else: ?>
                                                <a href="<?= base_url('peminjaman/bayar_denda/'.$p['id_pinjam']) ?>" class="btn btn-sm btn-warning btn-hp-action mb-1" target="_blank">📲 Bayar DANA</a>
                                                <button type="button" class="btn btn-sm btn-danger btn-hp-action" data-bs-toggle="modal" data-bs-target="#modalBayar<?= $p['id_pinjam'] ?>">💸 Upload Bukti</button>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <a href="<?= base_url('peminjaman/ajukan_kembali/'.$p['id_pinjam']) ?>" class="btn btn-sm btn-success btn-hp-action" onclick="return confirm('Kembalikan sekarang?')">Kembalikan</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalBayar<?= $p['id_pinjam'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="background: var(--hp-parchment); border: 3px solid #3d2b1f;">
                                <form action="<?= base_url('peminjaman/upload_bukti/'.$p['id_pinjam']) ?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-header border-0"><h5 class="hp-title">📜 Segel Pelunasan</h5></div>
                                    <div class="modal-body">
                                        <p>Silakan upload bukti transfer denda <strong>Rp <?= number_format($total_denda, 0, ',', '.') ?></strong></p>
                                        <input type="file" name="bukti_bayar" class="form-control" required accept="image/*">
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="submit" class="btn btn-success btn-hp-action">Kirim Bukti</button>
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
        <div class="modal-content" style="background: var(--hp-parchment); border: 3px solid #3d2b1f;">
            <div class="modal-header border-0">
                <h5 class="hp-title">📜 Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center" id="wadahFoto">
                </div>
        </div>
    </div>
</div>

<script>
function bukaBukti(id) {
    const wadah = document.getElementById('wadahFoto');
    wadah.innerHTML = '<div class="spinner-border text-warning"></div>';
    
    var myModal = new bootstrap.Modal(document.getElementById('modalLihatBukti'));
    myModal.show();

    fetch('<?= base_url('peminjaman/lihat_bukti/') ?>' + id)
        .then(response => response.text())
        .then(html => {
            wadah.innerHTML = html;
        })
        .catch(err => {
            wadah.innerHTML = '<span class="text-danger">Gagal memuat gambar.</span>';
        });
}
</script>

<?= $this->endSection() ?>