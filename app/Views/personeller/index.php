<?= $this->extend('layout') ?>

<?= $this->section('icerik') ?>

<a href="<?= site_url('personeller/ekle') ?>" class="btn btn-primary mb-3">Garson Ekle</a>

<div class="card">
    <div class="card-body">
        <?php if (empty($garsonlar)): ?>
            <p class="mb-0">Henüz garson eklenmemiş.</p>
        <?php else: ?>
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Ad Soyad</th>
                        <th>T.C. Kimlik No</th>
                        <th>Durum</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($garsonlar as $garson): ?>
                        <tr>
                            <td><?= esc($garson['name']) ?></td>
                            <td><?= esc($garson['tc']) ?></td>
                            <td>
                                <?php if ($garson['is_active'] == 1): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Pasif</span>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</div>

<?= $this->endSection() ?>
