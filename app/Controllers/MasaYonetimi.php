<?php

namespace App\Controllers;

use App\Models\MasaModel;
use App\Models\SiparisModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class MasaYonetimi extends BaseController
{
    public function index()
    {
        $masaModel = new MasaModel();
        $aktifMasalar = $masaModel->where('is_active', 1)->orderBy('name')->findAll();
        $pasifMasalar = $masaModel->where('is_active', 0)->orderBy('name')->findAll();

        return view('masa_yonetimi/index', [
            'baslik'       => 'Masa Yönetimi',
            'aktifMasalar' => $aktifMasalar,
            'pasifMasalar' => $pasifMasalar,
        ]);
    }

    public function ekle()
    {
        return view('masa_yonetimi/ekle', ['baslik' => 'Masa Ekle']);
    }

    public function kaydet()
    {
        $kurallar = [
            'name' => [
                'rules'  => 'required|max_length[50]|is_unique[restaurant_tables.name]',
                'errors' => [
                    'required'   => 'Masa adı boş bırakılamaz.',
                    'max_length' => 'Masa adı en fazla 50 karakter olabilir.',
                    'is_unique'  => 'Bu isimde bir masa zaten var.',
                ],
            ],
        ];

        if (! $this->validate($kurallar)) {
            return redirect()->to('masa-yonetimi/ekle')->withInput()->with('hatalar', $this->validator->getErrors());
        }

        $masaModel = new MasaModel();
        $masaModel->insert([
            'name'      => trim((string) $this->request->getPost('name')),
            'is_active' => 1,
        ]);

        return redirect()->to('masa-yonetimi')->with('basari', 'Masa eklendi.');
    }

    public function duzenle($id)
    {
        $masa = $this->masayiBul($id);

        return view('masa_yonetimi/duzenle', [
            'baslik' => 'Masa Düzenle',
            'masa'   => $masa,
        ]);
    }

    public function guncelle($id)
    {
        $masa = $this->masayiBul($id);

        $kurallar = [
            'name' => [
                'rules'  => 'required|max_length[50]|is_unique[restaurant_tables.name,id,' . $masa['id'] . ']',
                'errors' => [
                    'required'   => 'Masa adı boş bırakılamaz.',
                    'max_length' => 'Masa adı en fazla 50 karakter olabilir.',
                    'is_unique'  => 'Bu isimde başka bir masa var.',
                ],
            ],
        ];

        if (! $this->validate($kurallar)) {
            return redirect()->to('masa-yonetimi/duzenle/' . $masa['id'])->withInput()->with('hatalar', $this->validator->getErrors());
        }

        $masaModel = new MasaModel();
        $masaModel->update($masa['id'], [
            'name' => trim((string) $this->request->getPost('name')),
        ]);

        return redirect()->to('masa-yonetimi')->with('basari', 'Masa kaydedildi.');
    }

    public function durumDegistir($id)
    {
        $masa = $this->masayiBul($id);

        if ($masa['is_active'] == 1) {
            if ($this->acikSiparisiVarMi($masa['id'])) {
                return redirect()->to('masa-yonetimi/duzenle/' . $masa['id'])->with('hata', 'Bu masada açık sipariş var. Önce hesabı kapatın.');
            }

            $yeniDurum = 0;
            $mesaj = 'Masa pasif yapıldı. Garson ekranında görünmeyecek.';
        } else {
            $yeniDurum = 1;
            $mesaj = 'Masa tekrar aktif yapıldı.';
        }

        $masaModel = new MasaModel();
        $masaModel->update($masa['id'], ['is_active' => $yeniDurum]);

        return redirect()->to('masa-yonetimi')->with('basari', $mesaj);
    }

    public function sil($id)
    {
        $masa = $this->masayiBul($id);

        if ($this->acikSiparisiVarMi($masa['id'])) {
            return redirect()->to('masa-yonetimi/duzenle/' . $masa['id'])->with('hata', 'Bu masada açık sipariş var. Önce hesabı kapatın.');
        }

        $masaModel = new MasaModel();
        $masaModel->delete($masa['id']);

        return redirect()->to('masa-yonetimi')->with('basari', 'Masa silindi.');
    }

    private function masayiBul($id)
    {
        $masaModel = new MasaModel();
        $masa = $masaModel->find($id);

        if (! $masa) {
            throw PageNotFoundException::forPageNotFound('Masa bulunamadı.');
        }

        return $masa;
    }

    private function acikSiparisiVarMi($masaId)
    {
        $siparisModel = new SiparisModel();
        $acikSiparisSayisi = $siparisModel->where('table_id', $masaId)->where('is_closed', 0)->countAllResults();

        return $acikSiparisSayisi > 0;
    }
}
