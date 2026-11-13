<?= $this->extend('layout') ?>

<?= $this->section('icerik') ?>

<a href="<?= site_url('personeller/ekle') ?>" class="btn btn-primary mb-3">Garson Ekle</a>

<div class="card mb-4">
    <div class="card-header">Garsonlar</div>
    <div class="card-body">
        <?php if (empty($aktifGarsonlar)): ?>
            <p class="mb-0">Aktif garson yok.</p>
        <?php else: ?>
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Ad Soyad</th>
                        <th>T.C. Kimlik No</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aktifGarsonlar as $garson): ?>
                        <tr>
                            <td><?= esc($garson['name']) ?></td>
                            <td><?= esc($garson['tc']) ?></td>
                            <td class="text-end">
                                <a href="<?= site_url('personeller/duzenle/' . $garson['id']) ?>" class="btn btn-sm btn-outline-primary">Düzenle</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</div>

<?php if (! empty($pasifGarsonlar)): ?>
    <div class="card">
        <div class="card-header">Eski Personeller</div>
        <div class="card-body">
            <table class="table mb-0 text-muted">
                <thead>
                    <tr>
                        <th>Ad Soyad</th>
                        <th>T.C. Kimlik No</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pasifGarsonlar as $garson): ?>
                        <tr>
                            <td><?= esc($garson['name']) ?></td>
                            <td><?= esc($garson['tc']) ?></td>
                            <td class="text-end">
                                <a href="<?= site_url('personeller/duzenle/' . $garson['id']) ?>" class="btn btn-sm btn-outline-secondary">Düzenle</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif ?>

<?= $this->endSection() ?>
