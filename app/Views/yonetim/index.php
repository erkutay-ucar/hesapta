<?= $this->extend('layout') ?>

<?= $this->section('icerik') ?>

<div class="card">
    <div class="card-body">
        Hoş geldiniz, <?= esc(session('kullanici_adi')) ?>.
        Restoranınızın yönetim işlemleri bu panelden yapılacak.
    </div>
</div>

<?= $this->endSection() ?>
