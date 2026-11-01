<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($baslik ?? 'Hesapta') ?> - Hesapta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="d-flex" style="min-height: 100vh;">
    <div class="bg-white border-end p-3" style="width: 230px;">
        <h4 class="mb-0">Hesapta</h4>
        <div class="small text-muted mb-3">
            <?php if (session('restoran_adi')): ?>
                <strong><?= esc(session('restoran_adi')) ?></strong><br>
            <?php endif ?>
            <?= esc(session('kullanici_adi')) ?><br>
            <?= esc(rol_adi(session('rol'))) ?>
        </div>

        <div class="list-group">
            <?php if (session('rol') === 'manager'): ?>
                <a href="<?= site_url('yonetim') ?>" class="list-group-item list-group-item-action">Ana Sayfa</a>
                <a href="<?= site_url('masalar') ?>" class="list-group-item list-group-item-action">Masalar</a>
                <a href="<?= site_url('ayarlar') ?>" class="list-group-item list-group-item-action">Ayarlar</a>
                <a href="<?= site_url('cikis') ?>" class="list-group-item list-group-item-action text-danger">Çıkış</a>
            <?php endif ?>

            <?php if (session('rol') === 'waiter'): ?>
                <a href="<?= site_url('masalar') ?>" class="list-group-item list-group-item-action">Masalar</a>
                <a href="<?= site_url('cikis') ?>" class="list-group-item list-group-item-action text-danger">Çıkış</a>
            <?php endif ?>
        </div>
    </div>

    <div class="flex-grow-1 p-4">
        <h3 class="mb-4"><?= esc($baslik ?? '') ?></h3>

        <?php if (session()->getFlashdata('basari')): ?>
            <div class="alert alert-success"><?= esc(session()->getFlashdata('basari')) ?></div>
        <?php endif ?>

        <?php if (session()->getFlashdata('hata')): ?>
            <div class="alert alert-danger"><?= esc(session()->getFlashdata('hata')) ?></div>
        <?php endif ?>

        <?= $this->renderSection('icerik') ?>
    </div>
</div>
</body>
</html>
