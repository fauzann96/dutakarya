<!--pick layout-->
<?= $this->extend('adminlte_layout/main') ?>

<?= $this->section('page_content') ?>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-body">
                <?= $this->include('area/datatable');?>
            </div>
            <!-- /.card-body -->
        </div>
    <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<?= $this->endSection() ?>

<?= $this->section('page_modal') ?>

<?= $this->include('area/create');?>
<?= $this->include('area/edit');?>
<?= $this->include('area/delete');?>

<?= $this->endSection() ?>

<?= $this->section('on_document_ready_script') ?>
    <!-- loadTableData();  contoh -->
<?= $this->endSection() ?>

<?= $this->section('page_script') ?>

<?= $this->endSection() ?>
