<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Anggota;
use App\Models\Jabatan;
use App\Models\Organisasi;
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
        $data['anggotas'] = $this->anggota->get_data();
        dd($data);
        $data['title'] = 'List Anggota';
		echo view('dashboard/anggota/index', $data);
    }

    public function new()
    {
        $organisasi = new Organisasi();
        $jabatan = new Jabatan();
        $data['title'] = 'Tambah anggota';
        $data['organisasis'] = $organisasi->findAll();
        $data['jabatans'] = $jabatan->findAll();
		echo view('dashboard/anggota/create', $data);
    }

    public function store()
    {
        $data = [
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'gender' => $this->request->getPost('gender'),
            'organisasi_id' => $this->request->getPost('organisasi_id'),
            'jabatan_id' => $this->request->getPost('jabatan_id'),
        ];

        if (!$this->anggota->validate($data)) {
            return redirect()->to('/dashboard/anggota/new')->withInput()->with('errors', $this->anggota->errors());
        }

        try {
            $this->anggota->protect(false)->insert($data);
        } catch (Exception $e) {
            return redirect()->to('/dashboard/anggota/new')->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'gender' => $this->request->getPost('gender'),
            'organisasi_id' => $this->request->getPost('organisasi_id'),
            'jabatan_id' => $this->request->getPost('jabatan_id'),
        ];

        if (!$this->anggota->validate($data)) {
            return redirect()->to('/dashboard/anggota/'. $id .'/edit')->withInput()->with('errors', $this->anggota->errors());
        }

        try {
            $this->anggota->protect(false)->update($id, $data);
        } catch (Exception $e) {
            return redirect()->to('/dashboard/anggota/'. $id .'/edit')->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
