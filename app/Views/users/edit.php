<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Crimson+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

<style>
    :root {
        --hp-gold: #ffc500;
        --hp-red: #740001;
        --hp-ink: #2b2b2b;
        --hp-parchment: #f4e1d2;
    }

    .hp-edit-container {
        font-family: 'Crimson Text', serif;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .hp-back-link {
        font-family: 'MedievalSharp', cursive;
        color: var(--hp-gold);
        text-decoration: none;
        transition: 0.3s;
        font-size: 0.9rem;
    }

    .hp-back-link:hover {
        color: #fff;
        text-shadow: 0 0 5px var(--hp-gold);
    }

    /* Card Formulir Perkamen */
    .hp-card-form {
        background-color: var(--hp-parchment);
        background-image: url('https://www.transparenttextures.com/patterns/parchment.png');
        border: 3px solid #3d2b1f;
        border-radius: 0;
        box-shadow: 0 15px 35px rgba(0,0,0,0.5);
    }

    .hp-card-header {
        border-bottom: 2px double #3d2b1f;
        background: transparent;
        text-align: center;
        padding: 30px;
    }

    .hp-form-title {
        font-family: 'MedievalSharp', cursive;
        color: var(--hp-red);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 0;
    }

    .hp-form-label {
        font-family: 'MedievalSharp', cursive;
        color: #3d2b1f;
        text-transform: uppercase;
        font-size: 0.85rem;
        font-weight: bold;
    }

    /* Input Style Jadul */
    .hp-form-input {
        background: rgba(255, 255, 255, 0.4) !important;
        border: 1px solid #3d2b1f !important;
        border-radius: 0 !important;
        color: var(--hp-ink) !important;
        padding: 10px 15px;
    }

    .hp-form-input:focus {
        background: rgba(255, 255, 255, 0.7) !important;
        box-shadow: none;
        border-color: var(--hp-red) !important;
    }

    .hp-input-group-text {
        background: #3d2b1f !important;
        color: var(--hp-gold) !important;
        border: 1px solid #3d2b1f !important;
        border-radius: 0 !important;
    }

    /* Upload Foto Frame */
    .hp-upload-box {
        border: 2px dashed #3d2b1f !important;
        background: rgba(255, 255, 255, 0.2);
        padding: 20px;
        border-radius: 0;
    }

    .hp-btn-save {
        font-family: 'MedievalSharp', cursive;
        background-color: var(--hp-red);
        color: var(--hp-gold);
        border: 2px solid var(--hp-gold);
        border-radius: 0;
        padding: 12px;
        font-size: 1.1rem;
        transition: 0.3s;
        text-transform: uppercase;
    }

    .hp-btn-save:hover {
        background-color: var(--hp-gold);
        color: var(--hp-red);
        border-color: var(--hp-red);
    }

    .hp-footer-note {
        font-style: italic;
        color: #5d4037;
        font-size: 0.85rem;
        text-align: center;
        margin-top: 20px;
    }
</style>

<div class="container hp-edit-container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            
            <div class="mb-4">
                <?php if (session()->get('role') == 'admin') : ?>
                    <a href="<?= base_url('users') ?>" class="hp-back-link">
                        <i class="fas fa-quill-pen me-2"></i> Kembali ke Kroco List
                    </a>
                <?php else : ?>
                    <a href="<?= base_url('dashboard') ?>" class="hp-back-link">
                        <i class="fas fa-fort-awesome me-2"></i> Kembali Dashboard
                    </a>
                <?php endif; ?>
            </div>

            <div class="card hp-card-form">
                <div class="hp-card-header">
                    <h3 class="hp-form-title">Revisi Identitas</h3>
                    <p class="text-muted small italic mb-0">Pastikan setiap informasi sudah tertulis dengan benar.</p>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    <form action="<?= base_url('users/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="hp-form-label">Nama Lengkap </label>
                                <input type="text" name="nama" class="form-control hp-form-input" value="<?= $user['nama'] ?>" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="hp-form-label">Email</label>
                                <input type="email" name="email" class="form-control hp-form-input" value="<?= $user['email'] ?>" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="hp-form-label">Nama Kroco</label>
                                <div class="input-group">
                                    <span class="hp-input-group-text">@</span>
                                    <input type="text" name="username" class="form-control hp-form-input" value="<?= $user['username'] ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="hp-form-label"> Sandi Baru</label>
                                <input type="password" name="password" class="form-control hp-form-input" placeholder="Biarkan kosong jika tetap">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="hp-form-label"> Hak Akses</label>
                                <select name="role" class="form-select hp-form-input" <?= (session()->get('role') != 'admin') ? 'disabled' : '' ?>>
                                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin </option>
                                    <option value="petugas" <?= $user['role'] == 'petugas' ? 'selected' : '' ?>>Petugas </option>
                                    <option value="anggota" <?= $user['role'] == 'anggota' ? 'selected' : '' ?>>Anggota</option>
                                </select>
                                <?php if (session()->get('role') != 'admin'): ?>
                                    <input type="hidden" name="role" value="<?= $user['role'] ?>">
                                    <small class="text-danger italic" style="font-size: 10px;">*Hanya ORANG DALAM yang dapat mengubah ini.</small>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-12 mb-5">
                                <label class="hp-form-label">Foto Profil</label>
                                <div class="hp-upload-box d-flex align-items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <?php if ($user['foto']): ?>
                                            <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" class="border border-dark shadow-sm" width="70" height="70" style="object-fit: cover; border-width: 2px !important;">
                                        <?php else: ?>
                                            <div class="bg-dark text-white d-flex align-items-center justify-content-center border border-dark shadow-sm" style="width: 70px; height: 70px;">
                                                <i class="fas fa-user-secret fa-2x"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <input type="file" name="foto" class="form-control form-control-sm hp-form-input">
                                        <small class="text-muted mt-2 d-block" style="font-size: 0.8rem;">Gunakan format : JPG, PNG, atau JPEG.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid mt-2">
                            <button type="submit" class="btn hp-btn-save shadow">
                                <i class="fas fa-feather-alt me-2"></i>  atoss ? simpen !
                            </button>
                        </div>

                    </form>
                    
                    <div class="hp-footer-note">
                        "Dengan menekan tombol di atas, Anda menyatakan bahwa data ini benar adanya."
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>