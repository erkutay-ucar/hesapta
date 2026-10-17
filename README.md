# Hesapta

Hesapta, birden fazla restoranın tek bir platform üzerinden yönetilebildiği web tabanlı restoran otomasyon sistemidir. Her restoran kendi personeli, masaları, menüsü, siparişleri, mutfak ekranı, ödemeleri, stokları, raporları ve QR menüsüyle diğer restoranlardan bağımsız çalışır.

## Teknolojiler

- PHP 8.3, Apache
- MySQL 8.4
- Docker ve Docker Compose
- Bootstrap 5, Bootstrap Icons, Chart.js

## Klasör yapısı

| Klasör | İçerik |
|---|---|
| `docker` | Apache ve PHP yapılandırmaları |
| `public` | Web sunucusunun kök klasörü |
| `storage/logs` | Uygulama logları |
| `storage/uploads` | Yüklenen logo ve ürün fotoğrafları |

## Docker ile çalıştırma

Bütün servisleri derleyip başlatmak için:

```bash
docker compose up -d --build
```

Uygulama http://localhost:8080 adresinden açılır. Servisleri durdurmak için:

```bash
docker compose down
```

## Durum

Proje geliştirme aşamasındadır. Kurulum ve kullanım adımları ilgili altyapı tamamlandıkça bu dosyaya eklenir.
