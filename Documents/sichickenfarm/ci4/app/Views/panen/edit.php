<?= $this->extend('home/index'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">

            <form action="/panen/update/<?= $panen['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <input type="text" class="form-control datepicker <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" value="<?= (old('tanggal')) ? old('tanggal') : $panen['tanggal']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?> id="nama" name="nama" value="<?= (old('nama')) ? old('nama') : $panen['nama']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?> id="alamat" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $panen['alamat']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="data_supir" class="col-sm-2 col-form-label">Data Supir (No. Mobil & Nama)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" <?= ($validation->hasError('data_supir')) ? 'is-invalid' : ''; ?> id="data_supir" name="data_supir" value="<?= (old('data_supir')) ? old('data_supir') : $panen['data_supir']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('data_supir'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah (ekor)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?> id="jumlah" name="jumlah" value="<?= (old('jumlah')) ? old('jumlah') : $panen['jumlah']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kg" class="col-sm-2 col-form-label">Jumlah (kg)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" <?= ($validation->hasError('kg')) ? 'is-invalid' : ''; ?> id="kg" name="kg" value="<?= (old('kg')) ? old('kg') : $panen['kg']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kg'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                        <form action="" class="d-inline">
                            <a href="/panen/" class="btn btn-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>