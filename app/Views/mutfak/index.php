<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mutfak - Hesapta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="d-flex justify-content-between align-items-center bg-dark text-white px-4 py-2">
    <h4 class="mb-0">Mutfak - <?= esc(session('restoran_adi')) ?></h4>
    <a href="<?= site_url('cikis') ?>" class="btn btn-sm btn-outline-light">Çıkış</a>
</div>

<div class="container-fluid p-4">
    <?php if (session()->getFlashdata('hata')): ?>
        <div class="alert alert-danger"><?= esc(session()->getFlashdata('hata')) ?></div>
    <?php endif ?>

    <div class="card">
        <div class="card-body">
            Hazırlanacak siparişler bu ekranda görünecek.
        </div>
    </div>
</div>
</body>
</html>
