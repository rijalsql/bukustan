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

    /* Card Styling */
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

    /* Form Label & Input */
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
        background-color: #ffffff;
    }

    .form-control-modern:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    /* Preview Foto */
    .file-input-wrapper {
        border: 2px dashed var(--border-color);
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        transition: 0.3s;
        background: var(--bg-light);
    }

    .file-input-wrapper:hover {
        border-color: var(--primary-blue);
        background: #eff6ff;
    }

    /* Button Styling */
    .btn-modern {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-save-modern {
        background-color: var(--primary-blue);
        color: white;
        border: none;
    }

    .btn-save-modern:hover {
        background-color: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .btn-cancel-modern {
        background-color: #f1f5f9;
        color: #64748b;
        border: none;
        text-decoration: none;
    }

    .btn-cancel-modern:hover {
        background-color: #e2e8f0;
        color: var(--dark-slate);
    }

    /* Helper Text */
    .helper-text {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-top: 6px;
    }
</style>

<div class="container form-container">
    <div class="modern-card">
        <div class="card-header-modern">
            <h4>
                <div style="width: 40px; height: 40px; background: #eff6ff; color: var(--primary-blue); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-plus"></i>
                </div>
                Tambah Koleksi Buku Baru
            </h4>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <form action="<?= base_url('buku/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label class="form-label-modern">Judul Buku</label>
                        <input type="text" name="judul" class="form-control form-control-modern" placeholder="Contoh: Pemrograman Web dengan PHP" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-modern">Nama Penulis</label>
                        <input type="text" name="penulis" class="form-control form-control-modern" placeholder="Masukkan nama penulis..." required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-modern">Kategori</label>
                        <select name="kategori" class="form-select form-control-modern" required>
                            <option value="" selected disabled>-- Pilih Kategori --</option>
                            <option value="Kitab">Kitab</option>
                            <option value="Novel">Novel</option>
                            <option value="Cerita">Cerita</option>
                            <option value="Ilmu">Ilmu</option>
                            <option value="Teknik">Teknik</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-modern">Jumlah Stok</label>
                        <div class="input-group">
                            <span class="input-group-text border-0 bg-transparent ps-0"><i class="fas fa-boxes text-muted"></i></span>
                            <input type="number" name="stok" class="form-control form-control-modern" placeholder="0" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-modern">Denda Per Hari (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text border-0 bg-transparent ps-0 text-muted">Rp</span>
                            <input type="number" name="denda_per_hari" class="form-control form-control-modern" value="2000" required>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label class="form-label-modern">Cover Buku</label>
                        <div class="file-input-wrapper">
                            <i class="fas fa-cloud-upload-alt mb-2 text-primary" style="font-size: 2rem;"></i>
                            <input type="file" name="foto" class="form-control border-0 bg-transparent" accept="image/*">
                            <p class="helper-text mb-0">Format: JPG, PNG (Max. 2MB)</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex justify-content-end gap-3">
                    <a href="<?= base_url('buku') ?>" class="btn-modern btn-cancel-modern">
                        Batal
                    </a>
                    <button type="submit" class="btn-modern btn-save-modern">
                        <i class="fas fa-save"></i> Simpan Koleksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>