<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giriş - <?= esc($ayar['restaurant_name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container" style="max-width: 400px; margin-top: 100px;">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-1"><?= esc($ayar['restaurant_name']) ?></h4>
            <p class="text-muted">Yönetici ve Garson Girişi</p>

            <?php if (session()->getFlashdata('hata')): ?>
                <div class="alert alert-danger"><?= esc(session()->getFlashdata('hata')) ?></div>
            <?php endif ?>

            <form method="post" action="<?= site_url('giris') ?>">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label">T.C. Kimlik No</label>
                    <input type="text" name="tc" class="form-control" maxlength="11" inputmode="numeric" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">PIN / Şifre</label>
                    <input type="password" name="sifre" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h6 class="mb-3">Mutfak Ekranı</h6>

            <form method="post" action="<?= site_url('mutfak-giris') ?>">
                <?= csrf_field() ?>

                <div class="input-group">
                    <input type="password" name="pin" class="form-control" placeholder="Mutfak PIN'i" maxlength="6" inputmode="numeric" required>
                    <button type="submit" class="btn btn-dark">Aç</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
