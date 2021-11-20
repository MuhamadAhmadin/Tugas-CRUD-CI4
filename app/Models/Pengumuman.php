<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengumuman extends Model
{
    protected $table      = 'pengumumans';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['kode', 'nama', 'founder', 'tahun'];

    protected $validationRules = [
        'kode' => 'required',
        'nama' => 'required',
        'founder' => 'permit_empty',
        'tahun' => 'permit_empty'
    ];

    protected $validationMessages = [
        'kode' => [
            'required' => 'Kode harus diisi'
        ],
        'nama' => [
            'required' => 'Nama harus diisi'
        ]
    ];
}
