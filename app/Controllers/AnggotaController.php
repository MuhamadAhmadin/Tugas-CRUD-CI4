<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Anggota;
use Exception;

class AnggotaController extends BaseController
{
    private Anggota $anggota;

    public function __construct()
    {
        $this->anggota = new Anggota();
        $this->anggota->asObject();
    }

    public function index()
    {
        $model = $this->anggota;
        $data['anggotas'] = $model->findAll();
        $data['title'] = 'List Anggota';
		echo view('dashboard/anggota/index', $data);
    }

    public function new()
    {
        $data['title'] = 'Tambah anggota';
		echo view('dashboard/anggota/create', $data);
    }

    public function store()
    {
        $data = [
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
            'founder' => $this->request->getPost('founder'),
            'tahun' => $this->request->getPost('tahun'),
        ];

        if (!$this->anggota->validate($data)) {
            return redirect()->to('/dashboard/anggota/new')->with('errors', $this->anggota->errors());
        }

        try {
            $this->anggota->protect(false)->insert($data);
        } catch (Exception $e) {
            return redirect()->to('/dashboard/anggota/new')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->to('/dashboard/anggota/new')->with('success', 'Berhasil menambahkan data');
    }

    public function edit($id)
    {
        $model = $this->anggota;
        $data['data'] = $model->where('id', $id)->first();
        $data['title'] = 'Update Data';
        
        echo view('dashboard/anggota/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
            'founder' => $this->request->getPost('founder'),
            'tahun' => $this->request->getPost('tahun'),
        ];

        if (!$this->anggota->validate($data)) {
            return redirect()->to('/dashboard/anggota/'. $id .'/edit')->with('errors', $this->anggota->errors());
        }

        try {
            $this->anggota->protect(false)->update($id, $data);
        } catch (Exception $e) {
            return redirect()->to('/dashboard/anggota/'. $id .'/edit')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->to('/dashboard/anggota/'. $id .'/edit')->with('success', 'Berhasil mengupdate data');
    }
    
    public function delete($id){
        try {
            $this->anggota->delete($id);
        } catch (Exception $e) {
            return redirect()->to('dashboard/anggota')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
        return redirect()->to('/dashboard/anggota')->with('success', 'Berhasil menghapus data');
    }
}
