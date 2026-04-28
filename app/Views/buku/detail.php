<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-blue: #2563eb;
        --dark-slate: #1e293b;
        --soft-bg: #f8fafc;
        --border-color: #e2e8f0;
    }

    body {
        background-color: var(--soft-bg);
        font-family: 'Inter', sans-serif;
    }

    .detail-container {
        max-width: 1100px;
        margin: 2rem auto;
        padding: 0 1.5rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #64748b;
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 1.5rem;
        transition: 0.2s;
    }

    .back-link:hover {
        color: var(--primary-blue);
    }

    /* Main Card Layout */
    .modern-detail-card {
        background: white;
        border-radius: 20px;
        border: 1px solid var(--border-color);
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        overflow: hidden;
        display: flex;
        flex-wrap: wrap;
    }

    .detail-image-section {
        flex: 1;
        min-width: 350px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem;
    }

    .detail-image-section img {
        width: 100%;
        max-width: 280px;
        border-radius: 12px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        transition: 0.3s;
    }

    .detail-info-section {
        flex: 1.5;
        min-width: 400px;
        padding: 3rem;
    }

    .category-badge {
        background: #eff6ff;
        color: var(--primary-blue);
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .book-main-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--dark-slate);
        margin: 1rem 0 0.5rem 0;
        line-height: 1.2;
    }

    .book-main-author {
        font-size: 1.1rem;
        color: #64748b;
        margin-bottom: 2rem;
    }

    /* Stats Grid */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 2.5rem;
    }

    .stat-box {
        padding: 15px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        text-align: center;
    }

    .stat-label {
        display: block;
        font-size: 0.7rem;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .stat-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark-slate);
    }

    /* Review Section */
    .review-header {
        margin-top: 4rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .review-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: 0.2s;
    }

    .review-card:hover {
        border-color: var(--primary-blue);
        transform: translateX(5px);
    }

    .reviewer-name {
        font-weight: 700;
        color: var(--dark-slate);
    }

    .rating-stars {
        color: #f59e0b; /* Amber 500 */
        font-size: 0.9rem;
    }

    .btn-loan {
        background: var(--primary-blue);
        color: white;
        padding: 14px 32px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: 0.3s;
        border: none;
    }

    .btn-loan:hover {
        background: #1d4ed8;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
        color: white;
    }

    .btn-edit-detail {
        background: #f1f5f9;
        color: var(--dark-slate);
    }

    @media (max-width: 768px) {
        .detail-image-section { padding: 2rem; }
        .detail-info-section { padding: 2rem; }
        .book-main-title { font-size: 1.8rem; }
    }
</style>

<div class="detail-container">
    <a href="<?= base_url('buku') ?>" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Rak Buku
    </a>

    <div class="modern-detail-card">
        <div class="detail-image-section">
            <img src="<?= base_url('uploads/buku/' . ($buku['foto'] ?: 'default.jpg')) ?>" alt="Book Cover">
        </div>

        <div class="detail-info-section">
            <span class="category-badge"><?= $buku['kategori']; ?></span>
            
            <h1 class="book-main-title"><?= $buku['judul']; ?></h1>
            <p class="book-main-author">Karya: <strong><?= $buku['penulis']; ?></strong></p>

            <div class="stats-row">
                <div class="stat-box">
                    <span class="stat-label">Tersedia</span>
                    <span class="stat-value" style="color: <?= $buku['stok'] > 0 ? '#10b981' : '#ef4444' ?>;">
                        <?= $buku['stok']; ?> Buku
                    </span>
                </div>
                <div class="stat-box">
                    <span class="stat-label">Rating</span>
                    <span class="stat-value" style="color: #f59e0b;">
                        <i class="fas fa-star me-1"></i><?= isset($buku['rata_rating']) ? round($buku['rata_rating'], 1) : '0'; ?>
                    </span>
                </div>
                <div class="stat-box">
                    <span class="stat-label">Denda / Hari</span>
                    <span class="stat-value">Rp <?= number_format($buku['denda_per_hari'], 0, ',', '.'); ?></span>
                </div>
            </div>

            <div class="action-footer pt-4 border-top">
                <?php if(session()->get('role') == 'anggota' && $buku['stok'] > 0): ?>
                    <a href="<?= base_url('peminjaman/pinjam/' . $buku['id_buku']) ?>" class="btn-loan">
                        <i class="fas fa-bookmark"></i> Pinjam Buku Ini
                    </a>
                <?php elseif(session()->get('role') == 'admin'): ?>
                    <a href="<?= base_url('buku/edit/' . $buku['id_buku']) ?>" class="btn-loan btn-edit-detail">
                        <i class="fas fa-edit text-primary"></i> Edit Data Koleksi
                    </a>
                <?php else: ?>
                    <button disabled class="btn-loan" style="background: #e2e8f0; color: #94a3b8; cursor: not-allowed;">
                        <i class="fas fa-times-circle"></i> Stok Tidak Tersedia
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="review-header">
        <h3 class="fw-bold text-dark m-0">Ulasan Pembaca</h3>
        <span class="text-muted small"><?= count($ulasan) ?> Ulasan Total</span>
    </div>

    <?php if (!empty($ulasan)): ?>
        <div class="row">
            <?php foreach ($ulasan as $u): ?>
                <div class="col-md-12">
                    <div class="review-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <span class="reviewer-name"><?= htmlspecialchars($u['nama']) ?></span>
                                <div class="rating-stars mt-1">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="<?= $i <= $u['rating'] ? 'fas fa-star' : 'far fa-star text-muted' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <small class="text-muted italic" style="font-size: 0.75rem;">
                                <?= date('d M Y', strtotime($u['tgl_kembali'])) ?>
                            </small>
                        </div>
                        <p class="text-secondary mb-0" style="line-height: 1.6; font-style: italic;">
                            "<?= htmlspecialchars($u['ulasan']) ?>"
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5 bg-white rounded-4 border">
            <i class="far fa-comment-dots fa-3x text-light mb-3"></i>
            <p class="text-muted">Belum ada ulasan untuk buku ini.<br>Jadilah yang pertama memberikan kesan!</p>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>