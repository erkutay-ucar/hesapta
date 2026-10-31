<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hesapta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container" style="max-width: 500px; margin-top: 100px;">
    <div class="card">
        <div class="card-body">
            <h4>Hesapta</h4>

            <?php if (session()->getFlashdata('hata')): ?>
                <div class="alert alert-danger"><?= esc(session()->getFlashdata('hata')) ?></div>
            <?php endif ?>

            <p class="mb-0">Giriş yapmak için restoranınıza ait giriş adresini kullanın.</p>
        </div>
    </div>
</div>
</body>
</html>
