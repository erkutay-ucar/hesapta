<?php

namespace App\Controllers;

use App\Models\KullaniciModel;

class Admin extends BaseController
{
    public function giris()
    {
        if (session('rol') === 'platform_admin') {
            return redirect()->to('admin/panel');
        }

        return view('admin/giris');
    }

    public function girisYap()
    {
        $kullaniciAdi = trim((string) $this->request->getPost('username'));
        $sifre = (string) $this->request->getPost('password');

        if ($kullaniciAdi === '' || $sifre === '') {
            return redirect()->to('admin')->with('hata', 'Kullanıcı adı ve şifre boş bırakılamaz.');
        }

        $kullaniciModel = new KullaniciModel();
        $kullanici = $kullaniciModel
            ->where('username', $kullaniciAdi)
            ->where('role', 'platform_admin')
            ->where('is_active', 1)
            ->first();

        if (! $kullanici || ! password_verify($sifre, $kullanici['password_hash'])) {
            return redirect()->to('admin')->with('hata', 'Kullanıcı adı veya şifre hatalı.');
        }

        session()->regenerate();
        session()->set([
            'kullanici_id'  => $kullanici['id'],
            'kullanici_adi' => $kullanici['name'],
            'rol'           => $kullanici['role'],
        ]);

        return redirect()->to('admin/panel');
    }

    public function panel()
    {
        return view('admin/panel', ['baslik' => 'Ana Sayfa']);
    }

    public function cikis()
    {
        session()->destroy();

        return redirect()->to('admin');
    }
}
