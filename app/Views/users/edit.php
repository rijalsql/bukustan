<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-blue: #2563eb;
        --bg-body: #f8fafc;
        --border-color: #e2e8f0;
        --text-dark: #1e293b;
        --text-muted: #64748b;
    }

    body {
        background-color: var(--bg-body);
        font-family: 'Inter', sans-serif;
    }

    .edit-user-container {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    /* Back Link Style */
    .back-nav {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        color: var(--text-muted);
        font-weight: 500;
        font-size: 0.9rem;
        transition: 0.2s;
        margin-bottom: 1.5rem;
    }

    .back-nav:hover {
        color: var(--primary-blue);
    }

    /* Modern Card */
    .modern-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .card-header-gradient {
        background: white;
        padding: 2rem;
        border-bottom: 1px solid var(--border-color);
        text-align: center;
    }

    .card-header-gradient h3 {
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }

    /* Form Elements */
    .form-label-modern {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .form-control-modern {
        border-radius: 12px;
        border: 1.5px solid var(--border-color);
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.2s ease-in-out;
    }

    .form-control-modern:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    .input-group-text-modern {
        background: #f1f5f9;
        border: 1.5px solid var(--border-color);
        border-right: none;
        border-radius: 12px 0 0 12px;
        color: var(--text-muted);
        font-weight: 600;
    }

    .form-control-modern.has-group {
        border-radius: 0 12px 12px 0;
    }

    /* Profile Photo Upload Section */
    .photo-upload-section {
        background: #f8fafc;
        border: 2px dashed var(--border-color);
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: 0.2s;
    }

    .photo-upload-section:hover {
        border-color: var(--primary-blue);
        background: #eff6ff;
    }

    .current-avatar {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 14px;
        border: 3px solid white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .avatar-placeholder {
        width: 80px;
        height: 80px;
        background: var(--text-dark);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 1.5rem;
    }

    /* Submit Button */
    .btn-save-modern {
        background: var(--primary-blue);
        color: white;
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
    }

    .btn-save-modern:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
    }

    .badge-lock {
        font-size: 0.7rem;
        background: #fee2e2;
        color: #b91c1c;
        padding: 4px 8px;
        border-radius: 6px;
        margin-top: 5px;
        display: inline-block;
    }
</style>

<div class="container edit-user-container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">

            <div class="mb-2">
                <?php if (session()->get('role') == 'admin') : ?>
                    <a href="<?= base_url('users') ?>" class="back-nav">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pengguna
                    </a>
                <?php else : ?>
                    <a href="<?= base_url('dashboard') ?>" class="back-nav">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </a>
                <?php endif; ?>
            </div>

            <div class="modern-card">
                <div class="card-header-gradient">
                    <h3>Pengaturan Profil</h3>
                    <p class="text-muted small mb-0">Perbarui informasi akun Anda untuk menjaga keamanan data.</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="<?= base_url('users/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label-modern">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control form-control-modern" value="<?= $user['nama'] ?>" placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label-modern">Alamat Email</label>
                                <input type="email" name="email" class="form-control form-control-modern" value="<?= $user['email'] ?>" placeholder="nama@email.com" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label-modern">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-modern">@</span>
                                    <input type="text" name="username" class="form-control form-control-modern has-group" value="<?= $user['username'] ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label-modern">Kata Sandi Baru</label>
                                <input type="password" name="password" class="form-control form-control-modern" placeholder="Kosongkan jika tidak diganti">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label-modern">Hak Akses Akun</label>
                                <select name="role" class="form-select form-control-modern" <?= (session()->get('role') != 'admin') ? 'disabled' : '' ?>>
                                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Administrator</option>
                                    <option value="petugas" <?= $user['role'] == 'petugas' ? 'selected' : '' ?>>Petugas Perpustakaan</option>
                                    <option value="anggota" <?= $user['role'] == 'anggota' ? 'selected' : '' ?>>Anggota</option>
                                </select>
                                <?php if (session()->get('role') != 'admin'): ?>
                                    <input type="hidden" name="role" value="<?= $user['role'] ?>">
                                    <span class="badge-lock"><i class="fas fa-lock me-1"></i> Terkunci oleh Sistem</span>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label-modern">Status Keanggotaan</label>
                                <select name="status" class="form-select form-control-modern" <?= (session()->get('role') != 'admin') ? 'disabled' : '' ?>>
                                    <option value="aktif" <?= $user['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="nonaktif" <?= $user['status'] == 'nonaktif' ? 'selected' : '' ?>>Non-Aktif</option>
                                    <option value="banned" <?= $user['status'] == 'banned' ? 'selected' : '' ?>>Ditangguhkan (Banned)</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-5">
                                <label class="form-label-modern">Foto Profil</label>
                                <div class="photo-upload-section">
                                    <div class="flex-shrink-0">
                                        <?php if ($user['foto']): ?>
                                            <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" class="current-avatar">
                                        <?php else: ?>
                                            <div class="avatar-placeholder">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <input type="file" name="foto" class="form-control form-control-sm form-control-modern">
                                        <small class="text-muted mt-2 d-block">Direkomendasikan rasio 1:1 (Format: JPG, PNG, JPEG).</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-save-modern">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan Profil
                            </button>
                        </div>

                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted italic" style="font-size: 0.8rem;">
                            Terakhir diperbarui: <span class="fw-bold"><?= date('d M Y') ?></span>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>