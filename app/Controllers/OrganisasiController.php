<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Organisasi;
use Exception;

class OrganisasiController extends BaseController
{
    private Organisasi $organisasi;

    public function __construct()
    {
        $this->organisasi = new Organisasi();
        $this->organisasi->asObject();
    }

    public function index()
    {
        $model = new Organisasi();
        $data['organisasis'] = $model->findAll();
        $data['title'] = 'List Organisasi';
		echo view('dashboard/organisasi/index', $data);
    }

    public function new()
    {
        $data['title'] = 'Tambah Organisasi';
		echo view('dashboard/organisasi/create', $data);
    }

    public function store()
    {
        $data = [
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
            'founder' => $this->request->getPost('founder'),
            'tahun' => $this->request->getPost('tahun'),
        ];

        if (!$this->organisasi->validate($data)) {
            return redirect()->to('/dashboard/organisasi/new')->with('errors', $this->organisasi->errors());
        }

        try {
            $this->organisasi->protect(false)->insert($data);
        } catch (Exception $e) {
            return redirect()->to('/dashboard/organisasi/new')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->to('/dashboard/organisasi/new')->with('success', 'Berhasil menambahkan data');
    }

    public function edit($id)
    {
        $model = $this->organisasi;
        $data['data'] = $model->where('id', $id)->first();
        $data['title'] = 'Update Data';
        
        echo view('dashboard/organisasi/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
            'founder' => $this->request->getPost('founder'),
            'tahun' => $this->request->getPost('tahun'),
        ];

        if (!$this->organisasi->validate($data)) {
            return redirect()->to('/dashboard/organisasi/'. $id .'/edit')->with('errors', $this->organisasi->errors());
        }

        try {
            $this->organisasi->protect(false)->update($id, $data);
        } catch (Exception $e) {
            return redirect()->to('/dashboard/organisasi/'. $id .'/edit')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->to('/dashboard/organisasi/'. $id .'/edit')->with('success', 'Berhasil mengupdate data');
    }
    
}
