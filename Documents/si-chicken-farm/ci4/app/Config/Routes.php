<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/pakan/create', 'Pakan::create');
$routes->get('/pakan/edit(:segment)', 'Pakan::edit/$1');
$routes->delete('/pakan/(:num)', 'Pakan::delete/$1');

$routes->get('/obat/create', 'Obat::create');
$routes->get('/obat/edit(:segment)', 'Obat::edit/$1');
$routes->delete('/obat/(:num)', 'Obat::delete/$1');

$routes->get('/bibit/create', 'Bibit::create');
$routes->get('/bibit/edit(:segment)', 'Bibit::edit/$1');
$routes->delete('/bibit/(:num)', 'Bibit::delete/$1');

$routes->get('/recording/create', 'Recording::create');
$routes->get('/recording/edit(:segment)', 'Recording::edit/$1');
$routes->delete('/recording/(:num)', 'Recording::delete/$1');

$routes->get('/obatmasuk/create', 'Obatmasuk::create');
$routes->get('/obatmasuk/edit(:segment)', 'Obatmasuk::edit/$1');
$routes->delete('/obatmasuk/(:num)', 'Obatmasuk::delete/$1');

$routes->get('/pengobatan/create', 'Pengobatan::create');
$routes->get('/pengobatan/edit(:segment)', 'Pengobatan::edit/$1');
$routes->delete('/pengobatan/(:num)', 'Pengobatan::delete/$1');

$routes->get('/panen/create', 'Panen::create');
$routes->get('/panen/edit(:segment)', 'Panen::edit/$1');
$routes->delete('/panen/(:num)', 'Panen::delete/$1');


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
