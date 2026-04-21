<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container" style="padding: 20px; font-family: 'Crimson Text', serif;">
    <a href="<?= base_url('buku') ?>" style="text-decoration: none; color: #740001; font-weight: bold;">
        ← Kembali ke Rak Buku
    </a>
    
    <div style="display: flex; gap: 40px; margin-top: 20px; background: #f4e1d2; background-image: url('https://www.transparenttextures.com/patterns/parchment.png'); padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.3); border: 2px solid #3d2b1f;">
        
        <div style="flex: 1; max-width: 300px;">
            <img src="<?= base_url('uploads/buku/' . ($buku['foto'] ?: 'default.jpg')) ?>" 
                 style="width: 100%; border-radius: 10px; box-shadow: 5px 5px 15px rgba(0,0,0,0.5); border: 3px solid #3d2b1f;">
        </div>

        <div style="flex: 2;">
            <span style="background: #740001; color: #ffc500; padding: 5px 15px; border-radius: 5px; font-size: 12px; font-weight: bold; text-transform: uppercase; border: 1px solid #ffc500; font-family: 'MedievalSharp';">
                <?= $buku['kategori']; ?>
            </span>
            
            <h1 style="margin-top: 15px; margin-bottom: 5px; font-family: 'MedievalSharp'; color: #740001;"><?= $buku['judul']; ?></h1>
            <p style="font-size: 18px; color: #3d2b1f; margin-bottom: 20px; font-style: italic;">Penulis: <strong><?= $buku['penulis']; ?></strong></p>

            <div style="display: flex; gap: 20px; margin-bottom: 30px;">
                <div style="background: rgba(255,255,255,0.5); padding: 15px; border-radius: 10px; text-align: center; min-width: 100px; border: 1px solid #3d2b1f;">
                    <small style="display: block; color: #3d2b1f; font-weight: bold;">STOK</small>
                    <strong style="font-size: 20px; color: <?= $buku['stok'] > 0 ? '#27ae60' : '#e74c3c' ?>;">
                        <?= $buku['stok']; ?>
                    </strong>
                </div>
                <div style="background: rgba(255,255,255,0.5); padding: 15px; border-radius: 10px; text-align: center; min-width: 100px; border: 1px solid #3d2b1f;">
                    <small style="display: block; color: #3d2b1f; font-weight: bold;">RATING</small>
                    <strong style="font-size: 20px; color: #b8860b;">
                        <?= isset($buku['rata_rating']) ? round($buku['rata_rating'], 1) : '0'; ?> ★
                    </strong>
                </div>
                <div style="background: rgba(255,255,255,0.5); padding: 15px; border-radius: 10px; text-align: center; min-width: 150px; border: 1px solid #3d2b1f;">
                    <small style="display: block; color: #3d2b1f; font-weight: bold;">DENDA / HARI</small>
                    <strong style="font-size: 18px; color: #740001;">Rp <?= number_format($buku['denda_per_hari'], 0, ',', '.'); ?></strong>
                </div>
            </div>

            <div style="border-top: 2px double #3d2b1f; padding-top: 20px;">
                <?php if(session()->get('role') == 'anggota' && $buku['stok'] > 0): ?>
                    <a href="<?= base_url('peminjaman/pinjam/' . $buku['id_buku']) ?>" 
                       style="background: #740001; color: #ffc500; text-decoration: none; padding: 12px 30px; border-radius: 8px; font-weight: bold; display: inline-block; border: 2px solid #ffc500; font-family: 'MedievalSharp';">
                       📜 Pinjam Sekarang
                    </a>
                <?php elseif(session()->get('role') == 'admin'): ?>
                    <a href="<?= base_url('buku/edit/' . $buku['id_buku']) ?>" 
                       style="background: #ffc500; color: #740001; text-decoration: none; padding: 12px 30px; border-radius: 8px; font-weight: bold; display: inline-block; border: 2px solid #740001; font-family: 'MedievalSharp';">
                       ✍️ Edit Data Buku
                    </a>
                <?php else: ?>
                    <button disabled style="background: #ccc; color: white; border: none; padding: 12px 30px; border-radius: 8px; cursor: not-allowed; font-family: 'MedievalSharp';">
                        🚫 Stok Habis
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div style="margin-top: 50px;">
        <h2 style="font-family: 'MedievalSharp'; color: #ffc500; text-shadow: 2px 2px 4px #000; border-bottom: 2px solid #ffc500; padding-bottom: 10px;">
            📜  Ulasan Anggota
        </h2>

        <?php if (!empty($ulasan)): ?>
            <div style="display: grid; gap: 20px; margin-top: 25px;">
                <?php foreach ($ulasan as $u): ?>
                    <div style="background: #fdf5e6; border-left: 8px solid #740001; padding: 20px; border-radius: 5px; box-shadow: 5px 5px 15px rgba(0,0,0,0.2); border: 1px solid #3d2b1f;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <strong style="color: #740001; font-size: 1.2rem; font-family: 'MedievalSharp';"><?= htmlspecialchars($u['nama']) ?></strong>
                            <div style="color: #b8860b; font-size: 1.2rem;">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?= $i <= $u['rating'] ? '★' : '☆' ?>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <p style="font-style: italic; color: #2b2b2b; font-size: 1.1rem; line-height: 1.5; margin: 0;">
                            "<?= htmlspecialchars($u['ulasan']) ?>"
                        </p>
                        <small style="color: #5d4037; font-size: 0.85rem; display: block; margin-top: 15px; text-align: right; font-weight: bold;">
                            — Selesai dibaca pada <?= date('d M Y', strtotime($u['tgl_kembali'])) ?>
                        </small>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 40px; border: 2px dashed #ffc500; color: #f4e1d2; margin-top: 20px; background: rgba(0,0,0,0.2); border-radius: 10px;">
                <p style="font-size: 1.2rem; font-style: italic;">Belum ada ulasan untuk buku ini. Jadilah Kroco pertama yang memberikan kesan!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>