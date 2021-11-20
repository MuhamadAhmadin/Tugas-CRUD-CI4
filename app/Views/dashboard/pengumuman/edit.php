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
                        <form action="<?= base_url('dashboard/pengumuman/'. $data->id .'/update') ?>" method="post">
                            <input type="hidden" name="id" value="<?= $data->id ?>" />
                            <div class="card-body">
                                <?= $this->include('layouts/components/validation_checker'); ?>
                                <div class="form-group">
                                    <label>Nama Pengumuman</label>
                                    <input type="text" name="judul" value="<?= $data->judul ?>" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="4"
                                        class="form-control"><?= $data->deskripsi ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" value="<?= $data->tanggal ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Visible</label>
                                    <div class="form-check">
                                        <input type="checkbox" name="visible" value="<?= $data->visible ?>" value="1" <?= $data->visible == 1 ? 'checked' : '' ?> class="form-check-input"
                                            id="visible">
                                        <label class="form-check-label" for="visible">Ya</label>
                                    </div>
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