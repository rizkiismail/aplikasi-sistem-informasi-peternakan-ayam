<?= $this->extend('home/index'); ?>
<?= $this->section('content'); ?>

<!-- Page Heading -->

<div class="container">
    <div class="col justify-content-center align-items-center">
        <form>
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
        </form>
    </div>


    <?= $this->endSection(); ?>