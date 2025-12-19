<?= $this->extend('home/index'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">

            <form action="/recording/update/<?= $recording['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('umur')) ? 'is-invalid' : ''; ?>" id="umur" name="umur" value="<?= (old('umur')) ? old('umur') : $recording['umur']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('umur'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <input type="text" class="form-control datepicker <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" value="<?= (old('tanggal')) ? old('tanggal') : $recording['tanggal']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mati" class="col-sm-2 col-form-label">Mati</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('mati')) ? 'is-invalid' : ''; ?>" id="mati" name="mati" value="<?= (old('mati')) ? old('mati') : $recording['mati']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="habis_pakan" class="col-sm-2 col-form-label">Habis Pakan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('habis_pakan')) ? 'is-invalid' : ''; ?>" id="habis_pakan" name="habis_pakan" value="<?= (old('habis_pakan')) ? old('habis_pakan') : $recording['habis_pakan']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('habis_pakan'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                        <form action="" class="d-inline">
                            <a href="/recording/" class="btn btn-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>