<div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Hapus</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_delete' action=''>
                <input type="hidden" id='delete_id' value="">
                <div class="modal-body">
                  <center><h3 id="delete_confirm"></h3></center>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<?= $this->section('page_script') ?>
    <script type="text/javascript">
      $('#form_delete').validate({
    rules: {
    },
    messages: {
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group div').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
    submitHandler:function(event){
        var csrfName = '<?=csrf_token()?>';
        var request = $.ajax({
            url: '<?=base_url('/calendar_manager/delete/submit')?>',
            type: 'POST',
            async: false,
            cache: false,
            timeout: 30000,
            data:{
              '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
              id : $('#delete_id').val(),
            }
        });
        request.done(function(reply){
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1){
            $('#modal-delete').modal('hide');
            table.ajax.reload();
            toastr.success('Data berhasil dihapus');
          }else{
            toastr.error('Data gagal dihapus');
          }
        });
        request.fail(function(){
          alert('request failed');
        });
      }
});

    </script>
<?= $this->endSection() ?>