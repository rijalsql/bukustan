<?= $this->extend('layouts/main') ?> <?= $this->section('content') ?>

<div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 20px;">
    <h2 style="color: #333; margin-bottom: 25px; border-left: 5px solid #5c0909; padding-left: 15px;">
        Dashboard Administrator
    </h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        
        <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-top: 4px solid #1e7e34;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="color: #666; margin: 0; font-size: 14px; text-transform: uppercase;">Total Denda Masuk</p>
                    <h2 style="color: #1e7e34; margin: 10px 0; font-size: 28px;">
                        Rp <?= number_format($total_denda_masuk, 0, ',', '.') ?>
                    </h2>
                </div>
                <div style="font-size: 40px;">💰</div>
            </div>
            <p style="color: #888; font-size: 12px; margin: 0;">* Berdasarkan denda yang sudah berstatus LUNAS</p>
        </div>

        <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-top: 4px solid #5c0909;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="color: #666; margin: 0; font-size: 14px; text-transform: uppercase;">Peminjaman Aktif</p>
                    <h2 style="color: #5c0909; margin: 10px 0; font-size: 28px;">
                        <?= $total_pinjam ?? 0 ?>
                    </h2>
                </div>
                <div style="font-size: 40px;">📚</div>
            </div>
            <p style="color: #888; font-size: 12px; margin: 0;">Buku yang sedang dibawa anggota</p>
        </div>

    </div>

    <div style="margin-top: 30px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h4 style="margin-top: 0; color: #333;">Selamat Datang, Admin!</h4>
        <p style="color: #555;">Melalui halaman ini, Anda dapat memantau statistik perpustakaan termasuk pendapatan dari denda keterlambatan secara real-time.</p>
    </div>
</div>

<?= $this->endSection() ?>