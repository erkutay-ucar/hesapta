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

Önce ortam dosyasını oluşturun ve içindeki parolaları değiştirin. `.env` dosyası Git'e eklenmez.

```bash
cp .env.example .env
```

Bütün servisleri derleyip başlatmak için:

```bash
docker compose up -d --build
```

Uygulama http://localhost:8080 adresinden açılır. MySQL servisi sağlıklı olana kadar uygulama servisi başlatılmaz; durumu `docker compose ps` ile görebilirsiniz. Veritabanı dosyaları `mysql-data` adlı Docker volume içinde tutulur ve container silinse bile korunur.

Servisleri durdurmak için:

```bash
docker compose down
```

`docker compose down -v` komutu volume'u da sildiği için bütün veritabanı verilerini kaldırır.

## Durum

Proje geliştirme aşamasındadır. Kurulum ve kullanım adımları ilgili altyapı tamamlandıkça bu dosyaya eklenir.
