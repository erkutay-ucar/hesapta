# Hesapta

Hesapta, PHP 8.3, CodeIgniter 4 ve MySQL 8 ile yazılmış basit bir restoran otomasyonudur.
Proje Docker Compose ile çalışır.

## Gerekenler

- Git
- Docker Desktop

## Kurulum

1. `.env.example` dosyasını kopyalayıp adını `.env` yap.

   Windows (PowerShell):

   ```
   copy .env.example .env
   ```

   macOS / Linux:

   ```
   cp .env.example .env
   ```

2. Projeyi başlat:

   ```
   docker compose --profile dev up -d --build
   ```

3. Tarayıcıda aç:

   - Uygulama: http://localhost:8080
   - phpMyAdmin: http://localhost:8081

4. Tabloları oluştur:

   ```
   docker compose exec app php spark migrate
   ```

5. Örnek verileri ekle:

   ```
   docker compose exec app php spark db:seed DemoSeeder
   ```

## Örnek giriş bilgileri

Bu bilgiler `DemoSeeder` ile eklenir. T.C. numaraları sahtedir.

| Rol | Giriş | Şifre / PIN |
|---|---|---|
| Platform yöneticisi | Kullanıcı adı: `admin` | `Admin1234` |
| Restoran yöneticisi | T.C.: `11111111111` | `Yonetici123` |
| Garson | T.C.: `22222222222` | `123456` |
| Mutfak personeli | T.C.: `33333333333` | `654321` |

Örnek restoran: **Lezzet Durağı** (id: 1)

## Veritabanı tabloları

| Tablo | İçerik |
|---|---|
| `restaurants` | Restoranlar |
| `users` | Platform yöneticisi, restoran yöneticileri, garsonlar, mutfak personeli |
| `restaurant_tables` | Masalar |
| `categories` | Menü kategorileri |
| `products` | Ürünler |
| `orders` | Mutfağa giden siparişler (durum ve hesap açık/kapalı bilgisi) |
| `order_items` | Sipariş kalemleri (adet, o anki fiyat, not, iptal bilgisi) |

Platform yöneticisi dışındaki her kayıt `restaurant_id` ile bir restorana bağlıdır.

## .env dosyası

| Ayar | Açıklama |
|---|---|
| `CI_ENVIRONMENT` | `development` veya `production` |
| `APP_URL` | Uygulamanın adresi. CodeIgniter'a `app.baseURL` olarak verilir. |
| `DB_NAME` | Veritabanı adı |
| `DB_USER` | Veritabanı kullanıcısı |
| `DB_PASSWORD` | Veritabanı şifresi |
| `DB_ROOT_PASSWORD` | MySQL root şifresi |

`compose.yaml` bu değerleri hem MySQL'e hem de CodeIgniter'a verir.
Böylece veritabanı bilgileri tek bir yerde (`.env`) yazılı olur.

## phpMyAdmin girişi

- Kullanıcı: `hesapta`
- Şifre: `hesapta123`

## Sık kullanılan komutlar

| İş | Komut |
|---|---|
| Projeyi başlat (phpMyAdmin dahil) | `docker compose --profile dev up -d --build` |
| Projeyi durdur | `docker compose --profile dev down` |
| Tabloları oluştur | `docker compose exec app php spark migrate` |
| Örnek verileri ekle | `docker compose exec app php spark db:seed DemoSeeder` |
| Tabloları silip yeniden oluştur | `docker compose exec app php spark migrate:refresh` |
| Veritabanını tamamen sıfırla | `docker compose --profile dev down -v` |
| Hata loglarını gör | `docker compose logs app` |

Kodda değişiklik yaptıktan sonra projeyi `--build` ile yeniden başlat.
Kod, Docker imajının içine kopyalanır.
