<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap" rel="stylesheet">

<style>
    :root {
        --hp-gold: #d4af37;
        --hp-red: #5c0909;
        --hp-parchment: #f4e4bc;
    }

    /* ANIMASI API SAAT DIBAKAR */
    @keyframes burnOut {
        0% { transform: scale(1); filter: brightness(1) sepia(0); opacity: 1; }
        20% { transform: scale(1.05); filter: brightness(1.2) sepia(1) saturate(5) hue-rotate(-30deg); }
        100% { transform: scale(0); filter: brightness(5) grayscale(1); opacity: 0; box-shadow: 0 0 50px red; }
    }
    
    /* Class yang dipicu lewat JS */
    .burning { 
        animation: burnOut 1.2s forwards ease-in !important; 
        pointer-events: none !important; 
        z-index: 999;
    }

    .magic-container {
        font-family: 'Crimson Text', serif;
        background: var(--hp-parchment);
        padding: 30px;
        border-radius: 15px;
        border: 2px solid #3d2b1f;
        box-shadow: 10px 10px 30px rgba(0,0,0,0.3);
    }

    .book-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 25px;
        margin-top: 20px;
    }

    .book-card {
        background: rgba(255, 255, 255, 0.3);
        border: 2px solid #3d2b1f;
        border-radius: 10px;
        overflow: hidden;
        transition: 0.3s;
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .book-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 25px rgba(0,0,0,0.2);
        border-color: var(--hp-red);
    }

    .book-info {
        padding: 15px;
        text-align: center;
        flex-grow: 1;
    }

    .btn-magic {
        font-family: 'MedievalSharp', cursive;
        text-decoration: none;
        display: block;
        padding: 8px;
        margin: 2px;
        font-size: 13px;
        text-align: center;
        border-radius: 5px;
        transition: 0.3s;
        cursor: pointer;
    }

    .btn-burn { background: var(--hp-red); color: var(--hp-gold); border: 1px solid var(--hp-gold); }
    .btn-edit { background: #2980b9; color: white; border: none; }
    .btn-pinjam { background: var(--hp-red); color: var(--hp-gold); border: 2px solid var(--hp-gold); font-weight: bold; }

    .stok-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--hp-red);
        color: var(--hp-gold);
        padding: 2px 8px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: bold;
        border: 1px solid var(--hp-gold);
        z-index: 10;
    }
</style>

<div class="magic-container">
    <h2 style="color: var(--hp-red); text-align: center; font-family: 'MedievalSharp'; text-transform: uppercase; border-bottom: 2px double #3d2b1f; padding-bottom: 10px;">
        📚 Perpustakaan Sihir Hogwarts 📚
    </h2>

    <div style="margin: 20px 0; display: flex; justify-content: space-between; align-items: center;">
        <?php if (session()->get('role') != 'anggota'): ?>
            <a href="<?= base_url('buku/create') ?>" class="btn-magic btn-pinjam" style="padding: 10px 20px;">
                + Tambah Kitab Baru
            </a>
        <?php else: ?>
            <span style="font-style: italic;">Selamat datang, Magis <b><?= session()->get('nama') ?></b>!</span>
        <?php endif; ?>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div style="padding: 10px; background: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 15px;">✨ <?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="book-grid">
        <?php foreach($buku as $b): ?>
            <div class="book-card" id="book-row-<?= $b['id_buku'] ?>">
                <span class="stok-badge">Stok: <?= $b['stok'] ?></span>
                
                <img src="<?= base_url('uploads/buku/' . ($b['foto'] ?: 'default.jpg')) ?>" 
                     style="width: 100%; height: 250px; object-fit: cover; border-bottom: 2px solid #3d2b1f;">

                <div class="book-info">
                    <strong style="font-size: 1.1rem; color: var(--hp-red); display: block; height: 50px; overflow: hidden;"><?= $b['judul']; ?></strong>
                    <small><i><?= $b['penulis']; ?></i></small>
                    
                    <div style="margin-top: 10px;">
                        <?php 
                            $db = \Config\Database::connect();
                            $query = $db->query("SELECT AVG(CAST(rating AS UNSIGNED)) as rata_rating FROM peminjaman WHERE id_buku = ? AND status = 'kembali'", [$b['id_buku']]);
                            $ratavg = $query->getRow()->rata_rating;
                            $stars = round($ratavg ?: 0);
                            for($i=1; $i<=5; $i++) echo ($i <= $stars) ? '<span style="color:#f1c40f;">★</span>' : '<span style="color:#ccc;">★</span>';
                        ?>
                    </div>
                </div>

                <div style="padding: 10px; background: rgba(0,0,0,0.05);">
                    <?php if (session()->get('role') == 'anggota'): ?>
                        <?php if ($b['stok'] > 0): ?>
                            <a href="<?= base_url('peminjaman/pinjam/' . $b['id_buku']) ?>" 
                               class="btn-magic btn-pinjam"
                               onclick="return confirm('Pinjam kitab ini?')">📜 Pinjam</a>
                        <?php else: ?>
                            <div class="btn-magic" style="background: #ccc; color: #666;">🚫 Kosong</div>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?= base_url('buku/edit/' . $b['id_buku']) ?>" class="btn-magic btn-edit">Edit Kitab</a>
                        <button type="button" onclick="mantraBakar('<?= $b['id_buku'] ?>', '<?= addslashes($b['judul']) ?>')" class="btn-magic btn-burn w-100 mt-1">
                            🔥 Bakar
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($buku)): ?>
        <div style="text-align: center; padding: 50px; font-style: italic;">Rak buku masih kosong, Rij. Belum ada mantra yang tercatat.</div>
    <?php endif; ?>
</div>

<script>
function mantraBakar(id, judul) {
    console.log("Mantra dibacakan untuk ID: " + id); 
    
    if (typeof Swal === 'undefined') {
        if(confirm("Bakar kitab " + judul + "?")) {
            eksekusiBakar(id);
        }
    } else {
        Swal.fire({
            title: 'INCENDIO! 🔥',
            text: "Hanguskan '" + judul + "' dari perpustakaan?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5c0909',
            cancelButtonColor: '#3d2b1f',
            confirmButtonText: 'Ya, Bakar!',
            cancelButtonText: 'Batal',
            background: '#f4e4bc',
            color: '#5c0909'
        }).then((result) => {
            if (result.isConfirmed) {
                eksekusiBakar(id);
            }
        });
    }
}

function eksekusiBakar(id) {
    const elemen = document.getElementById('book-row-' + id);
    if(elemen) {
        // Tambahkan class untuk memicu animasi CSS
        elemen.classList.add('burning'); 
        
        // Tunggu animasi selesai (1.2 detik) baru pindah halaman
        setTimeout(() => {
            window.location.href = "<?= base_url('buku/delete/') ?>/" + id;
        }, 1150);
    } else {
        // Fallback jika ID tidak ditemukan
        window.location.href = "<?= base_url('buku/delete/') ?>/" + id;
    }
}
</script>

<?= $this->endSection() ?>