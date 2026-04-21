<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="hp-scroll-container" style="margin: 20px; border: 2px solid #3d2b1f; border-radius: 15px; background: #f4e4bc; box-shadow: 10px 10px 20px rgba(0,0,0,0.3); overflow: hidden; font-family: 'Georgia', serif;">
    
    <div class="hp-header" style="background: #5c0909; padding: 20px; border-bottom: 3px solid #d4af37; text-align: center;">
        <h2 style="margin: 0; color: #d4af37; text-transform: uppercase; letter-spacing: 3px; text-shadow: 2px 2px #000;">
            ⚡ Edit Arsip Buku ⚡
        </h2>
    </div>

    <div class="hp-body" style="padding: 30px; background-image: url('https://www.transparenttextures.com/patterns/parchment.png');">
        <form action="<?= base_url('buku/update/' . $buku['id_buku']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <input type="hidden" name="id_buku" value="<?= $buku['id_buku'] ?>">

            <div style="margin-bottom: 20px;">
                <label style="color: #3d2b1f; font-weight: bold; font-variant: small-caps; font-size: 1.1rem;">📜 Judul Buku</label>
                <input type="text" name="judul" value="<?= htmlspecialchars($buku['judul']) ?>" 
                       style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #3d2b1f; border-radius: 5px; background: rgba(255,255,255,0.5); font-style: italic;" required>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="color: #3d2b1f; font-weight: bold; font-variant: small-caps; font-size: 1.1rem;">✍️ Penulis </label>
                <input type="text" name="penulis" value="<?= htmlspecialchars($buku['penulis']) ?>" 
                       style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #3d2b1f; border-radius: 5px; background: rgba(255,255,255,0.5);" required>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="color: #3d2b1f; font-weight: bold; font-variant: small-caps; font-size: 1.1rem;">🗂️ Kategori</label>
                <select name="kategori" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #3d2b1f; border-radius: 5px; background: rgba(255,255,255,0.5);" required>
                    <?php $kats = ['Kitab', 'Novel', 'Cerita', 'Ilmu', 'Teknik']; ?>
                    <?php foreach($kats as $k): ?>
                        <option value="<?= $k ?>" <?= ($buku['kategori'] == $k) ? 'selected' : '' ?>><?= $k ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-bottom: 20px; display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label style="color: #3d2b1f; font-weight: bold; font-variant: small-caps; font-size: 1.1rem;">📦 Stok Tersedia</label>
                    <input type="number" name="stok" value="<?= $buku['stok'] ?>" 
                           style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #3d2b1f; border-radius: 5px; background: rgba(255,255,255,0.5);" required>
                </div>
                <div style="flex: 1;">
                    <label style="color: #3d2b1f; font-weight: bold; font-variant: small-caps; font-size: 1.1rem;">💰 Upeti Telat (Rp)</label>
                    <input type="number" name="denda_per_hari" value="<?= $buku['denda_per_hari'] ?>" 
                           style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #3d2b1f; border-radius: 5px; background: rgba(255,255,255,0.5);" required>
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="color: #3d2b1f; font-weight: bold; font-variant: small-caps; font-size: 1.1rem;">🖼️ Ganti Visual Buku</label>
                <input type="file" name="foto" style="margin-top: 5px; color: #3d2b1f;"><br>
                
                <div style="margin-top: 15px; padding: 15px; border: 2px dashed #5c0909; width: fit-content; background: rgba(255,255,255,0.3); border-radius: 10px;">
                    <small style="color: #5c0909; display: block; margin-bottom: 8px; font-weight: bold;">Penampakan Saat Ini:</small>
                    <?php if ($buku['foto']): ?>
                        <img src="<?= base_url('uploads/buku/' . $buku['foto']) ?>" width="120" style="border-radius: 5px; border: 2px solid #3d2b1f; box-shadow: 5px 5px 15px rgba(0,0,0,0.2);">
                    <?php else: ?>
                        <span style="color: #777; font-style: italic;">Belum ada penampakan visual</span>
                    <?php endif; ?>
                </div>
            </div>

            <hr style="border: 0; border-top: 2px double #3d2b1f; margin: 30px 0;">

            <div style="text-align: center;">
                <button type="submit" style="background: #5c0909; color: #d4af37; border: 2px solid #d4af37; padding: 12px 30px; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 16px; text-transform: uppercase; transition: 0.3s; box-shadow: 0 4px #000;">
                    Simpan Perubahan 
                </button>
                
                <a href="<?= base_url('buku') ?>" style="text-decoration: none; color: #f4e4bc; background: #3d2b1f; padding: 12px 30px; border-radius: 8px; margin-left: 15px; font-size: 14px; display: inline-block; font-weight: bold; border: 2px solid #3d2b1f;">
                    Kembali ke Perpustakaan
                </a>
            </div>

        </form>
    </div>
</div>

<style>
    button:hover {
        background: #7a0c0c !important;
        transform: translateY(-2px);
    }
    input:focus, select:focus {
        outline: none;
        border-color: #5c0909 !important;
        box-shadow: 0 0 8px rgba(92, 9, 9, 0.4);
    }
</style>

<?= $this->endSection() ?>