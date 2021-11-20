<?php

namespace App\Models;

use CodeIgniter\Model;

class Berita extends Model
{
    protected $table      = 'beritas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'deskripsi', 'tanggal', 'visible'];

    protected $validationRules = [
        'judul' => 'required',
        'deskripsi' => 'required',
        'tanggal' => 'date',
        'visible' => 'permit_empty',
    ];

    protected $validationMessages = [
        'judul' => [
            'required' => 'Judul Berita harus diisi'
        ],
        'deskripsi' => [
            'required' => 'Deskripsi Berita harus diisi'
        ],
    ];
}
