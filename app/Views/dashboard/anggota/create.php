<?= $this->extend('layouts/app'); ?>

<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<?= $this->endSection() ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?= $this->include('layouts/components/title'); ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Silahkan Isi Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="<?= base_url('dashboard/anggota/store') ?>" method="post">
                            <div class="card-body">
                                <?= $this->include('layouts/components/validation_checker'); ?>
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" name="nik" value="<?= old('nik') ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" value="<?= old('nama') ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" value="<?= old('alamat') ?>" id="alamat" cols="30" rows="4"
                                        class="form-control"><?= old('alamat') ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" id="L" type="radio" name="gender" value="L" checked>
                                            <label class="form-check-label" for="L">Laki-Laki</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="P" type="radio" name="gender" value="P">
                                            <label class="form-check-label" for="P">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Organisasi</label>
                                    <select name="organisasi_id" id="organisasi_id" class="form-control">
                                        <option value="" disabled selected>Silahkan Pilih</option>
                                        <?php foreach($organisasis as $item): ?>
                                            <option value="<?= $item->id ?>"><?= $item->nama ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select name="jabatan_id" id="jabatan_id" class="form-control">
                                        <option value="" disabled selected>Silahkan Pilih</option>
                                        <?php foreach($jabatans as $item): ?>
                                            <option value="<?= $item->id ?>"><?= $item->nama ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>