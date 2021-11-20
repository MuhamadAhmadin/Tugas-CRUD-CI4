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
        $model = $this->pengumuman;
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
        $visible = ($this->request->getPost('visible')) ? 1 : 0;
        $data = [
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'visible' => $visible,
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
        $visible = ($this->request->getPost('visible')) ? 1 : 0;
        $data = [
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'visible' => $visible,
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
