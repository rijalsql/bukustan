<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-blue: #2563eb;
        --dark-slate: #1e293b;
        --border-color: #e2e8f0;
        --bg-light: #f8fafc;
    }

    body {
        background-color: var(--bg-light);
        font-family: 'Inter', sans-serif;
    }

    .form-container {
        max-width: 900px;
        margin: 2rem auto;
    }

    .modern-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-header-modern {
        background: white;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border-color);
    }

    .card-header-modern h4 {
        font-weight: 700;
        color: var(--dark-slate);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .form-label-modern {
        font-weight: 600;
        font-size: 0.85rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .form-control-modern {
        border-radius: 10px;
        border: 1.5px solid var(--border-color);
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.2s;
    }

    .form-control-modern:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    /* Current Image Preview */
    .current-image-wrapper {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 15px;
        background: #f1f5f9;
        border-radius: 12px;
        margin-top: 10px;
    }

    .img-preview-sm {
        width: 80px;
        height: 110px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* Buttons */
    .btn-modern {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
        border: none;
    }

    .btn-update {
        background-color: var(--primary-blue);
        color: white;
    }

    .btn-update:hover {
        background-color: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .btn-back {
        background-color: #f1f5f9;
        color: #64748b;
        text-decoration: none;
    }

    .btn-back:hover {
        background-color: #e2e8f0;
        color: var(--dark-slate);
    }
</style>

<div class="container form-container">
    <div class="modern-card">
        <div class="card-header-modern">
            <h4>
                <div style="width: 40px; height: 40px; background: #fff7ed; color: #f97316; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-edit"></i>
                </div>
                Edit Koleksi Buku
            </h4>
        </div>

        <div class="card-body p-4 p-md-5">
            <form action="<?= base_url('buku/update/' . $buku['id_buku']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_buku" value="<?= $buku['id_buku'] ?>">

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label class="form-label-modern">Judul Buku</label>
                        <input type="text" name="judul" class="form-control form-control-modern" 
                               value="<?= htmlspecialchars($buku['judul']) ?>" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-modern">Penulis</label>
                        <input type="text" name="penulis" class="form-control form-control-modern" 
                               value="<?= htmlspecialchars($buku['penulis']) ?>" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-modern">Kategori</label>
                        <select name="kategori" class="form-select form-control-modern" required>
                            <?php $kats = ['Kitab', 'Novel', 'Cerita', 'Ilmu', 'Teknik']; ?>
                            <?php foreach($kats as $k): ?>
                                <option value="<?= $k ?>" <?= ($buku['kategori'] == $k) ? 'selected' : '' ?>><?= $k ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-modern">Stok Tersedia</label>
                        <input type="number" name="stok" class="form-control form-control-modern" 
                               value="<?= $buku['stok'] ?>" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-modern">Denda Per Hari (Rp)</label>
                        <input type="number" name="denda_per_hari" class="form-control form-control-modern" 
                               value="<?= $buku['denda_per_hari'] ?>" required>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label class="form-label-modern">Update Cover Buku</label>
                        <input type="file" name="foto" class="form-control form-control-modern">
                        
                        <div class="current-image-wrapper mt-3">
                            <?php if ($buku['foto']): ?>
                                <img src="<?= base_url('uploads/buku/' . $buku['foto']) ?>" class="img-preview-sm">
                                <div>
                                    <p class="mb-1 fw-bold text-dark" style="font-size: 0.9rem;">Cover Saat Ini</p>
                                    <p class="text-muted mb-0" style="font-size: 0.8rem;">Abaikan jika tidak ingin mengubah gambar.</p>
                                </div>
                            <?php else: ?>
                                <div class="text-muted italic p-2" style="font-size: 0.85rem;">
                                    <i class="fas fa-image me-1"></i> Belum ada cover terunggah.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex justify-content-end gap-3">
                    <a href="<?= base_url('buku') ?>" class="btn-modern btn-back">
                        Batal
                    </a>
                    <button type="submit" class="btn-modern btn-update">
                        <i class="fas fa-check-circle"></i> Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>