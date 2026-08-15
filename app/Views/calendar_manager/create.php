<div class="modal fade" id="modal-new">
        <div class="modal-dialog">
          <div class="modal-content">
            <form id='form_new' action=''>
              <div class="modal-header bg-success">
                <h4 class="modal-title">Libur/Cuti Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label for="new_name" class="col-sm-4 col-form-label">Nama</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="new_name" name="new_name" placeholder="Nama">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="new_date" class="col-sm-4 col-form-label">Tanggal</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" id="new_date" name="new_date">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="new_type" class="col-sm-4 col-form-label">Tipe</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="new_type" name="new_type"></select>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<?= $this->section('page_script') ?>
    <script type="text/javascript">
      $('#form_new').validate({
    rules: {
      new_name: {
        required: true,
      },
      new_date: {
        required: true,
      },
      new_type: {
        required: true,
      },
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
            url: '<?=base_url('/calendar_manager/new/submit')?>',
            type: 'POST',
            async: false,
            cache: false,
            timeout: 30000,
            data:{
              '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
              name : $('#new_name').val(),
              date : $('#new_date').val(),
              type : $('#new_type').val(),
            }
        });
        request.done(function(reply){
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1){
            toastr.success('Libur berhasil ditambahkan');
            $('#modal-new').modal('hide');
            table.ajax.reload();
          }else{
            //$('#username').val(reply['fc_data']['username']);
            toastr.error('Libur gagal disimpan');
          }
        });
        request.fail(function(){
          toastr.error('request failed');
        });
      }
});
    </script>
<?= $this->endSection() ?>