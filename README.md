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
| Hata loglarını gör | `docker compose logs app` |

Kodda değişiklik yaptıktan sonra projeyi `--build` ile yeniden başlat.
Kod, Docker imajının içine kopyalanır.
