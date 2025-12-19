<?= $this->extend('home/index'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">

            <a href="/recording/form_export" class="btn btn-primary mb-3">Simpan ke PDF</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Umur</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Mati</th>
                        <th scope="col">Habis Pakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recording as $p) : ?>
                        <tr>
                            <td><?= $p['umur']; ?></td>
                            <td><?= $p['tanggal']; ?></td>
                            <td><?= $p['mati']; ?></td>
                            <td><?= $p['habis_pakan']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>