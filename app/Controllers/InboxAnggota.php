<?php

namespace App\Controllers;

use App\Models\InboxModel;

class InboxAnggota extends BaseController
{
    public function index()
    {
        $inboxModel = new InboxModel();
        $id_user = session()->get('id'); 

        $data = [
            'title' => 'Kotak Pesan Anggota',
            'pesan' => $inboxModel->where('id_user', $id_user)
                                  ->orderBy('id_inbox', 'DESC')
                                  ->findAll()
        ];

        // Memanggil file View yang baru: index_anggota.php
        return view('inbox/index_anggota', $data);
    }

    public function hapus($id)
    {
        $inboxModel = new InboxModel();
        $inboxModel->delete($id);
        return redirect()->to('/inbox-anggota')->with('success', 'Pesan dihapus!');
    }
}