<?= $this->extend('layout') ?>

<?= $this->section('icerik') ?>

<?php if (session()->getFlashdata('hatalar')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('hatalar') as $hataMesaji): ?>
            <div><?= esc($hataMesaji) ?></div>
        <?php endforeach ?>
    </div>
<?php endif ?>

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">Restoran Bilgileri</div>
            <div class="card-body">
                <form method="post" action="<?= site_url('ayarlar/restoran') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Restoran Adı</label>
                        <input type="text" name="restaurant_name" class="form-control" value="<?= esc($ayar['restaurant_name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Adres</label>
                        <input type="text" name="address" class="form-control" value="<?= esc($ayar['address']) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telefon</label>
                        <input type="text" name="phone" class="form-control" value="<?= esc($ayar['phone']) ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">Mutfak PIN'i</div>
            <div class="card-body">
                <form method="post" action="<?= site_url('ayarlar/mutfak-pin') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Yeni PIN</label>
                        <input type="password" name="pin" class="form-control" maxlength="6" inputmode="numeric" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Yeni PIN (Tekrar)</label>
                        <input type="password" name="pin_tekrar" class="form-control" maxlength="6" inputmode="numeric" required>
                    </div>

                    <button type="submit" class="btn btn-primary">PIN'i Değiştir</button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">Şifremi Değiştir</div>
            <div class="card-body">
                <form method="post" action="<?= site_url('ayarlar/sifre') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Mevcut Şifre</label>
                        <input type="password" name="mevcut_sifre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Yeni Şifre</label>
                        <input type="password" name="yeni_sifre" class="form-control" minlength="8" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Yeni Şifre (Tekrar)</label>
                        <input type="password" name="yeni_sifre_tekrar" class="form-control" minlength="8" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Şifreyi Değiştir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
