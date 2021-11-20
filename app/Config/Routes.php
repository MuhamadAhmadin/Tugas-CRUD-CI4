<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('PageController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'PageController::index');

$routes->group('dashboard', function($routes){
    // ROute Organisasi
	$routes->get('organisasi', 'OrganisasiController::index');
	$routes->get('organisasi/(:segment)/preview', 'OrganisasiController::preview/$1');
    $routes->add('organisasi/new', 'OrganisasiController::new');
    $routes->add('organisasi/store', 'OrganisasiController::store');
	$routes->add('organisasi/(:segment)/edit', 'OrganisasiController::edit/$1');
	$routes->add('organisasi/(:segment)/update', 'OrganisasiController::update/$1');
	$routes->get('organisasi/(:segment)/delete', 'OrganisasiController::delete/$1');
    
    // Route Jabatan
	$routes->get('jabatan', 'JabatanController::index');
	$routes->get('jabatan/(:segment)/preview', 'JabatanController::preview/$1');
    $routes->add('jabatan/new', 'JabatanController::new');
    $routes->add('jabatan/store', 'JabatanController::store');
	$routes->add('jabatan/(:segment)/edit', 'JabatanController::edit/$1');
	$routes->add('jabatan/(:segment)/update', 'JabatanController::update/$1');
	$routes->get('jabatan/(:segment)/delete', 'JabatanController::delete/$1');

    // Route Anggota
	$routes->get('anggota', 'AnggotaController::index');
	$routes->get('anggota/(:segment)/preview', 'AnggotaController::preview/$1');
    $routes->add('anggota/new', 'AnggotaController::new');
    $routes->add('anggota/store', 'AnggotaController::store');
	$routes->add('anggota/(:segment)/edit', 'AnggotaController::edit/$1');
	$routes->add('anggota/(:segment)/update', 'AnggotaController::update/$1');
	$routes->get('anggota/(:segment)/delete', 'AnggotaController::delete/$1');

    // Route Pengumuman
	$routes->get('pengumuman', 'PengumumanController::index');
	$routes->get('pengumuman/(:segment)/preview', 'PengumumanController::preview/$1');
    $routes->add('pengumuman/new', 'PengumumanController::new');
    $routes->add('pengumuman/store', 'PengumumanController::store');
	$routes->add('pengumuman/(:segment)/edit', 'PengumumanController::edit/$1');
	$routes->add('pengumuman/(:segment)/update', 'PengumumanController::update/$1');
	$routes->get('pengumuman/(:segment)/delete', 'PengumumanController::delete/$1');
    
    // Route Berita
	$routes->get('berita', 'BeritaController::index');
	$routes->get('berita/(:segment)/preview', 'BeritaController::preview/$1');
    $routes->add('berita/new', 'BeritaController::new');
    $routes->add('berita/store', 'BeritaController::store');
	$routes->add('berita/(:segment)/edit', 'BeritaController::edit/$1');
	$routes->add('berita/(:segment)/update', 'BeritaController::update/$1');
	$routes->get('berita/(:segment)/delete', 'BeritaController::delete/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
