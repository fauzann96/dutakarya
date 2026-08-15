<!--pick layout-->
<?= $this->extend('adminlte_layout/main') ?>

<?= $this->section('page_content') ?>

<div class="row">
    <div class="col-12">

        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <?=$this->include('user_manager/datatable');?>
            </div>
            <!-- /.card-body -->
        </div>
    <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<?= $this->endSection() ?>

<?= $this->section('page_modal') ?>
<?=$this->include('user_manager/create_user');?>
<?=$this->include('user_manager/edit_user');?>
<?=$this->include('user_manager/reset_password');?>
<?= $this->endSection() ?>

<?= $this->section('on_document_ready_script') ?>

<?= $this->endSection() ?>

<?= $this->section('page_script') ?>

<script>
  var table;
  $(function () {
    $.validator.addMethod("uniqueUsername", function (value, element) {
      let result = false;
      $.ajax({
        type: "POST",
        url: "<?=base_url('/api/user_manager/check_username')?>",
        dataType: "JSON",
        data: {
                  '<?=csrf_token()?>':$('#<?=csrf_token()?>').val(),
                  'new_username':value,
                  'edit_id':$('#edit_id').val()
              },
        success: function (reply) {
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if (reply.data === 1) {
            // console.log(data.data.email + ': This email exists.');
            result = false;
          } else {
            // console.log(data.data.email + ': This email does not exist.');
            result = true;
          }
        },
        async: false
      });
      // console.log(result);
      return result;
    });
  });

</script>

<?= $this->endSection() ?>
