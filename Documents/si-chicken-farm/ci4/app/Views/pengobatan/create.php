<?= $this->extend('home/index'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">

            <form action="/pengobatan/save" method="post">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <input type="text" class="form-control datepicker <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" value="<?= old('tanggal'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal'); ?>
                            </div>
                        </div>
                    </div>
                </div>

<div class="form-group row">
<label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
<div class="col-sm-10">
    <select class="form-control" name= "jenis" id= "jenis">
    <option selected="0">-Pilih-</option>
    <?php foreach($jenisobat as $j) : ?>
    <option value="<?= $j['jenis'];?>"><?= $j['jenis']; ?></option>
    <?php endforeach; ?>
    </select>
</div>
</div>

                <div class="form-group row">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" value="<?= old('jumlah'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                        <form action="" class="d-inline">
                            <a href="/pengobatan/" class="btn btn-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>