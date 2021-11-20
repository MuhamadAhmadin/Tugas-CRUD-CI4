<?php

namespace App\Models;

use CodeIgniter\Model;

class Jabatan extends Model
{
    protected $table      = 'jabatans';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['kode', 'nama', 'pangkat', 'keterangan'];

    protected $validationRules = [
        'kode' => 'required',
        'nama' => 'required',
        'pangkat' => 'permit_empty',
        'keterangan' => 'permit_empty'
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
