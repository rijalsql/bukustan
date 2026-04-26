<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PeminjamanModel; // Pastikan nama Model kamu sesuai

class Dashboard extends BaseController
{
    public function index()
    {
        // 1. Inisialisasi Model
        $peminjamanModel = new PeminjamanModel();

        // 2. Ambil data total denda yang sudah lunas menggunakan Query Builder
        // Kita memfilter status_bayar yang 'lunas' saja
        $totalDendaLunas = $peminjamanModel->where('status_bayar', 'lunas')
                                           ->selectSum('total_denda')
                                           ->get()
                                           ->getRow()->total_denda ?? 0;

        // 3. Persiapkan data untuk dikirim ke View
        $data = [
            'title'              => 'Dashboard Admin',
            'total_denda_masuk'  => $totalDendaLunas,
            // Kamu bisa menambah data lain di sini nanti, misal total buku atau user
        ];

        // 4. Tampilkan View dashboard admin
        return view('admin/dashboard', $data);
    }
}