<?= $this->extend('layout') ?>

<?= $this->section('icerik') ?>

<a href="<?= site_url('masa-yonetimi/ekle') ?>" class="btn btn-primary mb-3">Masa Ekle</a>

<div class="card mb-4">
    <div class="card-header">Masalar</div>
    <div class="card-body">
        <?php if (empty($aktifMasalar)): ?>
            <p class="mb-0">Aktif masa yok.</p>
        <?php else: ?>
            <table class="table mb-0">
                <tbody>
                    <?php foreach ($aktifMasalar as $masa): ?>
                        <tr>
                            <td><?= esc($masa['name']) ?></td>
                            <td class="text-end">
                                <a href="<?= site_url('masa-yonetimi/duzenle/' . $masa['id']) ?>" class="btn btn-sm btn-outline-primary">Düzenle</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</div>

<?php if (! empty($pasifMasalar)): ?>
    <div class="card">
        <div class="card-header">Pasif Masalar</div>
        <div class="card-body">
            <table class="table mb-0 text-muted">
                <tbody>
                    <?php foreach ($pasifMasalar as $masa): ?>
                        <tr>
                            <td><?= esc($masa['name']) ?></td>
                            <td class="text-end">
                                <a href="<?= site_url('masa-yonetimi/duzenle/' . $masa['id']) ?>" class="btn btn-sm btn-outline-secondary">Düzenle</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif ?>

<?= $this->endSection() ?>
