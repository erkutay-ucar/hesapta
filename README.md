# Hesapta

Hesapta, restoran yönetimi için hazırlanmış basit bir otomasyon sistemidir. Garsonlar masalardan sipariş alır, siparişler mutfak ekranına düşer, masa hesabı çıkarılır.

PHP 8.3, CodeIgniter 4 ve MySQL 8 ile yazılmıştır. Proje Docker Compose ile çalışır.

## Gerekenler

- Git
- Docker Desktop (kurulduktan sonra açık olmalı)

## Kurulum

1. Projeyi indirin ve klasörüne girin:

   ```
   git clone <repository-adresi> Hesapta
   cd Hesapta
   ```

2. `.env.example` dosyasını kopyalayıp adını `.env` yapın:

   macOS / Linux:

   ```
   cp .env.example .env
   ```

   Windows:

   ```
   copy .env.example .env
   ```

3. Projeyi başlatın:

   ```
   docker compose --profile dev up -d --build
   ```

4. Tabloları oluşturun:

   ```
   docker compose exec app php spark migrate
   ```

   "Connection refused" hatası çıkarsa MySQL henüz açılmamıştır. Birkaç saniye bekleyip tekrar deneyin.

5. Örnek verileri ekleyin:

   ```
   docker compose exec app php spark db:seed DemoSeeder
   ```

6. Tarayıcıda açın: http://localhost:8080

## Adresler

| Adres | Ne |
|---|---|
| http://localhost:8080 | Giriş sayfası |
| http://localhost:8081 | phpMyAdmin (kullanıcı: `hesapta`, şifre: `hesapta123`) |

## Örnek hesaplar

| Hesap | Giriş | Şifre / PIN |
|---|---|---|
| Restoran yöneticisi | T.C. `11111111111` | `Yonetici123` |
| Garson | T.C. `22222222222` | `123456` |
| Mutfak ekranı | Giriş sayfasındaki Mutfak Ekranı kutusu | `654321` |

## .env dosyası

| Ayar | Açıklama |
|---|---|
| `CI_ENVIRONMENT` | `development` veya `production` |
| `APP_URL` | Uygulamanın adresi (QR menüdeki bağlantı da buradan alınır) |
| `DB_NAME` | Veritabanı adı |
| `DB_USER` | Veritabanı kullanıcısı |
| `DB_PASSWORD` | Veritabanı şifresi |
| `DB_ROOT_PASSWORD` | MySQL root şifresi |

## Güncellemek için:

```
git pull
docker compose --profile dev up -d --build
docker compose exec app php spark migrate
```

Kod Docker imajının içine kopyalandığı için değişikliklerin geçmesi için `--build` gerekir.
