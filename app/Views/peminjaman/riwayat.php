<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="font-family: 'Georgia', serif; background: #f4e4bc; padding: 20px; border-radius: 15px; border: 2px solid #3d2b1f; box-shadow: 5px 5px 15px rgba(0,0,0,0.2);">
    <h2 style="color: #5c0909; text-align: center; text-transform: uppercase; letter-spacing: 2px; border-bottom: 2px double #3d2b1f; padding-bottom: 10px;">
        📜 Riwayat Peminjaman Saya 📜
    </h2>

    <?php if(session()->getFlashdata('success')): ?>
        <div id="notif-success" style="padding: 10px; background: #d4edda; color: #155724; margin-bottom: 15px; border-radius: 5px; border: 1px solid #c3e6cb; text-align: center; font-weight: bold;">
            ✨ <?= session()->getFlashdata('success') ?> ✨
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
        <div id="notif-error" style="padding: 10px; background: #f8d7da; color: #721c24; margin-bottom: 15px; border-radius: 5px; border: 1px solid #f5c6cb; text-align: center; font-weight: bold;">
            ⚠️ <?= session()->getFlashdata('error') ?> ⚠️
        </div>
    <?php endif; ?>

    <table width="100%" cellpadding="10" style="border-collapse: collapse; background: rgba(255,255,255,0.3); border: 1px solid #3d2b1f;">
        <thead>
            <tr style="background-color: #5c0909; color: #d4af37; border-bottom: 3px solid #d4af37;">
                <th>No</th>
                <th>Buku</th>
                <th>Waktu Pinjam</th>
                <th>Denda</th>
                <th>Status</th>
                <th>Rating & Ulasan</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($riwayat as $r): 
                $tgl_deadline = strtotime($r['tgl_kembali']);
                $tgl_sekarang = time();
                $is_telat = ($tgl_sekarang > $tgl_deadline && !in_array($r['status'], ['kembali', 'hilang']));
                $denda_tampil = ($is_telat) ? floor(($tgl_sekarang - $tgl_deadline) / (60 * 60 * 24)) * 2000 : 0;
            ?>
            <tr style="border-bottom: 1px solid #3d2b1f;">
                <td align="center"><b><?= $no++; ?></b></td>
                <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <img src="<?= base_url('uploads/buku/' . ($r['foto'] ?: 'default.jpg')) ?>" width="45" height="65" style="object-fit: cover; border: 1px solid #3d2b1f; border-radius: 3px;">
                        <div>
                            <strong style="color: #3d2b1f;"><?= $r['judul']; ?></strong>
                        </div>
                    </div>
                </td>
                <td>
                    <small>📌 Pinjam: <?= date('d M Y', strtotime($r['tgl_pinjam'])); ?></small><br>
                    <small style="color: <?= $is_telat ? '#dc3545' : '#c0392b' ?>; font-weight: bold;">⌛ Batas: <?= date('d M Y', strtotime($r['tgl_kembali'])); ?></small>
                </td>
                <td align="center">
                    <?php if ($r['status'] == 'hilang'): ?>
                        <b style="color: #dc3545;">GANTI BUKU</b>
                    <?php elseif ($r['status'] == 'kembali'): ?>
                        <b style="color: #1e7e34;">Rp <?= number_format($r['total_denda'], 0, ',', '.') ?> (Lunas)</b>
                    <?php elseif ($is_telat): ?>
                        <b style="color: #dc3545;">Rp <?= number_format($denda_tampil, 0, ',', '.') ?></b>
                    <?php else: ?>
                        <small style="color: gray;">-</small>
                    <?php endif; ?>
                </td>
                <td align="center">
                    <?php if($r['status'] == 'pending_pinjam'): ?>
                        <span style="padding: 4px 8px; background: #e2e3e5; color: #383d41; border-radius: 4px; font-size: 10px;">Menunggu Persetujuan</span>
                    <?php elseif($r['status'] == 'dipinjam'): ?>
                        <span style="padding: 4px 8px; background: #fff3cd; color: #856404; border-radius: 4px; font-size: 10px; border: 1px solid #856404;">Sedang Dipinjam</span>
                    <?php elseif($r['status'] == 'pending_kembali'): ?>
                        <span style="padding: 4px 8px; background: #cce5ff; color: #004085; border-radius: 4px; font-size: 10px; border: 1px solid #004085;">Proses Pengembalian</span>
                    <?php elseif($r['status'] == 'hilang'): ?>
                        <span style="padding: 4px 8px; background: #f8d7da; color: #721c24; border-radius: 4px; font-size: 10px; font-weight: bold;">BUKU HILANG</span>
                    <?php else: ?>
                        <span style="padding: 4px 8px; background: #d4edda; color: #155724; border-radius: 4px; font-size: 10px;">Selesai</span>
                    <?php endif; ?>
                    
                    <?php if($r['status_bayar'] == 'proses'): ?>
                        <br><small style="color: #004085; font-size: 9px;">Validasi Denda...</small>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($r['status'] == 'kembali'): ?>
                        <?php if($r['rating'] == null): ?>
                            <form action="<?= base_url('peminjaman/beri_rating/' . $r['id_pinjam']) ?>" method="post">
                                <select name="rating" style="font-size: 10px; width: 100%;">
                                    <option value="5">⭐⭐⭐⭐⭐</option>
                                    <option value="4">⭐⭐⭐⭐</option>
                                    <option value="3">⭐⭐⭐</option>
                                    <option value="2">⭐⭐</option>
                                    <option value="1">⭐</option>
                                </select>
                                <input type="text" name="ulasan" placeholder="Ulasan..." style="font-size: 10px; width: 92%; margin-top: 3px;">
                                <button type="submit" style="font-size: 10px; cursor: pointer; margin-top: 3px; width: 100%; background: #5c0909; color: white; border: none; padding: 2px; border-radius: 3px;">Kirim</button>
                            </form>
                        <?php else: ?>
                            <span style="color: #f1c40f;">
                                <?php for($i=1; $i<=$r['rating']; $i++) echo "★"; ?>
                            </span>
                            <br><small style="color: #3d2b1f; font-style: italic;">"<?= $r['ulasan']; ?>"</small>
                        <?php endif; ?>
                    <?php else: ?>
                        <small style="color: gray;">Tersedia setelah kembali</small>
                    <?php endif; ?>
                </td>
                <td align="center">
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        
                        <?php if($r['status'] == 'dipinjam'): ?>
                            <?php if($is_telat && $r['status_bayar'] != 'lunas'): ?>
                                <a href="<?= base_url('peminjaman/bayar_denda/' . $r['id_pinjam']) ?>" target="_blank" style="background: #f1c40f; color: black; padding: 5px; text-decoration: none; border-radius: 4px; font-size: 10px; font-weight: bold; border: 1px solid #3d2b1f;">📲 Bayar DANA</a>
                                
                                <form action="<?= base_url('peminjaman/upload_bukti/' . $r['id_pinjam']) ?>" method="post" enctype="multipart/form-data">
                                    <input type="file" name="bukti_bayar" required style="font-size: 9px; width: 100%;">
                                    <button type="submit" style="background: #e67e22; color: white; border: none; padding: 3px; border-radius: 4px; font-size: 9px; width: 100%; cursor: pointer;">⬆️ Upload Bukti</button>
                                </form>
                            <?php else: ?>
                                <a href="<?= base_url('peminjaman/ajukan_kembali/' . $r['id_pinjam']) ?>" style="background: #2980b9; color: white; padding: 8px 5px; text-decoration: none; border-radius: 4px; font-size: 11px; font-weight: bold; border: 1px solid #1a5276;" onclick="return confirm('Kembalikan buku sekarang?')">🔄 Kembalikan</a>
                            <?php endif; ?>

                        <?php elseif($r['status'] == 'kembali'): ?>
                            <a href="<?= base_url('peminjaman/hapus_riwayat/' . $r['id_pinjam']) ?>" style="background: #c0392b; color: white; padding: 5px; text-decoration: none; border-radius: 4px; font-size: 10px;" onclick="return confirm('Hapus riwayat ini?')">🗑️ Hapus</a>
                        <?php else: ?>
                            <small style="color: gray; font-style: italic;">Menunggu...</small>
                        <?php endif; ?>

                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    setTimeout(function() {
        ['notif-success', 'notif-error'].forEach(id => {
            var notif = document.getElementById(id);
            if (notif) {
                notif.style.transition = "opacity 0.8s ease";
                notif.style.opacity = "0";
                setTimeout(() => notif.remove(), 800);
            }
        });
    }, 4000);
</script>

<?= $this->endSection() ?>