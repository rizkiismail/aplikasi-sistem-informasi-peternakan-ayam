<?= $this->extend('home/index'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <a href="/bibit/create" class="btn btn-primary mb-3">Tambah Data Bibit</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($bibit as $b) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $b['tanggal']; ?></td>
                            <td><?= $b['jenis']; ?></td>
                            <td><?= $b['jumlah']; ?></td>
                            <td>
                                <a href="/bibit/edit/<?= $b['id']; ?>" class="btn btn-warning">Ubah</a>

                                <form action="/bibit/<?= $b['id']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
                                    </input>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>