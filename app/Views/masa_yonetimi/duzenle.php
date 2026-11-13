<?= $this->extend('layout') ?>

<?= $this->section('icerik') ?>

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">Masa Adı</div>
            <div class="card-body">
                <form method="post" action="<?= site_url('masa-yonetimi/duzenle/' . $masa['id']) ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" value="<?= esc(old('name', $masa['name'])) ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Kaydet</button>
                    <a href="<?= site_url('masa-yonetimi') ?>" class="btn btn-secondary">Geri</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">Durum</div>
            <div class="card-body">
                <form method="post" action="<?= site_url('masa-yonetimi/durum/' . $masa['id']) ?>">
                    <?= csrf_field() ?>

                    <?php if ($masa['is_active'] == 1): ?>
                        <p>Masa şu an <strong>aktif</strong>. Pasif yapılırsa garson ekranında görünmez.</p>
                        <button type="submit" class="btn btn-outline-secondary">Pasif Yap</button>
                    <?php else: ?>
                        <p>Masa şu an <strong>pasif</strong>.</p>
                        <button type="submit" class="btn btn-outline-success">Aktif Yap</button>
                    <?php endif ?>
                </form>
            </div>
        </div>

        <div class="card mb-4 border-danger">
            <div class="card-header">Masayı Sil</div>
            <div class="card-body">
                <p>Masa tamamen silinir. Bu masada verilmiş eski siparişler silinmez.</p>
                <form method="post" action="<?= site_url('masa-yonetimi/sil/' . $masa['id']) ?>" onsubmit="return confirm('Masa silinsin mi?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">Masayı Sil</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
