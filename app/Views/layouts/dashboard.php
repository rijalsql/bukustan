<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Crimson+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                    url('https://images.unsplash.com/photo-1514894780063-58a023336718?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        padding: 60px 20px;
        text-align: center;
        color: #f4e1d2;
        border-radius: 15px;
        margin-top: 20px;
        box-shadow: 0 15px 45px rgba(0,0,0,0.5);
        border: 5px solid #ffc500;
    }
    .hero-content h1 { font-family: 'MedievalSharp', cursive; font-size: 4rem; color: #ffc500; }
    .stat-card { background: rgba(43, 43, 43, 0.9); border: 2px solid #ffc500; border-radius: 12px; padding: 20px; transition: 0.3s; }
    .stat-card:hover { transform: translateY(-5px); }
    .magic-table { background: rgba(255, 255, 255, 0.05); border: 1px solid #3d2b1f; border-radius: 10px; color: #f4e1d2; }
    .badge-magic { background: #740001; color: #ffc500; padding: 5px 15px; border: 1px solid #ffc500; font-family: 'MedievalSharp'; }
</style>

<div class="container">
    <div class="hero-section mb-5 text-center">
        <div class="badge-magic mb-3 d-inline-block">✨ PERPUSTAKAAN ✨</div>
        <h1 style="font-family: 'MedievalSharp'; color: #ffc500;">BUKUSTAN</h1>
        <p style="font-family: 'Crimson Text', serif; font-style: italic; font-size: 1.5rem;">"Buka 24 jam, hari akhir kami tutup..."</p>
        
        <?php if(session()->get('role') == 'admin'): ?>
            <div class="row g-3 mt-4 justify-content-center">
                <div class="col-md-3">
                    <div class="stat-card">
                        <small style="color: #ffc500;">TOTAL BUKU</small>
                        <h2 class="m-0"><?= $total_buku ?></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <small style="color: #ffc500;">ANGGOTA</small>
                        <h2 class="m-0"><?= $total_anggota ?></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <small style="color: #ffc500;">TERLAMBAT</small>
                        <h2 class="m-0" style="color: #e74c3c;"><?= $terlambat ?></h2>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="row">
        <?php if(session()->get('role') == 'admin'): ?>
            <div class="col-md-8">
                <h4 style="font-family: 'MedievalSharp'; color: #ffc500;" class="mb-3">📜 Log Aktivitas Real-Time</h4>
                <div class="magic-table p-3">
                    <table class="table text-white">
                        <thead>
                            <tr style="color: #ffc500; border-bottom: 2px solid #ffc500;">
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($log_aktivitas as $log): ?>
                            <tr>
                                <td><?= $log['nama'] ?></td>
                                <td><?= $log['judul'] ?></td>
                                <td>
                                    <span class="badge <?= $log['status'] == 'dipinjam' ? 'bg-warning text-dark' : 'bg-success' ?>">
                                        <?= strtoupper($log['status']) ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4">
                <h4 style="font-family: 'MedievalSharp'; color: #ffc500;" class="mb-3">⚠️ Stok Kritis</h4>
                <?php foreach($stok_kritis as $sk): ?>
                    <div style="background: rgba(116, 0, 1, 0.2); border: 1px solid #740001; padding: 10px; border-radius: 8px; margin-bottom: 10px;" class="d-flex justify-content-between align-items-center">
                        <span style="color: #f4e1d2; font-size: 0.9rem;"><?= $sk['judul'] ?></span>
                        <span class="badge bg-danger"><?= $sk['stok'] ?></span>
                    </div>
                <?php endforeach; ?>
                
                <div class="mt-4 p-3 text-center" style="border: 2px double #ffc500; border-radius: 10px;">
                    <small style="color: #ffc500; display: block;">REKAP DENDA ADMIN</small>
                    <h3 style="color: #fff;">Rp <?= number_format($total_denda_masuk, 0, ',', '.') ?></h3>
                </div>
            </div>

        <?php else: ?>
            <div class="col-md-8">
                <h4 style="font-family: 'MedievalSharp'; color: #ffc500;" class="mb-3">📖 Buku yang Sedang Kamu Pelajari</h4>
                <?php if(empty($pinjaman_saya)): ?>
                    <div class="p-4 text-center" style="border: 1px dashed #ffc500; color: #aaa;">Belum ada buku yang kamu pinjam.</div>
                <?php else: ?>
                    <?php foreach($pinjaman_saya as $p): 
                        $sisa = ceil((strtotime($p['tgl_kembali']) - time()) / (60 * 60 * 24));
                    ?>
                    <div class="d-flex align-items-center p-3 mb-3" style="background: rgba(255,255,255,0.05); border-left: 5px solid #ffc500; border-radius: 5px;">
                        <img src="<?= base_url('uploads/buku/'.($p['foto'] ?: 'default.jpg')) ?>" style="width: 60px; height: 80px; object-fit: cover; border-radius: 5px;">
                        <div class="ms-3">
                            <h5 style="color: #ffc500; margin: 0;"><?= $p['judul'] ?></h5>
                            <small style="color: <?= $sisa <= 1 ? '#e74c3c' : '#27ae60' ?>;">⏳ <?= $sisa ?> Hari Lagi (Sampai <?= date('d M', strtotime($p['tgl_kembali'])) ?>)</small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <div class="text-center p-3 mb-4" style="background: #740001; border-radius: 10px; border: 2px solid #ffc500;">
                    <small style="color: #ffc500;">TAGIHAN KAMU</small>
                    <h3 style="color: #fff;">Rp <?= number_format($total_denda, 0, ',', '.') ?></h3>
                </div>
                <h5 style="font-family: 'MedievalSharp'; color: #ffc500;">✨ Rekomendasi Baru</h5>
                <div class="row g-2 mt-2">
                    <?php foreach($buku_baru as $bb): ?>
                        <div class="col-6">
                            <a href="<?= base_url('buku/detail/'.$bb['id_buku']) ?>">
                                <img src="<?= base_url('uploads/buku/'.($bb['foto'] ?: 'default.jpg')) ?>" class="w-100 rounded" style="height: 120px; object-fit: cover; border: 1px solid #3d2b1f;">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>