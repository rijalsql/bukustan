<?php

namespace App\Models;

use CodeIgniter\Model;

class InboxModel extends Model
{
    protected $table      = 'inbox';
    protected $primaryKey = 'id_inbox';
    protected $allowedFields = ['id_user', 'subjek', 'pesan', 'is_read', 'created_at'];

    public function getPesanByUser($id_user)
    {
        return $this->where('id_user', $id_user)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}