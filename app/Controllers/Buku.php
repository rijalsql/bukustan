<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    // 1. Menampilkan Rak Buku dengan Filter Kategori & Rating
    public function index()
    {
        $db = \Config\Database::connect();
        $kategori_dipilih = $this->request->getVar('kategori');
        $keyword = $this->request->getVar('keyword');

        $builder = $db->table('buku');
        $builder->select('buku.*, AVG(peminjaman.rating) as rata_rating');
        $builder->join('peminjaman', 'peminjaman.id_buku = buku.id_buku', 'left');

        // Filter Kategori (Jika ada yang dipilih)
        if ($kategori_dipilih && $kategori_dipilih != 'Semua') {
            $builder->where('buku.kategori', $kategori_dipilih);
        }

        // Fitur Pencarian (Keyword)
        if ($keyword) {
            $builder->groupStart()
                    ->like('buku.judul', $keyword)
                    ->orLike('buku.penulis', $keyword)
                    ->groupEnd();
        }

        $builder->groupBy('buku.id_buku');
        $builder->orderBy('buku.id_buku', 'DESC');

        $data = [
            'buku'           => $builder->get()->getResultArray(),
            'kategori_aktif' => $kategori_dipilih ?: 'Semua',
            'keyword'        => $keyword
        ];

        return view('buku/rak', $data);
    }

    public function create()
    {
        return view('buku/create');
    }

    // 2. Simpan Buku Baru
    public function store()
    {
        $model = new BukuModel();

        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('uploads/buku/', $namaFoto);
        } else {
            $namaFoto = 'default.jpg';
        }

        $model->save([
            'judul'          => $this->request->getPost('judul'),
            'penulis'        => $this->request->getPost('penulis'),
            'kategori'       => $this->request->getPost('kategori'),
            'foto'           => $namaFoto,
            'stok'           => $this->request->getPost('stok'),
            'denda_per_hari' => $this->request->getPost('denda_per_hari'),
        ]);

        return redirect()->to('/buku')->with('success', 'Buku berhasil ditambah!');
    }

    public function edit($id)
    {
        $model = new BukuModel();
        $data['buku'] = $model->find($id);
        if (!$data['buku']) return redirect()->to('/buku')->with('error', 'Buku tidak ditemukan.');

        return view('buku/edit', $data);
    }

    // 3. Update Buku (Solusi agar tidak terhapus)
    public function update($id)
    {
        $model = new BukuModel();
        $bukuLama = $model->find($id);

        if (!$bukuLama) {
            return redirect()->to('/buku')->with('error', 'Buku tidak ditemukan.');
        }

        $fileFoto = $this->request->getFile('foto');
        $namaFoto = $bukuLama['foto'];

        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('uploads/buku/', $namaFoto);

            if ($bukuLama['foto'] != 'default.jpg' && file_exists('uploads/buku/' . $bukuLama['foto'])) {
                unlink('uploads/buku/' . $bukuLama['foto']);
            }
        }

        $dataUpdate = [
            'judul'          => $this->request->getPost('judul'),
            'penulis'        => $this->request->getPost('penulis'),
            'kategori'       => $this->request->getPost('kategori'),
            'foto'           => $namaFoto,
            'stok'           => $this->request->getPost('stok'),
            'denda_per_hari' => $this->request->getPost('denda_per_hari'),
        ];

        // Menggunakan update() eksplisit lebih aman daripada save() untuk menghindari duplikasi/delete
        if ($model->update($id, $dataUpdate)) {
            return redirect()->to('/buku')->with('success', 'Buku berhasil diupdate!');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data.');
        }
    }

    public function delete($id)
    {
        $model = new BukuModel();
        $buku = $model->find($id);

        if ($buku && $buku['foto'] != 'default.jpg' && file_exists('uploads/buku/' . $buku['foto'])) {
            unlink('uploads/buku/' . $buku['foto']);
        }

        $model->delete($id);
        return redirect()->to('/buku')->with('success', 'Buku berhasil dihapus!');
    }

    // 4. Detail Buku dengan Rating
  public function detail($id)
{
    $modelBuku = new \App\Models\BukuModel();
    $modelPinjam = new \App\Models\PeminjamanModel();

    $data['buku'] = $modelBuku->find($id);

    // Hitung rata-rata rating dari tabel peminjaman
    $avgRating = $modelPinjam->where('id_buku', $id)
                             ->where('status', 'kembali')
                             ->selectAvg('rating')
                             ->first();
    
    // Masukkan hasil hitungan ke array buku biar view nggak bingung
    $data['buku']['rata_rating'] = $avgRating['rating'] ?? 0;

    // Ambil ulasan
    $data['ulasan'] = $modelPinjam->select('peminjaman.*, users.nama')
        ->join('users', 'users.id = peminjaman.id_user')
        ->where('peminjaman.id_buku', $id)
        ->where('peminjaman.status', 'kembali')
        ->where('peminjaman.ulasan IS NOT NULL')
        ->findAll();

    return view('buku/detail', $data);
}
}