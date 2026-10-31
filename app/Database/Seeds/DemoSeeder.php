<?php

namespace App\Database\Seeds;

use App\Models\AyarModel;
use App\Models\KategoriModel;
use App\Models\KullaniciModel;
use App\Models\MasaModel;
use App\Models\UrunModel;
use CodeIgniter\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run()
    {
        $ayarModel = new AyarModel();
        $kullaniciModel = new KullaniciModel();
        $masaModel = new MasaModel();
        $kategoriModel = new KategoriModel();
        $urunModel = new UrunModel();

        $ayarModel->insert([
            'restaurant_name'  => 'Lezzet Durağı',
            'address'          => 'Örnek Mahallesi, Lezzet Sokak No: 1',
            'phone'            => '0212 000 00 00',
            'kitchen_pin_hash' => password_hash('654321', PASSWORD_DEFAULT),
        ]);

        $kullaniciModel->insert([
            'role'          => 'manager',
            'name'          => 'Ayşe Yılmaz',
            'tc'            => '11111111111',
            'password_hash' => password_hash('Yonetici123', PASSWORD_DEFAULT),
            'is_active'     => 1,
        ]);

        $kullaniciModel->insert([
            'role'          => 'waiter',
            'name'          => 'Mehmet Demir',
            'tc'            => '22222222222',
            'password_hash' => password_hash('123456', PASSWORD_DEFAULT),
            'is_active'     => 1,
        ]);

        $masalar = ['Salon 1', 'Salon 2', 'Salon 3', 'Bahçe 1', 'Bahçe 2', 'Teras 1'];

        foreach ($masalar as $masaAdi) {
            $masaModel->insert([
                'name'      => $masaAdi,
                'is_active' => 1,
            ]);
        }

        $menu = [
            'Çorbalar' => [
                ['Mercimek Çorbası', 'Limon ve kıtır ekmek ile', 90],
                ['Ezogelin Çorbası', 'Nane ve pul biberli', 90],
            ],
            'Ana Yemekler' => [
                ['Izgara Köfte', 'Pilav ve közlenmiş biber ile', 280],
                ['Tavuk Şiş', 'Bulgur pilavı ve salata ile', 240],
                ['Etli Nohut', 'Pirinç pilavı ile', 220],
            ],
            'Tatlılar' => [
                ['Sütlaç', 'Fırında pişmiş', 110],
                ['Künefe', 'Antep fıstıklı', 160],
            ],
            'İçecekler' => [
                ['Ayran', 'Yayık ayranı', 35],
                ['Çay', 'İnce belli bardakta', 20],
                ['Kola', '330 ml kutu', 50],
            ],
        ];

        foreach ($menu as $kategoriAdi => $urunler) {
            $kategoriId = $kategoriModel->insert([
                'name'      => $kategoriAdi,
                'is_active' => 1,
            ]);

            foreach ($urunler as $urun) {
                $urunModel->insert([
                    'category_id' => $kategoriId,
                    'name'        => $urun[0],
                    'description' => $urun[1],
                    'price'       => $urun[2],
                    'is_active'   => 1,
                ]);
            }
        }
    }
}
