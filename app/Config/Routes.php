<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->setDefaultController('Auth');
$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/login', 'AuthController::login');
$routes->post('/authenticate', 'AuthController::authenticate');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/register', 'AuthController::register');
$routes->post('/register/store', 'AuthController::store');


//crud
$routes->get('/dashboardcrud', 'dash::index');
$routes->get('dash/form_mhs', 'Dash::form_mhs');
$routes->post('dash/add_data', 'Dash::add_data');
$routes->get('dash/edit_data/(:num)', 'Dash::edit_data/$1'); // Halaman untuk edit data mahasiswa
$routes->post('dash/update_data/(:num)', 'Dash::update_data/$1'); // Update data mahasiswa
$routes->get('dash/delete/(:num)', 'Dash::delete/$1');
$routes->get('/mahasiswa/export', 'Dash::exportExcel');



