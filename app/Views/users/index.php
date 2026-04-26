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

    .hp-container {
        padding: 30px;
        font-family: 'Crimson Text', serif;
    }

    .hp-title {
        font-family: 'MedievalSharp', cursive;
        color: var(--hp-gold);
        text-shadow: 2px 2px 4px #000;
        border-bottom: 2px double var(--hp-gold);
        display: inline-block;
        padding-bottom: 10px;
    }

    /* Card Filter ala Dokumen Kementerian */
    .hp-card-filter {
        background-color: var(--hp-parchment);
        background-image: url('https://www.transparenttextures.com/patterns/parchment.png');
        border: 2px solid #3d2b1f;
        border-radius: 0;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    .form-label-hp {
        font-family: 'MedievalSharp', cursive;
        color: #3d2b1f;
        text-transform: uppercase;
        font-size: 0.8rem;
    }

    .hp-input {
        background: rgba(255,255,255,0.5) !important;
        border: 1px solid #3d2b1f !important;
        border-radius: 0 !important;
        font-family: 'Crimson Text', serif;
    }

    /* Tabel Perkamen */
    .hp-card-table {
        background-color: var(--hp-parchment);
        background-image: url('https://www.transparenttextures.com/patterns/parchment.png');
        border: 3px solid #3d2b1f;
        border-radius: 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .table thead {
        background: #3d2b1f;
        color: var(--hp-parchment);
        font-family: 'MedievalSharp', cursive;
        text-transform: uppercase;
    }

    .hp-text-magic {
        color: var(--hp-red);
        font-weight: bold;
        font-family: 'MedievalSharp', cursive;
    }

    /* Badge Role ala Stempel Lilin */
    .hp-badge {
        font-family: 'MedievalSharp', cursive;
        border-radius: 0;
        padding: 6px 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .bg-hp-admin { background: #740001; color: var(--hp-gold); border: 1px solid var(--hp-gold); }
    .bg-hp-petugas { background: #2f4f4f; color: #fff; }
    .bg-hp-anggota { background: #1b4d3e; color: #fff; }

    .btn-hp {
        font-family: 'MedievalSharp', cursive;
        border-radius: 0;
        transition: 0.3s;
        text-transform: uppercase;
    }

    .btn-hp-gold {
        background: var(--hp-gold);
        color: var(--hp-red);
        border: 1px solid var(--hp-red);
    }

    .btn-hp-gold:hover {
        background: var(--hp-red);
        color: var(--hp-gold);
    }

    .hp-avatar-frame {
        border: 2px solid #3d2b1f;
        padding: 2px;
        background: #fff;
    }
</style>

<div class="hp-container">
    
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="hp-title mb-1">Daftar Pengguna</h2>
            <p class="text-light small italic" style="opacity: 0.8;">Mengelola data dan pendaftaran anggota .</p>
        </div>
        <div>
            <a href="<?= base_url('users/print?' . http_build_query($_GET)) ?>" target="_blank" class="btn btn-hp btn-hp-gold shadow-sm px-4">
                <i class="fas fa-print me-2"></i> Cetak Dokumen
            </a>
        </div>
    </div>

    <div class="card hp-card-filter mb-4">
        <div class="card-body p-4">
            <form method="get" action="" class="row g-3">
                <div class="col-md-5">
                    <label class="form-label-hp fw-bold">Pencarian Identitas</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 border-dark"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="keyword" class="form-control hp-input border-start-0" placeholder="Masukkan nama..." value="<?= $_GET['keyword'] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label-hp fw-bold">Filter Jabatan</label>
                    <select name="role" class="form-select hp-input">
                        <option value="">-- Semua Orang --</option>
                        <option value="admin" <?= (($_GET['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="petugas" <?= (($_GET['role'] ?? '') == 'petugas') ? 'selected' : '' ?>>Petugas </option>
                        <option value="anggota" <?= (($_GET['role'] ?? '') == 'anggota') ? 'selected' : '' ?>>Anggota </option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-hp btn-hp-gold px-4 shadow-sm fw-bold">TEANGG</button>
                    <a href="<?= base_url('users') ?>" class="btn btn-hp btn-outline-dark px-4">RESET</a>
                </div>
            </form>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4" role="alert" style="background-color: #1b4d3e; color: white; border-radius: 0;">
            <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="card hp-card-table shadow-lg">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center py-3" style="width: 60px;">No</th>
                        <th>Profil </th>
                        <th>Nama & E-mail</th>
                        <th>Status </th>
                        <?php if (session()->get('role') == 'admin') : ?>
                            <th class="text-center">Tindakan </th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody style="color: #3d2b1f;">
                    <?php if (!empty($users)): ?>
                        <?php $no = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td class="text-center" style="font-family: 'MedievalSharp'; opacity: 0.7;"><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <?php if ($u['foto']): ?>
                                                <img src="<?= base_url('uploads/users/' . $u['foto']) ?>" class="hp-avatar-frame" width="55" height="55" style="object-fit: cover;">
                                            <?php else: ?>
                                                <div class="bg-dark text-white d-flex align-items-center justify-content-center hp-avatar-frame" style="width: 55px; height: 55px; font-family: 'MedievalSharp';">
                                                    <?= substr($u['nama'], 0, 1) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <div class="hp-text-magic fs-5"><?= $u['nama'] ?></div>
                                            <small class="text-muted small">ID Registrasi: #<?= $u['id'] ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold" style="color: #3d2b1f;"><?= $u['username'] ?></div>
                                    <small class="text-muted"><i class="fas fa-envelope me-1"></i> <?= $u['email'] ?></small>
                                </td>
                                <td>
                                    <?php 
                                        $badge = 'bg-hp-anggota';
                                        if($u['role'] == 'admin') $badge = 'bg-hp-admin';
                                        elseif($u['role'] == 'petugas') $badge = 'bg-hp-petugas';
                                    ?>
                                    <span class="badge hp-badge <?= $badge ?> shadow-sm">
                                        <?= strtoupper($u['role']) ?>
                                    </span>
                                </td>

                                <?php if (session()->get('role') == 'admin') : ?>
                                    <td class="text-center">
                                        <div class="btn-group gap-2">
                                            <a href="<?= base_url('users/detail/' . $u['id']) ?>" class="btn btn-sm btn-outline-dark" title="Lihat Profil" style="border-radius: 0;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('users/edit/' . $u['id']) ?>" class="btn btn-sm btn-outline-dark" title="Ubah Data" style="border-radius: 0;">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                            <a href="<?= base_url('users/wa/' . $u['id']) ?>" target="_blank" class="btn btn-sm btn-outline-success" title="Kirim Pesan" style="border-radius: 0;">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                            <a href="<?= base_url('users/delete/' . $u['id']) ?>" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus penyihir ini dari direktori?')" style="border-radius: 0;">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <p class="hp-text-magic fs-5">Tidak Ada Siapa-siapa.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <?= $pager->links() ?>
    </div>

</div>

<?= $this->endSection() ?>