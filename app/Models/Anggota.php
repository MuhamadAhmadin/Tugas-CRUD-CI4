<?php

namespace App\Models;

use CodeIgniter\Model;

class Anggota extends Model
{
    protected $table      = 'anggotas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nik', 'nama', 'alamat', 'gender', 'organisasi_id', 'jabatan_id'];

    protected $validationRules = [
        'nik' => 'required',
        'nama' => 'required',
        'alamat' => 'permit_empty',
        'gender' => 'permit_empty',
        'organisasi_id' => 'required',
        'jabatan_id' => 'required',
    ];

    protected $validationMessages = [
        'nik' => [
            'required' => 'nik Berita harus diisi'
        ],
        'nama' => [
            'required' => 'nama Berita harus diisi'
        ],
        'organisasi_id' => [
            'required' => 'Organisasi harus dipilih, jika kosong, silahkan isi dari data master'
        ],
        'jabatan_id' => [
            'required' => 'Jabatan harus dipilih, jika kosong, silahkan isi dari data master'
        ],
    ];

    public function get_data()
    {
    	return $this->db->table($this->table)
	    	->join('organisasis', 'organisasis.id = '.$this->table.'.organisasi_id', 'left')
	    	->join('jabatans', 'jabatans.id = '.$this->table.'.jabatan_id', 'left')
            ->select('anggotas.*, jabatans.nama AS nama_jabatan, organisasis.nama AS nama_organisasi')
	    	->orderBy($this->table.'.id', 'desc')->get()->getResultObject();
    }
}
