<?php

namespace App\Controllers;

use App\Models\KullaniciModel;
use App\Models\RestoranModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Giris extends BaseController
{
    public function anasayfa()
    {
        return view('anasayfa');
    }

    public function index($restoranId)
    {
        $restoranModel = new RestoranModel();
        $restoran = $restoranModel->find($restoranId);

        if (! $restoran) {
            throw PageNotFoundException::forPageNotFound('Restoran bulunamadı.');
        }

        if (session('restoran_id') == $restoranId) {
            return redirect()->to(ana_sayfa_adresi(session('rol')));
        }

        return view('giris/index', ['restoran' => $restoran]);
    }

    public function girisYap($restoranId)
    {
        $restoranModel = new RestoranModel();
        $restoran = $restoranModel->find($restoranId);

        if (! $restoran) {
            throw PageNotFoundException::forPageNotFound('Restoran bulunamadı.');
        }

        $girisAdresi = 'restoran/' . $restoran['id'] . '/giris';

        $tc = trim((string) $this->request->getPost('tc'));
        $sifre = (string) $this->request->getPost('sifre');

        if ($tc === '' || $sifre === '') {
            return redirect()->to($girisAdresi)->with('hata', 'T.C. kimlik numarası ve PIN / şifre boş bırakılamaz.');
        }

        $kullaniciModel = new KullaniciModel();
        $kullanici = $kullaniciModel
            ->where('restaurant_id', $restoran['id'])
            ->where('tc', $tc)
            ->whereIn('role', ['manager', 'waiter'])
            ->first();

        if (! $kullanici || ! password_verify($sifre, $kullanici['password_hash'])) {
            return redirect()->to($girisAdresi)->with('hata', 'T.C. kimlik numarası veya PIN / şifre hatalı.');
        }

        if ($kullanici['is_active'] != 1) {
            return redirect()->to($girisAdresi)->with('hata', 'Hesabınız pasif durumda. Restoran yöneticinizle görüşün.');
        }

        session()->regenerate();
        session()->set([
            'kullanici_id'  => $kullanici['id'],
            'kullanici_adi' => $kullanici['name'],
            'rol'           => $kullanici['role'],
            'restoran_id'   => $restoran['id'],
            'restoran_adi'  => $restoran['name'],
        ]);

        return redirect()->to(ana_sayfa_adresi($kullanici['role']));
    }

    public function mutfakGirisYap($restoranId)
    {
        $restoranModel = new RestoranModel();
        $restoran = $restoranModel->find($restoranId);

        if (! $restoran) {
            throw PageNotFoundException::forPageNotFound('Restoran bulunamadı.');
        }

        $girisAdresi = 'restoran/' . $restoran['id'] . '/giris';

        $pin = (string) $this->request->getPost('pin');

        if ($pin === '') {
            return redirect()->to($girisAdresi)->with('hata', 'Mutfak PIN\'i boş bırakılamaz.');
        }

        if (empty($restoran['kitchen_pin_hash']) || ! password_verify($pin, $restoran['kitchen_pin_hash'])) {
            return redirect()->to($girisAdresi)->with('hata', 'Mutfak PIN\'i hatalı.');
        }

        session()->regenerate();
        session()->set([
            'kullanici_adi' => 'Mutfak',
            'rol'           => 'kitchen',
            'restoran_id'   => $restoran['id'],
            'restoran_adi'  => $restoran['name'],
        ]);

        return redirect()->to('mutfak');
    }

    public function cikis()
    {
        $restoranId = session('restoran_id');

        session()->destroy();

        if ($restoranId) {
            return redirect()->to('restoran/' . $restoranId . '/giris');
        }

        return redirect()->to('/');
    }
}
