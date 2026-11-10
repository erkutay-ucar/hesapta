<?php

namespace App\Controllers;

use App\Models\KullaniciModel;

class Personeller extends BaseController
{
    public function index()
    {
        $kullaniciModel = new KullaniciModel();
        $garsonlar = $kullaniciModel->where('role', 'waiter')->orderBy('name')->findAll();

        return view('personeller/index', [
            'baslik'    => 'Personeller',
            'garsonlar' => $garsonlar,
        ]);
    }

    public function ekle()
    {
        return view('personeller/ekle', ['baslik' => 'Garson Ekle']);
    }

    public function kaydet()
    {
        $kurallar = [
            'name' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Ad soyad boş bırakılamaz.',
                    'max_length' => 'Ad soyad en fazla 100 karakter olabilir.',
                ],
            ],
            'tc' => [
                'rules'  => 'required|exact_length[11]|is_natural|is_unique[users.tc]',
                'errors' => [
                    'required'     => 'T.C. kimlik numarası boş bırakılamaz.',
                    'exact_length' => 'T.C. kimlik numarası 11 haneli olmalıdır.',
                    'is_natural'   => 'T.C. kimlik numarası yalnızca rakamlardan oluşmalıdır.',
                    'is_unique'    => 'Bu T.C. kimlik numarası ile kayıtlı bir kullanıcı zaten var.',
                ],
            ],
            'pin' => [
                'rules'  => 'required|exact_length[6]|is_natural',
                'errors' => [
                    'required'     => 'PIN boş bırakılamaz.',
                    'exact_length' => 'PIN 6 haneli olmalıdır.',
                    'is_natural'   => 'PIN yalnızca rakamlardan oluşmalıdır.',
                ],
            ],
        ];

        if (! $this->validate($kurallar)) {
            return redirect()->to('personeller/ekle')->withInput()->with('hatalar', $this->validator->getErrors());
        }

        $kullaniciModel = new KullaniciModel();
        $kullaniciModel->insert([
            'role'          => 'waiter',
            'name'          => trim((string) $this->request->getPost('name')),
            'tc'            => $this->request->getPost('tc'),
            'password_hash' => password_hash($this->request->getPost('pin'), PASSWORD_DEFAULT),
            'is_active'     => 1,
        ]);

        return redirect()->to('personeller')->with('basari', 'Garson eklendi.');
    }
}
