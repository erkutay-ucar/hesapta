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
$routes->get('ayarlar', 'Ayarlar::index', ['filter' => ['auth', 'rol:manager']]);
$routes->post('ayarlar/restoran', 'Ayarlar::restoranKaydet', ['filter' => ['auth', 'rol:manager']]);
$routes->post('ayarlar/mutfak-pin', 'Ayarlar::mutfakPinKaydet', ['filter' => ['auth', 'rol:manager']]);
$routes->post('ayarlar/sifre', 'Ayarlar::sifreKaydet', ['filter' => ['auth', 'rol:manager']]);
$routes->get('personeller', 'Personeller::index', ['filter' => ['auth', 'rol:manager']]);
$routes->get('personeller/ekle', 'Personeller::ekle', ['filter' => ['auth', 'rol:manager']]);
$routes->post('personeller/ekle', 'Personeller::kaydet', ['filter' => ['auth', 'rol:manager']]);
$routes->get('personeller/duzenle/(:num)', 'Personeller::duzenle/$1', ['filter' => ['auth', 'rol:manager']]);
$routes->post('personeller/duzenle/(:num)', 'Personeller::guncelle/$1', ['filter' => ['auth', 'rol:manager']]);
$routes->post('personeller/pin/(:num)', 'Personeller::pinDegistir/$1', ['filter' => ['auth', 'rol:manager']]);
$routes->post('personeller/durum/(:num)', 'Personeller::durumDegistir/$1', ['filter' => ['auth', 'rol:manager']]);
$routes->get('masa-yonetimi', 'MasaYonetimi::index', ['filter' => ['auth', 'rol:manager']]);
$routes->get('masa-yonetimi/ekle', 'MasaYonetimi::ekle', ['filter' => ['auth', 'rol:manager']]);
$routes->post('masa-yonetimi/ekle', 'MasaYonetimi::kaydet', ['filter' => ['auth', 'rol:manager']]);
$routes->get('masa-yonetimi/duzenle/(:num)', 'MasaYonetimi::duzenle/$1', ['filter' => ['auth', 'rol:manager']]);
$routes->post('masa-yonetimi/duzenle/(:num)', 'MasaYonetimi::guncelle/$1', ['filter' => ['auth', 'rol:manager']]);
$routes->post('masa-yonetimi/durum/(:num)', 'MasaYonetimi::durumDegistir/$1', ['filter' => ['auth', 'rol:manager']]);
$routes->post('masa-yonetimi/sil/(:num)', 'MasaYonetimi::sil/$1', ['filter' => ['auth', 'rol:manager']]);
