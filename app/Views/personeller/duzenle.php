<?= $this->extend('layout') ?>

<?= $this->section('icerik') ?>

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">Bilgiler</div>
            <div class="card-body">
                <form method="post" action="<?= site_url('personeller/duzenle/' . $garson['id']) ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Ad Soyad</label>
                        <input type="text" name="name" class="form-control" value="<?= esc(old('name', $garson['name'])) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">T.C. Kimlik No</label>
                        <input type="text" name="tc" class="form-control" maxlength="11" inputmode="numeric" value="<?= esc(old('tc', $garson['tc'])) ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Kaydet</button>
                    <a href="<?= site_url('personeller') ?>" class="btn btn-secondary">Geri</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">PIN Değiştir</div>
            <div class="card-body">
                <form method="post" action="<?= site_url('personeller/pin/' . $garson['id']) ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Yeni PIN (6 haneli)</label>
                        <input type="password" name="pin" class="form-control" maxlength="6" inputmode="numeric" required>
                    </div>

                    <button type="submit" class="btn btn-primary">PIN'i Değiştir</button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">Durum</div>
            <div class="card-body">
                <form method="post" action="<?= site_url('personeller/durum/' . $garson['id']) ?>">
                    <?= csrf_field() ?>

                    <?php if ($garson['is_active'] == 1): ?>
                        <p>Garson şu an <strong>aktif</strong>. Pasif yapılırsa giriş yapamaz, eski siparişlerde adı görünmeye devam eder.</p>
                        <button type="submit" class="btn btn-outline-danger">Pasif Yap</button>
                    <?php else: ?>
                        <p>Garson şu an <strong>pasif</strong> ve giriş yapamıyor.</p>
                        <button type="submit" class="btn btn-outline-success">Aktif Yap</button>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
