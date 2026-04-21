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

    .hp-profile-container {
        font-family: 'Crimson Text', serif;
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    /* Card ala Dokumen Rahasia */
    .hp-profile-card {
        background-color: var(--hp-parchment);
        background-image: url('https://www.transparenttextures.com/patterns/parchment.png');
        border: 3px solid #3d2b1f;
        box-shadow: 0 15px 35px rgba(0,0,0,0.6);
        border-radius: 0;
        overflow: visible;
        width: 100%;
        max-width: 550px;
        position: relative;
    }

    /* Banner Status Kedudukan */
    .hp-header-banner {
        height: 120px;
        border-bottom: 3px solid #3d2b1f;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bg-hp-red { background-color: var(--hp-red); }
    .bg-hp-blue { background-color: #0e1a40; } /* Ravenclaw Style */
    .bg-hp-green { background-color: #1a472a; } /* Slytherin Style */
    .bg-hp-neutral { background-color: #3d2b1f; }

    .hp-avatar-wrapper {
        position: absolute;
        top: 60px;
        left: 50%;
        transform: translateX(-50%);
    }

    .hp-avatar-frame {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border: 5px solid #3d2b1f;
        background-color: #fff;
        padding: 3px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    .hp-initial-frame {
        width: 130px;
        height: 130px;
        border: 5px solid #3d2b1f;
        background-color: #eee;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'MedievalSharp', cursive;
        font-size: 50px;
        color: #3d2b1f;
    }

    .hp-content {
        padding: 85px 40px 40px 40px;
        text-align: center;
    }

    .hp-name {
        font-family: 'MedievalSharp', cursive;
        color: var(--hp-red);
        font-size: 2.2rem;
        margin-bottom: 5px;
    }

    .hp-label {
        font-family: 'MedievalSharp', cursive;
        color: #5d4037;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        display: block;
        margin-bottom: 2px;
    }

    .hp-value {
        color: var(--hp-ink);
        font-weight: 700;
        font-size: 1.1rem;
        display: block;
        margin-bottom: 15px;
    }

    .hp-stamp {
        position: absolute;
        bottom: 20px;
        right: 20px;
        opacity: 0.2;
        transform: rotate(-15deg);
        pointer-events: none;
    }

    .btn-hp-action {
        font-family: 'MedievalSharp', cursive;
        border-radius: 0;
        border: 2px solid #3d2b1f;
        transition: 0.3s;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .btn-hp-edit {
        background: var(--hp-gold);
        color: var(--hp-red);
    }

    .btn-hp-edit:hover {
        background: var(--hp-red);
        color: var(--hp-gold);
    }

    .back-link {
        font-family: 'MedievalSharp', cursive;
        color: var(--hp-gold);
        text-decoration: none;
        transition: 0.3s;
    }

    .back-link:hover {
        color: #fff;
        text-shadow: 0 0 5px var(--hp-gold);
    }
</style>

<div class="hp-profile-container">
    <div class="w-100" style="max-width: 550px;">
        
        <div class="mb-4">
            <a href="<?= base_url('users') ?>" class="back-link">
                <i class="fas fa-reply me-2"></i> Kembali ke Kroco List
            </a>
        </div>

        <div class="hp-profile-card">
            <?php 
                $headerClass = 'bg-hp-neutral';
                $roleLabel = 'Warga Sihir';
                
                if($user['role'] == 'admin') {
                    $headerClass = 'bg-hp-red';
                    $roleLabel = 'Admin';
                } elseif($user['role'] == 'petugas') {
                    $headerClass = 'bg-hp-blue';
                    $roleLabel = 'Petugas';
                } elseif($user['role'] == 'anggota') {
                    $headerClass = 'bg-hp-green';
                    $roleLabel = 'Anggota';
                }
            ?>
            
            <div class="hp-header-banner <?= $headerClass ?>">
                <h4 class="text-white font-monospace opacity-50" style="letter-spacing: 5px;">BUKUSTAN PROJECT</h4>
            </div>

            <div class="hp-avatar-wrapper">
                <?php if ($user['foto']): ?>
                    <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" class="hp-avatar-frame shadow">
                <?php else: ?>
                    <div class="hp-initial-frame shadow">
                        <?= substr($user['nama'], 0, 1) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="hp-content">
                <div class="mb-4">
                    <h3 class="hp-name"><?= $user['nama'] ?></h3>
                    <span class="badge rounded-0 px-3 py-2 <?= $headerClass ?>" style="font-family: 'MedievalSharp';">
                        <?= strtoupper($roleLabel) ?>
                    </span>
                </div>

                <div class="hp-stamp">
                    <i class="fas fa-dragon fa-5x"></i>
                </div>

                <hr style="border-top: 2px dashed #3d2b1f; opacity: 0.3;">

                <div class="row text-start mt-4">
                    <div class="col-6 mb-3">
                        <span class="hp-label">E-mail</span>
                        <span class="hp-value"><?= $user['email'] ?></span>
                    </div>
                    <div class="col-6 mb-3">
                        <span class="hp-label">Nama </span>
                        <span class="hp-value">@<?= $user['username'] ?></span>
                    </div>
                    <div class="col-6 mb-3">
                        <span class="hp-label"> Sandi</span>
                        <span class="hp-value text-muted italic">•••••••• (AURAT)</span>
                    </div>
                    <div class="col-6 mb-3">
                        <span class="hp-label">Kode Registrasi</span>
                        <span class="hp-value">#USR-<?= str_pad($user['id'], 4, '0', STR_PAD_LEFT) ?></span>
                    </div>
                </div>

                <div class="mt-5 d-flex flex-wrap justify-content-center gap-3">
                    <?php if (session()->get('role') == 'admin') : ?>
                        <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-hp-action btn-hp-edit px-4 shadow-sm">
                            <i class="fas fa-magic me-2"></i>Ubah Biodata
                        </a>
                    <?php endif; ?>
                    <a href="<?= base_url('users/wa/' . $user['id']) ?>" target="_blank" class="btn btn-hp-action btn-outline-dark px-4 bg-white">
                        <i class="fab fa-whatsapp me-2"></i>Kirim Pesan
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mt-4 text-white-50 small italic">
            <p>Dokumen ini diterbitkan oleh Departemen Manajemen BUKUSTAN</p>
        </div>

    </div>
</div>

<?= $this->endSection() ?>