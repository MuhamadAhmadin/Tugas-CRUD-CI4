<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Berita;
use Exception;

class BeritaController extends BaseController
{
    private Berita $berita;

    public function __construct()
    {
        $this->berita = new berita();
        $this->berita->asObject();
    }

    public function index()
    {
        $model = $this->berita;
        $data['beritas'] = $model->findAll();
        $data['title'] = 'List berita';
		echo view('dashboard/berita/index', $data);
    }

    public function new()
    {
        $data['title'] = 'Tambah berita';
		echo view('dashboard/berita/create', $data);
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

        if (!$this->berita->validate($data)) {
            return redirect()->to('/dashboard/berita/new')->withInput()->with('errors', $this->berita->errors());
        }

        try {
            $this->berita->protect(false)->insert($data);
        } catch (Exception $e) {
            return redirect()->to('/dashboard/berita/new')->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->to('/dashboard/berita/new')->with('success', 'Berhasil menambahkan data');
    }

    public function edit($id)
    {
        $model = $this->berita;
        $data['data'] = $model->where('id', $id)->first();
        $data['title'] = 'Update Data';
        
        echo view('dashboard/berita/edit', $data);
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

        if (!$this->berita->validate($data)) {
            return redirect()->to('/dashboard/berita/'. $id .'/edit')->withInput()->with('errors', $this->berita->errors());
        }

        try {
            $this->berita->protect(false)->update($id, $data);
        } catch (Exception $e) {
            return redirect()->to('/dashboard/berita/'. $id .'/edit')->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->to('/dashboard/berita/'. $id .'/edit')->with('success', 'Berhasil mengupdate data');
    }
    
    public function delete($id){
        try {
            $this->berita->delete($id);
        } catch (Exception $e) {
            return redirect()->to('dashboard/berita')->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
        return redirect()->to('/dashboard/berita')->with('success', 'Berhasil menghapus data');
    }

}