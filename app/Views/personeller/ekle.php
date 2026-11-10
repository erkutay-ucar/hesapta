<?= $this->extend('layout') ?>

<?= $this->section('icerik') ?>

<div class="card" style="max-width: 500px;">
    <div class="card-body">
        <form method="post" action="<?= site_url('personeller/ekle') ?>">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Ad Soyad</label>
                <input type="text" name="name" class="form-control" value="<?= esc(old('name')) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">T.C. Kimlik No</label>
                <input type="text" name="tc" class="form-control" maxlength="11" inputmode="numeric" value="<?= esc(old('tc')) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">PIN (6 haneli)</label>
                <input type="password" name="pin" class="form-control" maxlength="6" inputmode="numeric" required>
            </div>

            <button type="submit" class="btn btn-primary">Kaydet</button>
            <a href="<?= site_url('personeller') ?>" class="btn btn-secondary">Vazgeç</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
