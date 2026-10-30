<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('admin', 'Admin::giris');
$routes->post('admin', 'Admin::girisYap');
$routes->get('admin/cikis', 'Admin::cikis');

$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('panel', 'Admin::panel');
});
