<?php 

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model 
{
    protected $table            = 'buku';
    protected $primaryKey       = 'id_buku';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    protected $allowedFields = [
        'judul', 
        'penulis', 
        'kategori', 
        'foto', 
        'stok', 
        'denda_per_hari'
    ];

    protected $useTimestamps = false; 

    /**
     * Fungsi Magic: Mengambil data buku sekaligus menghitung RATA-RATA RATING 
     * secara real-time dari tabel ulasan_buku.
     */
    public function getBukuWithRating($id_buku = null)
    {
        $builder = $this->db->table($this->table . ' b');
        
        // Memilih semua kolom buku + menghitung rata-rata rating
        $builder->select('b.*, IFNULL(AVG(u.rating), 0) as rata_rating, COUNT(u.id_ulasan) as total_pemberi_rating');
        
        // Join ke tabel ulasan secara permanen (Left Join supaya buku tanpa rating tetap muncul)
        $builder->join('ulasan_buku u', 'u.id_buku = b.id_buku', 'left');
        
        // Kelompokkan berdasarkan ID Buku agar perhitungan AVG per buku
        $builder->groupBy('b.id_buku');

        if ($id_buku !== null) {
            return $builder->where('b.id_buku', $id_buku)->get()->getRowArray();
        }

        // Jika mencari lewat keyword (untuk fitur pencarian di Rak Buku)
        $keyword = request()->getGet('keyword');
        if ($keyword) {
            $builder->like('b.judul', $keyword)->orLike('b.penulis', $keyword);
        }

        // Jika mencari lewat kategori
        $kategori = request()->getGet('kategori');
        if ($kategori && $kategori != 'Semua') {
            $builder->where('b.kategori', $kategori);
        }

        return $builder->get()->getResultArray();
    }
}