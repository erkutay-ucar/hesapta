<?= $this->extend('layout') ?>

<?= $this->section('icerik') ?>

<div class="card">
    <div class="card-body">
        Hoş geldiniz, <?= esc(session('kullanici_adi')) ?>.
        Masalar bu sayfada görünecek.
    </div>
</div>

<?= $this->endSection() ?>
