<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PeminjamanModel;
use App\Models\BukuModel;
use App\Models\InboxModel; // Tambahkan ini agar rapi

class Peminjaman extends BaseController
{
    protected $pModel;
    protected $bModel;

    public function __construct()
    {
        $this->pModel = new PeminjamanModel();
        $this->bModel = new BukuModel();
    }

    public function index()
    {
        $data['title'] = 'Manajemen Transaksi Perpustakaan';
        $data['peminjaman'] = $this->pModel->select('peminjaman.*, users.nama, buku.judul')
            ->join('users', 'users.id = peminjaman.id_user')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku')
            ->orderBy('peminjaman.id_pinjam', 'DESC')
            ->findAll();

        return view('peminjaman/index', $data);
    }

    public function riwayat()
    {
        $id_user = session()->get('id');
        $data['title'] = 'Riwayat Sihir Saya';
        $data['riwayat'] = $this->pModel->select('peminjaman.*, buku.judul, buku.foto')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku')
            ->where('peminjaman.id_user', $id_user)
            ->orderBy('peminjaman.id_pinjam', 'DESC')
            ->findAll();

        return view('peminjaman/riwayat', $data);
    }

    public function pinjam($id_buku)
    {
        $buku = $this->bModel->find($id_buku);
        if (!$buku || $buku['stok'] <= 0) {
            return redirect()->back()->with('error', 'Mantra Gagal! Stok buku ini sedang kosong.');
        }

        $this->pModel->save([
            'id_user'      => session()->get('id'),
            'id_buku'      => $id_buku,
            'tgl_pinjam'   => date('Y-m-d'),
            'tgl_kembali'  => date('Y-m-d', strtotime('+7 days')),
            'status'       => 'pending_pinjam',
            'status_bayar' => 'belum'
        ]);

        return redirect()->to('/peminjaman/riwayat')->with('success', 'Permintaan terkirim. Segera ambil buku.');
    }

    public function konfirmasi($id_pinjam, $aksi)
    {
        $pinjam = $this->pModel->find($id_pinjam);
        if (!$pinjam) return redirect()->back();

        $db = \Config\Database::connect();
        $db->transStart();

        $custom_tgl_pinjam = $this->request->getPost('tgl_pinjam');
        $custom_tgl_kembali = $this->request->getPost('tgl_kembali');

        if ($aksi == 'setuju_pinjam') {
            $buku = $this->bModel->find($pinjam['id_buku']);
            if ($buku['stok'] > 0) {
                $this->pModel->update($id_pinjam, [
                    'status'      => 'dipinjam',
                    'tgl_pinjam'  => $custom_tgl_pinjam ?: date('Y-m-d'),
                    'tgl_kembali' => $custom_tgl_kembali ?: date('Y-m-d', strtotime('+7 days'))
                ]);
                $this->bModel->update($pinjam['id_buku'], ['stok' => $buku['stok'] - 1]);
            }
        } elseif ($aksi == 'setuju_kembali') {
            $tgl_sekarang = new \DateTime(date('Y-m-d'));
            $tgl_deadline = new \DateTime($pinjam['tgl_kembali']);
            $denda = 0;

            if ($tgl_sekarang > $tgl_deadline) {
                $selisih = $tgl_sekarang->diff($tgl_deadline)->days;
                $denda = $selisih * 2000;
            }

            $this->pModel->update($id_pinjam, [
                'tgl_dikembalikan' => date('Y-m-d'),
                'total_denda'      => $denda,
                'status'           => 'kembali'
            ]);

            $this->bModel->where('id_buku', $pinjam['id_buku'])->increment('stok');
        }

        $db->transComplete();
        return redirect()->back()->with('success', 'Mantra konfirmasi berhasil dijalankan!');
    }

    public function ajukan_kembali($id_pinjam)
    {
        $pinjam = $this->pModel->find($id_pinjam);
        if (!$pinjam) return redirect()->back()->with('error', 'Data tidak ditemukan.');

        $tgl_deadline = strtotime($pinjam['tgl_kembali']);
        $tgl_sekarang = time();
        $is_telat = $tgl_sekarang > $tgl_deadline;

        if ($is_telat && $pinjam['status_bayar'] != 'lunas') {
            return redirect()->back()->with('error', 'Sihir Terkunci! Anda telat mengembalikan buku. Silakan bayar denda dan upload bukti transfer terlebih dahulu.');
        }

        $this->pModel->update($id_pinjam, ['status' => 'pending_kembali']);
        return redirect()->back()->with('success', 'Permintaan pengembalian telah dikirim ke Admin!');
    }

    public function upload_bukti($id_pinjam)
    {
        $validationRule = [
            'bukti_bayar' => [
                'rules' => 'uploaded[bukti_bayar]|max_size[bukti_bayar,2048]|is_image[bukti_bayar]|mime_in[bukti_bayar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih file fotonya dulu.',
                    'max_size' => 'Ukuran fotonya kegedean (Max 2MB).',
                    'is_image' => 'Yang diupload bukan foto.',
                    'mime_in'  => 'Format foto harus JPG, JPEG, atau PNG.'
                ]
            ]
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->with('error', $this->validator->getError('bukti_bayar'));
        }

        $fileBukti = $this->request->getFile('bukti_bayar');

        if ($fileBukti->isValid() && !$fileBukti->hasMoved()) {
            $namaFile = $fileBukti->getRandomName();
            $fileBukti->move('uploads/bukti_transfer/', $namaFile);

            $this->pModel->update($id_pinjam, [
                'bukti_bayar'  => $namaFile,
                'status_bayar' => 'proses'
            ]);

            return redirect()->back()->with('success', 'Bukti berhasil diupload! Tunggu validasi Admin.');
        }

        return redirect()->back()->with('error', 'Gagal upload bukti.');
    }

    public function lihat_bukti($id_pinjam)
    {
        $pinjam = $this->pModel->find($id_pinjam);
        if (!$pinjam || !$pinjam['bukti_bayar']) {
            return '<div class="alert alert-danger">Bukti transfer belum diupload atau tidak ditemukan.</div>';
        }
        return '<img src="' . base_url('uploads/bukti_transfer/' . $pinjam['bukti_bayar']) . '" class="img-fluid" alt="Bukti Transfer">';
    }

    public function bayar_denda($id_pinjam)
    {
        $pinjam = $this->pModel->select('peminjaman.*, buku.judul')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku')
            ->find($id_pinjam);

        $tgl_deadline = strtotime($pinjam['tgl_kembali']);
        $tgl_sekarang = time();
        $total_bayar = 0;

        if ($tgl_sekarang > $tgl_deadline) {
            $selisih = floor(($tgl_sekarang - $tgl_deadline) / (60 * 60 * 24));
            $total_bayar = $selisih * 2000; // Pastikan jumlah denda sesuai (2000 atau 20000)
        }

        if ($total_bayar <= 0) return redirect()->back();

        $nomor_dana = "085353780185";
        $pesan = "Denda Perpustakaan - " . $pinjam['judul'];
        $url_dana = "https://link.dana.id/send-money/?phoneNumber=" . $nomor_dana . "&amount=" . $total_bayar . "&comment=" . urlencode($pesan);

        return redirect()->to($url_dana);
    }

    public function setujui_pembayaran($id_pinjam)
    {
        $this->pModel->update($id_pinjam, ['status_bayar' => 'lunas']);
        return redirect()->to('/peminjaman')->with('success', 'Pembayaran denda diverifikasi!');
    }

    public function beri_rating($id_pinjam)
    {
        $rating = $this->request->getPost('rating');
        $ulasan = $this->request->getPost('ulasan');
        if (!$rating) return redirect()->back()->with('error', 'Pilih bintang dulu!');

        $this->pModel->update($id_pinjam, ['rating' => $rating, 'ulasan' => $ulasan]);
        return redirect()->back()->with('success', 'Ulasan berhasil disimpan!');
    }

    public function hilang($id_pinjam)
{
    // 1. Ambil data peminjaman sekaligus harga buku menggunakan join
    $pinjam = $this->pModel->select('peminjaman.id_pinjam, buku.harga')
        ->join('buku', 'buku.id_buku = peminjaman.id_buku')
        ->find($id_pinjam);

    // 2. Cek apakah data ditemukan untuk menghindari error
    if (!$pinjam) {
        return redirect()->to('/peminjaman')->with('error', 'Data transaksi tidak ditemukan.');
    }

    // 3. Update status menjadi 'hilang' dan set total_denda sebesar harga buku
    // Pastikan 'status_bayar' diset ke 'belum' agar anggota wajib membayar
    $this->pModel->update($id_pinjam, [
        'status'       => 'hilang',
        'total_denda'  => $pinjam['harga'],
        'status_bayar' => 'belum' 
    ]);

    // 4. Gunakan pesan 'success' agar Admin tahu proses berhasil, 
    // tapi isi pesannya menjelaskan tentang sanksi denda.
    return redirect()->to('/peminjaman')->with('success', 'Buku dinyatakan HILANG. Denda otomatis ditagihkan sebesar Rp ' . number_format($pinjam['harga'], 0, ',', '.'));
}

    public function hapus_riwayat($id_pinjam)
    {
        $this->pModel->delete($id_pinjam);
        return redirect()->back()->with('success', 'Data dihapus.');
    }

    // VERSI TERBAIK: Hanya ada satu fungsi kirim_peringatan dengan parameter ID Pinjam
    public function kirim_peringatan($id_pinjam)
    {
        $inboxModel = new InboxModel();
        
        // Cari data lengkap termasuk judul buku dari join
        $dataPinjam = $this->pModel->select('peminjaman.*, buku.judul')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku')
            ->find($id_pinjam);
        
        if ($dataPinjam) {
            $data = [
                'id_user' => $dataPinjam['id_user'],
                'subjek'  => '⚠️ PERINGATAN KETERLAMBATAN',
                'pesan'   => "Halo, buku dengan judul '{$dataPinjam['judul']}' sudah melewati batas waktu. Mohon segera dikembalikan ke perpustakaan. Terima kasih."
            ];

            $inboxModel->save($data);
            return redirect()->back()->with('success', 'Pesan peringatan berhasil dikirim!');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }
}