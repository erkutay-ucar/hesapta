<?php

namespace App\Controllers;

use App\Models\AyarModel;
use App\Models\KullaniciModel;

class Ayarlar extends BaseController
{
    public function index()
    {
        $ayarModel = new AyarModel();
        $ayar = $ayarModel->first();

        return view('ayarlar/index', [
            'baslik' => 'Ayarlar',
            'ayar'   => $ayar,
        ]);
    }

    public function restoranKaydet()
    {
        $kurallar = [
            'restaurant_name' => [
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required'   => 'Restoran adı boş bırakılamaz.',
                    'max_length' => 'Restoran adı en fazla 150 karakter olabilir.',
                ],
            ],
            'address' => [
                'rules'  => 'permit_empty|max_length[255]',
                'errors' => ['max_length' => 'Adres en fazla 255 karakter olabilir.'],
            ],
            'phone' => [
                'rules'  => 'permit_empty|max_length[20]',
                'errors' => ['max_length' => 'Telefon en fazla 20 karakter olabilir.'],
            ],
        ];

        if (! $this->validate($kurallar)) {
            return redirect()->to('ayarlar')->with('hatalar', $this->validator->getErrors());
        }

        $restoranAdi = trim((string) $this->request->getPost('restaurant_name'));

        $ayarModel = new AyarModel();
        $ayar = $ayarModel->first();

        $ayarModel->update($ayar['id'], [
            'restaurant_name' => $restoranAdi,
            'address'         => trim((string) $this->request->getPost('address')),
            'phone'           => trim((string) $this->request->getPost('phone')),
        ]);

        session()->set('restoran_adi', $restoranAdi);

        return redirect()->to('ayarlar')->with('basari', 'Restoran bilgileri kaydedildi.');
    }

    public function mutfakPinKaydet()
    {
        $kurallar = [
            'pin' => [
                'rules'  => 'required|exact_length[6]|is_natural',
                'errors' => [
                    'required'     => 'Mutfak PIN\'i boş bırakılamaz.',
                    'exact_length' => 'Mutfak PIN\'i 6 haneli olmalıdır.',
                    'is_natural'   => 'Mutfak PIN\'i yalnızca rakamlardan oluşmalıdır.',
                ],
            ],
            'pin_tekrar' => [
                'rules'  => 'matches[pin]',
                'errors' => ['matches' => 'PIN tekrarı PIN ile aynı değil.'],
            ],
        ];

        if (! $this->validate($kurallar)) {
            return redirect()->to('ayarlar')->with('hatalar', $this->validator->getErrors());
        }

        $ayarModel = new AyarModel();
        $ayar = $ayarModel->first();

        $ayarModel->update($ayar['id'], [
            'kitchen_pin_hash' => password_hash($this->request->getPost('pin'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('ayarlar')->with('basari', 'Mutfak PIN\'i değiştirildi.');
    }

    public function sifreKaydet()
    {
        $kurallar = [
            'mevcut_sifre' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Mevcut şifre boş bırakılamaz.'],
            ],
            'yeni_sifre' => [
                'rules'  => 'required|min_length[8]',
                'errors' => [
                    'required'   => 'Yeni şifre boş bırakılamaz.',
                    'min_length' => 'Yeni şifre en az 8 karakter olmalıdır.',
                ],
            ],
            'yeni_sifre_tekrar' => [
                'rules'  => 'matches[yeni_sifre]',
                'errors' => ['matches' => 'Yeni şifre tekrarı yeni şifre ile aynı değil.'],
            ],
        ];

        if (! $this->validate($kurallar)) {
            return redirect()->to('ayarlar')->with('hatalar', $this->validator->getErrors());
        }

        $kullaniciModel = new KullaniciModel();
        $kullanici = $kullaniciModel->find(session('kullanici_id'));

        if (! password_verify($this->request->getPost('mevcut_sifre'), $kullanici['password_hash'])) {
            return redirect()->to('ayarlar')->with('hata', 'Mevcut şifre hatalı.');
        }

        $kullaniciModel->update($kullanici['id'], [
            'password_hash' => password_hash($this->request->getPost('yeni_sifre'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('ayarlar')->with('basari', 'Şifreniz değiştirildi.');
    }
}
