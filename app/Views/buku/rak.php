<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-blue: #2563eb;
        --dark-slate: #1e293b;
        --soft-bg: #f8fafc;
        --fire-orange: #f97316;
        --fire-red: #ef4444;
    }

    body {
        background-color: var(--soft-bg);
        font-family: 'Inter', sans-serif;
    }

    /* =========================================
       INFERNO ANIMATION (Tetap dipertahankan)
       ========================================= */
    @keyframes infernoBurn {
        0% { transform: scale(1); filter: brightness(1); }
        30% { transform: scale(1.02) rotate(1deg); filter: brightness(1.5); }
        100% { transform: scale(0); filter: brightness(5); opacity: 0; }
    }
    .is-burning { animation: infernoBurn 1.2s forwards ease-in !important; pointer-events: none !important; }

    /* =========================================
       MODERN UI RAK BUKU
       ========================================= */
    .rak-header {
        margin-bottom: 2rem;
    }

    /* Filter Category Pills */
    .category-pills {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding-bottom: 10px;
        scrollbar-width: none; /* Firefox */
    }
    .category-pills::-webkit-scrollbar { display: none; }

    .pill-link {
        padding: 8px 20px;
        border-radius: 50px;
        background: white;
        color: #64748b;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.85rem;
        border: 1px solid #e2e8f0;
        transition: 0.3s;
    }
    .pill-link:hover, .pill-active {
        background: var(--primary-blue);
        color: white;
        border-color: var(--primary-blue);
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
    }

    /* Modern Book Card */
    .book-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 25px;
    }

    .modern-book-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        transition: 0.3s;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .modern-book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.08);
        border-color: var(--primary-blue);
    }

    .book-cover-wrapper {
        position: relative;
        height: 280px;
        overflow: hidden;
    }

    .book-cover {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
    }

    .modern-book-card:hover .book-cover {
        transform: scale(1.05);
    }

    .book-category-tag {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(4px);
        color: white;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .book-info {
        padding: 15px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .book-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--dark-slate);
        margin-bottom: 4px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 2.4rem;
    }

    .book-author {
        font-size: 0.8rem;
        color: #64748b;
        margin-bottom: 12px;
    }

    /* Actions */
    .book-actions {
        display: flex;
        gap: 8px;
        margin-top: auto;
    }

    .btn-action-sm {
        flex: 1;
        padding: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        text-align: center;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-view { background: #f1f5f9; color: var(--dark-slate); }
    .btn-edit-modern { background: #eff6ff; color: var(--primary-blue); }
    .btn-burn-modern { background: #fef2f2; color: var(--fire-red); border: none; }
    
    .btn-view:hover { background: #e2e8f0; }
    .btn-edit-modern:hover { background: var(--primary-blue); color: white; }
    .btn-burn-modern:hover { background: var(--fire-red); color: white; }

    /* Search Bar Modern */
    .search-container {
        position: relative;
        max-width: 400px;
    }
    .search-input {
        padding: 10px 15px 10px 40px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        width: 100%;
        font-size: 0.9rem;
    }
    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }
</style>

<div class="container-fluid px-4 py-4">
    
    <div class="rak-header d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h3 class="fw-bold text-dark mb-1">Rak Bukustan</h3>
            <p class="text-muted small mb-0">Koleksi buku perpustakaan digital Anda.</p>
        </div>

        <form action="<?= base_url('buku') ?>" method="get" class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" name="keyword" class="search-input" placeholder="Cari judul buku..." value="<?= $keyword ?>">
        </form>
    </div>

    <div class="category-pills mb-4">
        <?php 
        $list_kat = ['Semua', 'Kitab', 'Novel', 'Cerita', 'Ilmu', 'Teknik']; 
        foreach($list_kat as $l): 
            $aktif = ($kategori_aktif == $l);
        ?>
            <a href="<?= base_url('buku' . ($l == 'Semua' ? '' : '?kategori='.$l)) ?>" 
               class="pill-link <?= $aktif ? 'pill-active' : '' ?>">
               <?= $l ?>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if(session()->get('role') == 'admin'): ?>
        <div class="mb-4">
            <a href="<?= base_url('buku/create') ?>" class="btn btn-primary shadow-sm" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-plus me-2"></i> Tambah Koleksi
            </a>
        </div>
    <?php endif; ?>

    <div class="book-grid">
        <?php if(!empty($buku)): ?>
            <?php foreach($buku as $b): ?>
                <div class="modern-book-card" id="book-row-<?= $b['id_buku'] ?>">
                    
                    <div class="book-cover-wrapper">
                        <span class="book-category-tag"><?= $b['kategori'] ?></span>
                        <img src="<?= base_url('uploads/buku/' . ($b['foto'] ?: 'default.jpg')) ?>" class="book-cover" alt="Cover">
                        
                        <div class="inferno-overlay" style="display: none; position: absolute; inset:0; background: radial-gradient(circle, var(--fire-orange), transparent);"></div>
                    </div>

                    <div class="book-info">
                        <h5 class="book-title" title="<?= $b['judul'] ?>"><?= $b['judul'] ?></h5>
                        <p class="book-author">Oleh: <?= $b['penulis'] ?></p>
                        
                        <div class="book-actions mt-auto">
                            <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>" class="btn-action-sm btn-view">Detail</a>
                            
                            <?php if(session()->get('role') == 'admin'): ?>
                                <a href="<?= base_url('buku/edit/' . $b['id_buku']) ?>" class="btn-action-sm btn-edit-modern" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="mantraBakar('<?= $b['id_buku'] ?>', '<?= addslashes($b['judul']) ?>')" class="btn-action-sm btn-burn-modern" title="Bakar">
                                    <i class="fas fa-fire"></i>
                                </button>
                            <?php endif; ?>
                        </div>

                        <?php if(session()->get('role') == 'anggota' && $b['stok'] > 0): ?>
                            <a href="<?= base_url('peminjaman/pinjam/' . $b['id_buku']) ?>" class="btn btn-primary btn-sm w-100 mt-2 rounded-3">Pinjam</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center w-100 py-5" style="grid-column: 1/-1;">
                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" style="width: 80px; opacity: 0.2;" class="mb-3">
                <p class="text-muted">Tidak ada koleksi ditemukan.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function mantraBakar(id, judul) {
    Swal.fire({
        title: 'Konfirmasi Bakar',
        text: "Apakah Anda yakin ingin menghapus koleksi '" + judul + "'?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Ya, Bakar!',
        cancelButtonText: 'Batal',
        borderRadius: '15px'
    }).then((result) => {
        if (result.isConfirmed) {
            const card = document.getElementById('book-row-' + id);
            if (card) {
                card.querySelector('.inferno-overlay').style.display = 'block';
                card.classList.add('is-burning');

                setTimeout(() => {
                    window.location.href = "<?= base_url('buku/delete') ?>/" + id;
                }, 1100);
            }
        }
    });
}
</script>

<?= $this->endSection() ?>