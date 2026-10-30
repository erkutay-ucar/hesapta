<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Platform Yöneticisi Girişi - Hesapta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container" style="max-width: 400px; margin-top: 100px;">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-1">Hesapta</h4>
            <p class="text-muted">Platform Yöneticisi Girişi</p>

            <?php if (session()->getFlashdata('hata')): ?>
                <div class="alert alert-danger"><?= esc(session()->getFlashdata('hata')) ?></div>
            <?php endif ?>

            <form method="post" action="<?= site_url('admin') ?>">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label">Kullanıcı Adı</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Şifre</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
