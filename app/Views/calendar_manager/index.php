<!--pick layout-->
<?= $this->extend('adminlte_layout/main') ?>

<?= $this->section('page_content') ?>

  <div class="row">
    <div class="col-12">
      <div class="card"> 
        <div class="card-body">
          <?=$this->include('calendar_manager/datatable')?>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
<?= $this->endSection() ?>

<?= $this->section('page_modal') ?>

<?=$this->include('calendar_manager/create')?>
<?=$this->include('calendar_manager/update')?>
<?=$this->include('calendar_manager/delete')?>s

<?= $this->endSection() ?>

<?= $this->section('on_document_ready_script') ?>
    <!-- loadTableData();  contoh -->
<?= $this->endSection() ?>

<?= $this->section('page_script') ?>

<?= $this->endSection() ?>
