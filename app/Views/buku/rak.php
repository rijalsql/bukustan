<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Crimson+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

<style>
    :root {
        --hp-gold: #ffc500;
        --hp-red: #740001;
        --hp-fire: #ff4500;
        --hp-parchment: #f4e1d2;
    }

    /* =========================================
       ULTIMATE INFERNO ANIMATION
       ========================================= */
    @keyframes infernoBurn {
        0% { transform: scale(1); filter: brightness(1); }
        30% { transform: scale(1.05) rotate(2deg); filter: brightness(2) saturate(2); }
        60% { transform: scale(0.8) rotate(-2deg); filter: brightness(5) contrast(2); }
        100% { transform: scale(0); filter: brightness(10); opacity: 0; }
    }

    @keyframes fireSwallow {
        0% { height: 0%; opacity: 0; bottom: -20px; }
        30% { height: 120%; opacity: 1; bottom: -20px; }
        100% { height: 150%; opacity: 0; bottom: 50px; }
    }

    @keyframes ashRise {
        0% { transform: translateY(0) rotate(0); opacity: 1; }
        100% { transform: translateY(-200px) rotate(360deg); opacity: 0; }
    }

    .is-burning {
        animation: infernoBurn 1.8s forwards ease-in !important;
        pointer-events: none !important;
        position: relative;
        z-index: 9999;
    }

    .is-burning .inferno-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle, var(--hp-fire) 0%, transparent 70%);
        mix-blend-mode: screen;
        z-index: 10;
        display: block !important;
    }

    .is-burning .flame-wrap {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 20;
        display: block !important;
    }

    .flame-part {
        position: absolute;
        bottom: 0;
        background: linear-gradient(to top, var(--hp-red), #ff4500, #ff8c00, gold, white);
        width: 25%;
        border-radius: 50% 50% 20% 20%;
        filter: blur(8px);
        opacity: 0;
        animation: fireSwallow 1s infinite alternate;
    }

    .flame-1 { left: 0%; animation-delay: 0.1s !important; }
    .flame-2 { left: 25%; animation-delay: 0.3s !important; height: 130% !important; }
    .flame-3 { left: 50%; animation-delay: 0.2s !important; }
    .flame-4 { left: 75%; animation-delay: 0.4s !important; height: 140% !important; }

    .ash {
        position: absolute;
        width: 6px;
        height: 6px;
        background: #222;
        border-radius: 2px;
        z-index: 30;
        animation: ashRise 1.5s forwards;
    }

    /* =========================================
       UI KATEGORI & RAK
       ========================================= */
    .magic-container { padding: 30px; background: rgba(20, 20, 20, 0.6); border-radius: 20px; backdrop-filter: blur(10px); border: 1px solid var(--hp-gold); }
    
    .category-scroll a {
        padding: 8px 20px;
        font-family: 'MedievalSharp';
        text-decoration: none;
        border: 1px solid var(--hp-gold);
        margin-right: 10px;
        color: var(--hp-gold);
        transition: 0.3s;
        display: inline-block;
    }

    .cat-active { background: var(--hp-gold) !important; color: var(--hp-red) !important; box-shadow: 0 0 10px var(--hp-gold); }
    
    .book-card { 
        background: var(--hp-parchment); 
        border: 3px solid #3d2b1f; 
        position: relative; 
        overflow: visible; 
        transition: 0.3s;
    }

    .book-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.5); }
    
    /* Badge Kategori di Pojok Kanan Atas Cover */
    .book-badge {
        position: absolute;
        top: 10px;
        right: 0;
        background: var(--hp-red);
        color: var(--hp-gold);
        font-family: 'MedievalSharp', cursive;
        padding: 5px 12px;
        border-left: 2px solid var(--hp-gold);
        border-bottom: 2px solid var(--hp-gold);
        font-size: 12px;
        z-index: 5;
    }

    .btn-magic-action {
        font-family: 'MedievalSharp', cursive;
        text-align: center;
        padding: 8px;
        font-size: 13px;
        transition: 0.3s;
        text-decoration: none;
        display: block;
        border: 1px solid #3d2b1f;
        cursor: pointer;
    }

    .btn-detail { background: #d2b48c; color: #2b2b2b; width: 100%; margin-bottom: 5px; }
    .btn-edit { background: var(--hp-gold); color: var(--hp-red); flex: 1; }
    .btn-delete { background: var(--hp-red); color: white; flex: 1; border: none; }
</style>

<div class="magic-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
        <h2 style="font-family: 'MedievalSharp'; color: var(--hp-gold);">📚 Rak Bukustan</h2>
        
        <form action="<?= base_url('buku') ?>" method="get" style="display: flex; gap: 5px;">
            <input type="text" name="keyword" placeholder="Cari judul..." value="<?= $keyword ?>" style="background: var(--hp-parchment); border: 1px solid #0f0f0f; padding: 5px 10px;">
            <button type="submit" style="background: var(--hp-red); color: var(--hp-gold); border: 1px solid var(--hp-gold); cursor: pointer; padding: 5px 15px;">Temukan</button>
        </form>
    </div>

    <div style="margin-bottom: 35px; overflow-x: auto; white-space: nowrap; padding-bottom: 10px;" class="category-scroll">
        <?php 
        $list_kat = ['Semua', 'Kitab', 'Novel', 'Cerita', 'Ilmu', 'Teknik']; 
        foreach($list_kat as $l): 
            $aktif = ($kategori_aktif == $l);
        ?>
            <a href="<?= base_url('buku' . ($l == 'Semua' ? '' : '?kategori='.$l)) ?>" 
               class="<?= $aktif ? 'cat-active' : '' ?>">
               <?= $l ?>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if(session()->get('role') == 'admin'): ?>
        <div style="margin-bottom: 30px;">
            <a href="<?= base_url('buku/create') ?>" style="background: var(--hp-gold); color: var(--hp-red); padding: 10px 20px; text-decoration: none; font-family: 'MedievalSharp'; font-weight: bold; border: 1px solid var(--hp-red);">+ Tambah Buku Baru</a>
        </div>
    <?php endif; ?>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 40px;">
        <?php if(!empty($buku)): ?>
            <?php foreach($buku as $b): ?>
                <div class="book-card" id="book-row-<?= $b['id_buku'] ?>">
                    
                    <div class="book-badge">
                        <?= $b['kategori'] ?>
                    </div>

                    <div class="inferno-overlay" style="display: none;"></div>
                    <div class="flame-wrap" style="display: none;">
                        <div class="flame-part flame-1"></div>
                        <div class="flame-part flame-2"></div>
                        <div class="flame-part flame-3"></div>
                        <div class="flame-part flame-4"></div>
                    </div>

                    <img src="<?= base_url('uploads/buku/' . ($b['foto'] ?: 'default.jpg')) ?>" style="width: 100%; height: 300px; object-fit: cover; border-bottom: 2px solid #0e0d0d;">
                    
                    <div style="padding: 15px;">
                        <h5 style="font-family: 'MedievalSharp'; color: var(--hp-red); margin-bottom: 5px; height: 45px; overflow: hidden;"><?= $b['judul'] ?></h5>
                        <p style="font-size: 13px; color: #0f0f0f; margin-bottom: 10px;">Oleh: <?= $b['penulis'] ?></p>
                        
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>" class="btn-magic-action btn-detail">Periksa Buku</a>
                            
                            <?php if(session()->get('role') == 'admin'): ?>
                                <div style="display: flex; gap: 5px;">
                                    <a href="<?= base_url('buku/edit/' . $b['id_buku']) ?>" class="btn-magic-action btn-edit">Ubah</a>
                                    
                                    <button onclick="mantraBakar('<?= $b['id_buku'] ?>', '<?= addslashes($b['judul']) ?>')" class="btn-magic-action btn-delete">
                                        🔥 Bakar
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if(session()->get('role') == 'anggota' && $b['stok'] > 0): ?>
                                <a href="<?= base_url('peminjaman/pinjam/' . $b['id_buku']) ?>" style="background: var(--hp-red); color: var(--hp-gold); text-decoration: none; text-align: center; padding: 8px; font-family: 'MedievalSharp';">Pinjam</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="grid-column: 1/-1; text-align: center; color: var(--hp-gold); padding: 50px;">Tidak ada kitab yang ditemukan.</p>
        <?php endif; ?>
    </div>
</div>

<script>
function mantraBakar(id, judul) {
    Swal.fire({
        title: 'INCENDIO MAXIMA! 🔥',
        text: "Kitab '" + judul + "' akan hangus selamanya. Lanjutkan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#740001',
        confirmButtonText: 'Ya, Bakar Habis!',
        cancelButtonText: 'Batal',
        background: '#f4e1d2',
        color: '#740001'
    }).then((result) => {
        if (result.isConfirmed) {
            const card = document.getElementById('book-row-' + id);
            if (card) {
                card.querySelector('.inferno-overlay').style.display = 'block';
                card.querySelector('.flame-wrap').style.display = 'block';
                
                // Efek Abu
                for(let i=0; i<15; i++) {
                    let ash = document.createElement('div');
                    ash.className = 'ash';
                    ash.style.left = Math.random() * 100 + '%';
                    ash.style.top = Math.random() * 100 + '%';
                    ash.style.animationDelay = Math.random() * 0.5 + 's';
                    card.appendChild(ash);
                }

                card.classList.add('is-burning');

                setTimeout(() => {
                    window.location.href = "<?= base_url('buku/delete') ?>/" + id;
                }, 1750);
            }
        }
    });
}
</script>

<?= $this->endSection() ?>