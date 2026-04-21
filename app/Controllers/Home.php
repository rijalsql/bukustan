<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $db = \Config\Database::connect();
        $role = session()->get('role');
        $userId = session()->get('id'); 
        $today = date('Y-m-d'); // Tanggal hari ini

        $data = [
            'title' => 'Dashboard BUKUSTAN'
        ];

        if ($role == 'admin') {
            // --- DATA UNTUK ADMIN ---
            $data['total_buku'] = $db->table('buku')->countAll();
            $data['total_anggota'] = $db->table('users')->where('role', 'anggota')->countAll();
            $data['pinjam_aktif'] = $db->table('peminjaman')->where('status', 'dipinjam')->countAllResults();
            
            // Logika Terlambat yang Akurat: Status masih dipinjam DAN tanggal kembali sudah lewat hari ini
            $data['terlambat'] = $db->table('peminjaman')
                ->where('status', 'dipinjam')
                ->where('tgl_kembali <', $today)
                ->countAllResults();

            // Tambahan: List Detail Anggota yang terlambat (buat tabel di dashboard)
            $data['list_terlambat'] = $db->table('peminjaman')
                ->select('users.nama, buku.judul, peminjaman.tgl_kembali')
                ->join('users', 'users.id = peminjaman.id_user')
                ->join('buku', 'buku.id_buku = peminjaman.id_buku')
                ->where('peminjaman.status', 'dipinjam')
                ->where('peminjaman.tgl_kembali <', $today)
                ->get()->getResultArray();

            $data['stok_kritis'] = $db->table('buku')
                ->select('id_buku, judul, stok') 
                ->where('stok <', 5)
                ->get()->getResultArray();

            // Log Aktivitas Terbaru
            $data['log_aktivitas'] = $db->table('peminjaman')
                ->select('peminjaman.id_pinjam, peminjaman.status, users.nama, buku.judul')
                ->join('users', 'users.id = peminjaman.id_user')
                ->join('buku', 'buku.id_buku = peminjaman.id_buku')
                ->orderBy('peminjaman.id_pinjam', 'DESC') 
                ->limit(5)->get()->getResultArray();

            // Total Seluruh Denda
            $resDendaAdmin = $db->table('peminjaman')->selectSum('denda')->get()->getRow();
            $data['total_denda_masuk'] = $resDendaAdmin->denda ?? 0;

        } else {
            // --- DATA UNTUK ANGGOTA ---
            $data['pinjaman_saya'] = $db->table('peminjaman')
                ->select('peminjaman.tgl_kembali, peminjaman.status, buku.judul, buku.foto')
                ->join('buku', 'buku.id_buku = peminjaman.id_buku')
                ->where('id_user', $userId)
                ->where('peminjaman.status', 'dipinjam')
                ->get()->getResultArray();

            $data['buku_baru'] = $db->table('buku')
                ->select('id_buku, judul, foto') 
                ->orderBy('id_buku', 'DESC')
                ->limit(4)->get()->getResultArray();

            $resDendaUser = $db->table('peminjaman')
                ->where('id_user', $userId)
                ->selectSum('denda')->get()->getRow();
            $data['total_denda'] = $resDendaUser->denda ?? 0;
        }

        return view('layouts/dashboard', $data);
    }
}