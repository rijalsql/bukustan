<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="font-family: 'Arial', sans-serif; padding: 20px;">
    <h2 style="border-bottom: 2px solid #5c0909; padding-bottom: 10px;">📩 Kotak Masuk</h2>

    <?php if(empty($pesan)): ?>
        <p style="text-align: center; color: gray; margin-top: 50px;">Tidak ada pesan masuk.</p>
    <?php else: ?>
        <?php foreach($pesan as $p): ?>
            <div style="background: <?= $p['is_read'] == '0' ? '#fff9e6' : 'white' ?>; padding: 15px; border-radius: 8px; margin-bottom: 10px; border-left: 5px solid #5c0909; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <div style="display: flex; justify-content: space-between;">
                    <strong style="color: #5c0909;"><?= $p['subjek'] ?></strong>
                    <small style="color: gray;"><?= date('d M Y H:i', strtotime($p['created_at'])) ?></small>
                </div>
                <p style="margin: 10px 0; line-height: 1.5;"><?= $p['pesan'] ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>