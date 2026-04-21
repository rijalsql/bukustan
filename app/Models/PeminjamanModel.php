<?php 

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model {
    protected $table      = 'peminjaman';
    protected $primaryKey = 'id_pinjam';
    
    
    protected $allowedFields = [
    'id_user', 
    'id_buku', 
    'tgl_pinjam', 
    'tgl_kembali', 
    'status', 
    'total_denda', 
    'bukti_bayar',  // WAJIB ADA INI
    'status_bayar', // WAJIB ADA INI
    'rating', 
    'ulasan'
];

    public function getPeminjaman($keyword = null) {
        // Menggunakan $this agar lebih konsisten dengan sistem Model CI4
        $builder = $this->select('peminjaman.*, users.nama, buku.judul')
                        ->join('users', 'users.id = peminjaman.id_user')
                        ->join('buku', 'buku.id_buku = peminjaman.id_buku');
        
        if ($keyword) {
            $builder->like('users.nama', $keyword);
        }
        
        // Menggunakan orderBy agar data terbaru muncul di atas
        return $builder->orderBy('peminjaman.id_pinjam', 'DESC')->findAll();
    }
}