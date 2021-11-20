<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Organisasi;

class OrganisasiController extends BaseController
{
    public function index()
    {
        $data = new Organisasi();
        $data['organisasis'] = $data->findAll();
		echo view('dashboard/organisasi/index', $data);
    }
}
