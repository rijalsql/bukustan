<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- Variabel Filter & Role ---
$authFilter = ['filter' => 'auth'];
$admin      = ['filter' => 'role:admin'];
$petugas    = ['filter' => 'role:petugas'];
$anggota    = ['filter' => 'role:anggota'];
$intRole    = ['filter' => 'role:admin,anggota']; 
$allRole    = ['filter' => 'role:admin,petugas,anggota'];

// --- Login & Auth ---
$routes->get('/login', 'Auth::login');
$routes->post('/proses-login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// --- FITUR PENDAFTARAN ---
$routes->get('users/create', 'Users::create'); 
$routes->post('users/store', 'Users::store'); 

// --- Halaman Utama ---
$routes->get('/', 'Home::index', $authFilter);
$routes->get('/dashboard', 'Home::index', $authFilter);

// --- Management Users ---
$routes->group('users', array_merge($authFilter, $intRole), function($routes) use ($allRole) {
    $routes->get('/', 'Users::index');
    $routes->get('edit/(:num)', 'Users::edit/$1', $allRole);
    $routes->post('update/(:num)', 'Users::update/$1', $allRole);
    $routes->get('delete/(:num)', 'Users::delete/$1', $allRole);
    $routes->get('detail/(:num)', 'Users::detail/$1', $allRole);
    $routes->get('print', 'Users::print', $allRole);
    $routes->get('wa/(:num)', 'Users::wa/$1', $allRole);
});

// --- Management Buku (Rak Buku) ---
$routes->group('buku', $authFilter, function($routes) {
    $routes->get('/', 'Buku::index'); 
    $routes->get('create', 'Buku::create'); 
    $routes->post('store', 'Buku::store'); 
    $routes->get('edit/(:num)', 'Buku::edit/$1'); 
    $routes->post('update/(:num)', 'Buku::update/$1'); 
    $routes->get('delete/(:num)', 'Buku::delete/$1');
    $routes->get('detail/(:num)', 'Buku::detail/$1');
});

// Shortcut untuk URL /stan
$routes->get('/stan', 'Buku::index', $authFilter);

// --- Transaksi Peminjaman ---
$routes->group('peminjaman', $authFilter, function($routes) use ($anggota) {
    // Tampilan Utama
    $routes->get('/', 'Peminjaman::index');           // Admin & Petugas lihat semua
    $routes->get('riwayat', 'Peminjaman::riwayat');   // Anggota lihat riwayat sendiri

    // Fitur Anggota (Picu Aksi)
    $routes->get('pinjam/(:num)', 'Peminjaman::pinjam/$1', $anggota);
    $routes->get('ajukan_kembali/(:num)', 'Peminjaman::ajukan_kembali/$1', $anggota);
    $routes->post('beri_rating/(:num)', 'Peminjaman::beri_rating/$1', $anggota);
    $routes->get('bayar_denda/(:num)', 'Peminjaman::bayar_denda/$1', $anggota);
    
    // Fitur Upload & Lihat Bukti (Baru)
    $routes->post('upload_bukti/(:num)', 'Peminjaman::upload_bukti/$1', $anggota);
    $routes->get('lihat_bukti/(:num)', 'Peminjaman::lihat_bukti/$1');
    $routes->get('setujui_pembayaran/(:num)', 'Peminjaman::setujui_pembayaran/$1');
    
    // Fitur Admin/Petugas (Konfirmasi & Manajemen)
    // Gunakan POST untuk setuju_pinjam (karena kirim form tanggal)
    $routes->post('konfirmasi/(:num)/(:any)', 'Peminjaman::konfirmasi/$1/$2'); 
    // Gunakan GET untuk setuju_kembali atau aksi satu klik lainnya
    $routes->get('konfirmasi/(:num)/(:any)', 'Peminjaman::konfirmasi/$1/$2'); 
    
    $routes->get('hilang/(:num)', 'Peminjaman::hilang/$1');
    $routes->get('hapus_riwayat/(:num)', 'Peminjaman::hapus_riwayat/$1');
    $routes->get('/backup', 'Backup::index');
    $routes->get('/restore', 'Restore::index');
$routes->post('/restore/auth', 'Restore::auth');
$routes->get('/restore/form', 'Restore::form');
$routes->post('/restore/process', 'Restore::process');
});