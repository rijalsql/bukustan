<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Styling tetap sama seperti sebelumnya */
    .parchment-card {
        background-color: #f4e1d2;
        background-image: url('https://www.transparenttextures.com/patterns/parchment.png');
        border: 2px solid #3d2b1f;
        padding: 20px;
        margin-bottom: 20px;
    }
    .hp-title { font-family: 'MedievalSharp', cursive; color: #740001; }
</style>

<div class="container mt-4">
    <h2 class="hp-title mb-4">📜 Pesan Untukmu</h2>

    <?php if (empty($pesan)) : ?>
        <div class="parchment-card text-center">
            <p>Belum ada pesan baru dari pengelola perpustakaan.</p>
        </div>
    <?php else : ?>
        <?php foreach ($pesan as $p) : ?>
    <div class="parchment-card position-relative mb-3" style="color: #3d2b1f;"> <a href="<?= base_url('inbox-anggota/hapus/' . ($p['id_inbox'] ?? $p['id'])) ?>" 
           class="btn-close position-absolute top-0 end-0 m-2" 
           onclick="return confirm('Hapus pesan ini?')"></a>
        
        <div class="d-flex align-items-start">
            <span style="font-size: 1.5rem; margin-right: 15px;">⚠️</span>
            <div>
                <h5 class="fw-bold" style="color: #740001;"><?= $p['subjek'] ?? 'Tanpa Subjek' ?></h5>
                <p class="mb-1"><?= $p['pesan'] ?? 'Isi pesan tidak terbaca' ?></p>
                <small class="text-muted" style="font-style: italic;">
                    Dikirim pada: <?= date('d M Y', strtotime($p['tanggal'] ?? 'now')) ?>
                </small>
            </div>
        </div>
    </div>
<?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>