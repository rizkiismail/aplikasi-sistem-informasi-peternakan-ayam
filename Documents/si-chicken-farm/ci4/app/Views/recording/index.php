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

            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Stok Pakan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php foreach ($stokpakan as $s) : ?>
                                            <td><?= $s['jumlah']; ?></td>
                                        <?php endforeach; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Annual) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Jumlah Ayam Saat Ini</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php foreach ($sisaayam as $z) : ?>
                                            <td><?= $z['jumlah']; ?></td>
                                        <?php endforeach; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="/recording/create" class="btn btn-primary mb-3">Tambah Data</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Umur</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Mati</th>
                        <th scope="col">Habis Pakan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($recording as $b) : ?>
                        <tr>
                            <td><?= $b['umur']; ?></td>
                            <td><?= $b['tanggal']; ?></td>
                            <td><?= $b['mati']; ?></td>
                            <td><?= $b['habis_pakan']; ?></td>
                            <td>
                                <a href="/recording/edit/<?= $b['id']; ?>" class="btn btn-warning">Ubah</a>

                                <form action="/recording/<?= $b['id']; ?>" method="post" class="d-inline">
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