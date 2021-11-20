<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengumuman extends Model
{
    protected $table      = 'pengumumans';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'deskripsi', 'tanggal', 'visible', 'user_id'];

    protected $validationRules = [
        'judul' => 'required',
        'deskripsi' => 'permit_empty',
        'tanggal' => 'date',
        'visible' => 'permit_empty',
        'user_id' => 'permit_empty'
    ];

    protected $validationMessages = [
        'judul' => [
            'required' => 'Nama Pengumuman harus diisi'
        ]
    ];
}
