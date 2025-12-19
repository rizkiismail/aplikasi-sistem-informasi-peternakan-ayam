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

            <div class="form-group row">
                    <a href="/obat/create" class="btn btn-primary mb-3">Tambah Data Obat</a>
                    <form action="" class="d-inline">
                        <a href="/obatmasuk/" class="btn btn-primary">Tambah Stok Obat</a>
                    </form>
                    <form action="" class="d-inline">
                        <a href="/pengobatan/" class="btn btn-primary">Pengobatan</a>
                    </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($obat as $o) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $o['jenis']; ?></td>
                            <td><?= $o['jumlah']; ?></td>
                            <td>
                                <a href="/obat/edit/<?= $o['id']; ?>" class="btn btn-warning">Ubah</a>

                                <form action="/obat/<?= $o['id']; ?>" method="post" class="d-inline">
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