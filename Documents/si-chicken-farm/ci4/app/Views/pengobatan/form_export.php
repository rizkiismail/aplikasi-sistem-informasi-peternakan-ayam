<?= $this->extend('home/index'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Form Export
                </div>
                <div class="card-body">
                    <form action="<?= base_url('pengobatan/export') ?>" method="post" target="_blank">
                        <div class="form-group">
                            <label for="">Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Buka Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>