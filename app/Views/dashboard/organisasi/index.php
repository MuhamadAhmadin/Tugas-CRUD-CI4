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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Tabel</h3>
                            <div class="float-right">
                                <a href="<?= base_url('/dashboard/organisasi/new'); ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Founder</th>
                                        <th>Tahun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($organisasis as $item): ?>
                                    <tr>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['kode'] ?></td>
                                        <td><?= $item['nama'] ?></td>
                                        <td><?= $item['founder'] ?></td>
                                        <td><?= $item['tahun'] ?></td>
                                        <td>
                                            <a href="<?= base_url('dashboard/organisasi/'.$item['id'].'/preview') ?>"
                                                class="btn btn-sm btn-outline-secondary" target="_blank">Preview</a>
                                            <a href="<?= base_url('dashboard/organisasi/'.$item['id'].'/edit') ?>"
                                                class="btn btn-sm btn-outline-secondary">Edit</a>
                                            <a href="#" data-href="<?= base_url('dashboard/organisasi/'.$item['id'].'/delete') ?>"
                                                onclick="confirmToDelete(this)"
                                                class="btn btn-sm btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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

<?= $this->section('js') ?>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
<?= $this->endSection() ?>