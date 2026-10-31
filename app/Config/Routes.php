<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Giris::index');
$routes->get('giris', 'Giris::index');
$routes->post('giris', 'Giris::girisYap');
$routes->post('mutfak-giris', 'Giris::mutfakGirisYap');
$routes->get('cikis', 'Giris::cikis');

$routes->get('yonetim', 'Yonetim::index', ['filter' => ['auth', 'rol:manager']]);
$routes->get('masalar', 'Masalar::index', ['filter' => ['auth', 'rol:manager,waiter']]);
$routes->get('mutfak', 'Mutfak::index', ['filter' => ['auth', 'rol:kitchen']]);
