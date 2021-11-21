<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Anggota;
use App\Models\Berita;
use App\Models\Jabatan;
use App\Models\Organisasi;
use App\Models\Pengumuman;

class PageController extends BaseController
{
    public function index()
    {
        $organisasi = new Organisasi();
        $berita = new Berita();
        $pengumuman = new Pengumuman();
        $jabatan = new Jabatan();
        $anggota = new Anggota();
        $data['jumlah_anggota'] = $organisasi->countAll();
        $data['jumlah_berita'] = $berita->countAll();
        $data['jumlah_pengumuman'] = $pengumuman->countAll();
        $data['jumlah_jabatan'] = $jabatan->countAll();
        $data['jumlah_organisasi'] = $organisasi->countAll();
        return view('dashboard/index', $data);
    }
}
