<?php

namespace App\Controllers;

use App\Models\AyarModel;
use App\Models\KullaniciModel;

class Giris extends BaseController
{
    public function index()
    {
        if (session('rol')) {
            return redirect()->to(ana_sayfa_adresi(session('rol')));
        }

        $ayarModel = new AyarModel();
        $ayar = $ayarModel->first();

        return view('giris/index', ['ayar' => $ayar]);
    }

    public function girisYap()
    {
        $tc = trim((string) $this->request->getPost('tc'));
        $sifre = (string) $this->request->getPost('sifre');

        if ($tc === '' || $sifre === '') {
            return redirect()->to('giris')->with('hata', 'T.C. kimlik numarası ve PIN / şifre boş bırakılamaz.');
        }

        $kullaniciModel = new KullaniciModel();
        $kullanici = $kullaniciModel
            ->where('tc', $tc)
            ->whereIn('role', ['manager', 'waiter'])
            ->first();

        if (! $kullanici || ! password_verify($sifre, $kullanici['password_hash'])) {
            return redirect()->to('giris')->with('hata', 'T.C. kimlik numarası veya PIN / şifre hatalı.');
        }

        if ($kullanici['is_active'] != 1) {
            return redirect()->to('giris')->with('hata', 'Hesabınız pasif durumda. Restoran yöneticinizle görüşün.');
        }

        $ayarModel = new AyarModel();
        $ayar = $ayarModel->first();

        session()->regenerate();
        session()->set([
            'kullanici_id'  => $kullanici['id'],
            'kullanici_adi' => $kullanici['name'],
            'rol'           => $kullanici['role'],
            'restoran_adi'  => $ayar['restaurant_name'],
        ]);

        return redirect()->to(ana_sayfa_adresi($kullanici['role']));
    }

    public function mutfakGirisYap()
    {
        $pin = (string) $this->request->getPost('pin');

        if ($pin === '') {
            return redirect()->to('giris')->with('hata', 'Mutfak PIN\'i boş bırakılamaz.');
        }

        $ayarModel = new AyarModel();
        $ayar = $ayarModel->first();

        if (! password_verify($pin, $ayar['kitchen_pin_hash'])) {
            return redirect()->to('giris')->with('hata', 'Mutfak PIN\'i hatalı.');
        }

        session()->regenerate();
        session()->set([
            'kullanici_adi' => 'Mutfak',
            'rol'           => 'kitchen',
            'restoran_adi'  => $ayar['restaurant_name'],
        ]);

        return redirect()->to('mutfak');
    }

    public function cikis()
    {
        session()->destroy();

        return redirect()->to('giris');
    }
}
