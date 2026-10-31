<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Giris::anasayfa');

$routes->get('admin', 'Admin::giris');
$routes->post('admin', 'Admin::girisYap');
$routes->get('admin/cikis', 'Admin::cikis');

$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('panel', 'Admin::panel');
});

$routes->get('restoran/(:num)/giris', 'Giris::index/$1');
$routes->post('restoran/(:num)/giris', 'Giris::girisYap/$1');
$routes->post('restoran/(:num)/mutfak', 'Giris::mutfakGirisYap/$1');
$routes->get('cikis', 'Giris::cikis');

$routes->get('yonetim', 'Yonetim::index', ['filter' => ['auth', 'rol:manager']]);
$routes->get('masalar', 'Masalar::index', ['filter' => ['auth', 'rol:manager,waiter']]);
$routes->get('mutfak', 'Mutfak::index', ['filter' => ['auth', 'rol:kitchen']]);
