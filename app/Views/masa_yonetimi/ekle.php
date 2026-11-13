<?= $this->extend('layout') ?>

<?= $this->section('icerik') ?>

<div class="card" style="max-width: 500px;">
    <div class="card-body">
        <form method="post" action="<?= site_url('masa-yonetimi/ekle') ?>">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Masa Adı</label>
                <input type="text" name="name" class="form-control" placeholder="Örneğin: Bahçe 3" value="<?= esc(old('name')) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Kaydet</button>
            <a href="<?= site_url('masa-yonetimi') ?>" class="btn btn-secondary">Vazgeç</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
