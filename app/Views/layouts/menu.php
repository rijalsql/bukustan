<a href="#">
    <b>BUKUSTAN</b>
</a><br>

<a href="<?= base_url('/') ?>">
    <i class="bi bi-house"></i> <span>Dashboard</span>
</a><br>

<?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
    <a href="<?= base_url('/users') ?>">
        <i class="bi bi-people"></i> <span>Data Users</span>
    </a><br>

    <a href="<?= base_url('/buku') ?>">
        <i class="bi bi-book"></i> <span>Rak buku</span>
    </a><br>

    <a href="<?= base_url('/peminjaman') ?>">
        <i class="bi bi-journal-check"></i> <span>Peminjaman</span>
    </a><br>
<?php endif; ?>

<?php if (session()->get('role') == 'anggota') : ?>
    <a href="<?= base_url('/stan') ?>">
        <i class="bi bi-book"></i> <span>Rak buku</span>
    </a><br>

    <a href="<?= base_url('riwayat-pinjam') ?>">
        <i class="bi bi-clock-history"></i> <span>Riwayat Pinjam</span>
    </a><br>
<?php endif; ?>

<?php $idu = session('id'); ?>
<a href="<?= base_url('users/edit/' . $idu) ?>">
    <i class="bi bi-key"></i> <span>Setting Profil</span>
</a><br>

<hr>
<div class="user-info">
    Masuk sebagai: <b><?= session('nama'); ?></b> (<i><?= session('role'); ?></i>)<br>
    <img src="<?= base_url('uploads/users/' . (session()->get('foto') ?: 'default-user.jpg')) ?>" height="80" style="border-radius: 50%; object-fit: cover;" />
</div>
<br>

<a href="<?= base_url('/logout') ?>" onclick="return confirm('Yakin ingin keluar?')">
    <i class="bi bi-box-arrow-right"></i> <b>Log Out</b>
</a>