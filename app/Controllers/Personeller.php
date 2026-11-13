<?php

namespace App\Controllers;

use App\Models\KullaniciModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Personeller extends BaseController
{
    public function index()
    {
        $kullaniciModel = new KullaniciModel();
        $aktifGarsonlar = $kullaniciModel->where('role', 'waiter')->where('is_active', 1)->orderBy('name')->findAll();
        $pasifGarsonlar = $kullaniciModel->where('role', 'waiter')->where('is_active', 0)->orderBy('name')->findAll();

        return view('personeller/index', [
            'baslik'         => 'Personeller',
            'aktifGarsonlar' => $aktifGarsonlar,
            'pasifGarsonlar' => $pasifGarsonlar,
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

    public function duzenle($id)
    {
        $garson = $this->garsonuBul($id);

        return view('personeller/duzenle', [
            'baslik' => 'Garson Düzenle',
            'garson' => $garson,
        ]);
    }

    public function guncelle($id)
    {
        $garson = $this->garsonuBul($id);

        $kurallar = [
            'name' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Ad soyad boş bırakılamaz.',
                    'max_length' => 'Ad soyad en fazla 100 karakter olabilir.',
                ],
            ],
            'tc' => [
                'rules'  => 'required|exact_length[11]|is_natural|is_unique[users.tc,id,' . $garson['id'] . ']',
                'errors' => [
                    'required'     => 'T.C. kimlik numarası boş bırakılamaz.',
                    'exact_length' => 'T.C. kimlik numarası 11 haneli olmalıdır.',
                    'is_natural'   => 'T.C. kimlik numarası yalnızca rakamlardan oluşmalıdır.',
                    'is_unique'    => 'Bu T.C. kimlik numarası ile kayıtlı başka bir kullanıcı var.',
                ],
            ],
        ];

        if (! $this->validate($kurallar)) {
            return redirect()->to('personeller/duzenle/' . $garson['id'])->withInput()->with('hatalar', $this->validator->getErrors());
        }

        $kullaniciModel = new KullaniciModel();
        $kullaniciModel->update($garson['id'], [
            'name' => trim((string) $this->request->getPost('name')),
            'tc'   => $this->request->getPost('tc'),
        ]);

        return redirect()->to('personeller')->with('basari', 'Garson bilgileri kaydedildi.');
    }

    public function pinDegistir($id)
    {
        $garson = $this->garsonuBul($id);

        $kurallar = [
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
            return redirect()->to('personeller/duzenle/' . $garson['id'])->with('hatalar', $this->validator->getErrors());
        }

        $kullaniciModel = new KullaniciModel();
        $kullaniciModel->update($garson['id'], [
            'password_hash' => password_hash($this->request->getPost('pin'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('personeller/duzenle/' . $garson['id'])->with('basari', 'PIN değiştirildi.');
    }

    public function durumDegistir($id)
    {
        $garson = $this->garsonuBul($id);

        if ($garson['is_active'] == 1) {
            $yeniDurum = 0;
            $mesaj = 'Garson pasif yapıldı. Artık giriş yapamaz.';
        } else {
            $yeniDurum = 1;
            $mesaj = 'Garson tekrar aktif yapıldı.';
        }

        $kullaniciModel = new KullaniciModel();
        $kullaniciModel->update($garson['id'], ['is_active' => $yeniDurum]);

        return redirect()->to('personeller')->with('basari', $mesaj);
    }

    private function garsonuBul($id)
    {
        $kullaniciModel = new KullaniciModel();
        $garson = $kullaniciModel->where('role', 'waiter')->find($id);

        if (! $garson) {
            throw PageNotFoundException::forPageNotFound('Garson bulunamadı.');
        }

        return $garson;
    }
}
