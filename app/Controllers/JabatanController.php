<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Jabatan;
use Exception;

class JabatanController extends BaseController
{
    private Jabatan $jabatan;

    public function __construct()
    {
        $this->jabatan = new jabatan();
        $this->jabatan->asObject();
    }

    public function index()
    {
        $model = $this->jabatan;
        $data['jabatans'] = $model->findAll();
        $data['title'] = 'List jabatan';
		echo view('dashboard/jabatan/index', $data);
    }

    public function new()
    {
        $data['title'] = 'Tambah jabatan';
		echo view('dashboard/jabatan/create', $data);
    }

    public function store()
    {
        $data = [
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
            'pangkat' => $this->request->getPost('pangkat'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        if (!$this->jabatan->validate($data)) {
            return redirect()->to('/dashboard/jabatan/new')->withInput()->with('errors', $this->jabatan->errors());
        }

        try {
            $this->jabatan->protect(false)->insert($data);
        } catch (Exception $e) {
            return redirect()->to('/dashboard/jabatan/new')->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->to('/dashboard/jabatan/new')->with('success', 'Berhasil menambahkan data');
    }

    public function edit($id)
    {
        $model = $this->jabatan;
        $data['data'] = $model->where('id', $id)->first();
        $data['title'] = 'Update Data';
        
        echo view('dashboard/jabatan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
            'pangkat' => $this->request->getPost('pangkat'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        if (!$this->jabatan->validate($data)) {
            return redirect()->to('/dashboard/jabatan/'. $id .'/edit')->withInput()->with('errors', $this->jabatan->errors());
        }

        try {
            $this->jabatan->protect(false)->update($id, $data);
        } catch (Exception $e) {
            return redirect()->to('/dashboard/jabatan/'. $id .'/edit')->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->to('/dashboard/jabatan/'. $id .'/edit')->with('success', 'Berhasil mengupdate data');
    }
    
    public function delete($id){
        try {
            $this->jabatan->delete($id);
        } catch (Exception $e) {
            return redirect()->to('dashboard/jabatan')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
        return redirect()->to('/dashboard/jabatan')->with('success', 'Berhasil menghapus data');
    }
}
