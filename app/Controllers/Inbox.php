<?php

namespace App\Controllers;

use App\Models\InboxModel;

class Inbox extends BaseController
{
    public function index()
    {
        $inboxModel = new InboxModel();
        $id_user = session()->get('id_user');

        $data = [
            'title' => 'Inbox Saya',
            'pesan' => $inboxModel->getPesanByUser($id_user)
        ];

        // Tandai semua pesan sebagai sudah dibaca saat dibuka
        $inboxModel->where('id_user', $id_user)->set(['is_read' => '1'])->update();

        return view('inbox/index', $data);
    }
}