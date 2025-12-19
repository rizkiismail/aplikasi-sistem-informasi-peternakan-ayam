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

            <a href="/panen/create" class="btn btn-primary mb-3">Tambah Data</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Data Supir</th>
                        <th scope="col">Jumlah (ekor)</th>
                        <th scope="col">Jumlah (kg)</th>
                        <th scope="col">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($panen as $b) : ?>
                        <tr>
                            <td><?= $b['tanggal']; ?></td>
                            <td><?= $b['nama']; ?></td>
                            <td><?= $b['alamat']; ?></td>
                            <td><?= $b['data_supir']; ?></td>
                            <td><?= $b['jumlah']; ?></td>
                            <td><?= $b['kg']; ?></td>
                            <td>
                                <a href="/panen/edit/<?= $b['id']; ?>" class="btn btn-warning">Ubah</a>

                                <form action="/panen/<?= $b['id']; ?>" method="post" class="d-inline">
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