<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pengumuman;
use Exception;

class PengumumanController extends BaseController
{
    private Pengumuman $Pengumuman;

    public function __construct()
    {
        $this->pengumuman = new Pengumuman();
        $this->pengumuman->asObject();
    }

    public function index()
    {
        $model = new Pengumuman();
        $data['pengumumans'] = $model->findAll();
        $data['title'] = 'List Pengumuman';
		echo view('dashboard/pengumuman/index', $data);
    }

    public function new()
    {
        $data['title'] = 'Tambah Pengumuman';
		echo view('dashboard/pengumuman/create', $data);
    }

    public function store()
    {
        $data = [
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
            'founder' => $this->request->getPost('founder'),
            'tahun' => $this->request->getPost('tahun'),
        ];

        if (!$this->pengumuman->validate($data)) {
            return redirect()->to('/dashboard/pengumuman/new')->with('errors', $this->pengumuman->errors());
        }

        try {
            $this->pengumuman->protect(false)->insert($data);
        } catch (Exception $e) {
            return redirect()->to('/dashboard/pengumuman/new')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->to('/dashboard/pengumuman/new')->with('success', 'Berhasil menambahkan data');
    }

    public function edit($id)
    {
        $model = $this->pengumuman;
        $data['data'] = $model->where('id', $id)->first();
        $data['title'] = 'Update Data';
        
        echo view('dashboard/pengumuman/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
            'founder' => $this->request->getPost('founder'),
            'tahun' => $this->request->getPost('tahun'),
        ];

        if (!$this->pengumuman->validate($data)) {
            return redirect()->to('/dashboard/pengumuman/'. $id .'/edit')->with('errors', $this->pengumuman->errors());
        }

        try {
            $this->pengumuman->protect(false)->update($id, $data);
        } catch (Exception $e) {
            return redirect()->to('/dashboard/pengumuman/'. $id .'/edit')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->to('/dashboard/pengumuman/'. $id .'/edit')->with('success', 'Berhasil mengupdate data');
    }
    
    public function delete($id){
        try {
            $this->pengumuman->delete($id);
        } catch (Exception $e) {
            return redirect()->to('dashboard/pengumuman')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
        return redirect()->to('/dashboard/pengumuman')->with('success', 'Berhasil menghapus data');
    }
}
