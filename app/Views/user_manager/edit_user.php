      <div class="modal fade " id="modal-edit">
        <div class="modal-dialog modal-md">
          <div class="modal-content text-sm">
            <form id='form_edit' action=''>
              <input type="hidden" name="edit_id" id='edit_id'>
            <div class="modal-header bg-info">
              <h4 class="modal-title">Edit Pengguna</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tipe Pengguna</label>
                <div class="col-sm-9">
                  <?= view_cell('App\Views\user_type\UserTypeCell::Options', ['id' => 'edit_user_type', 'name' => 'edit_user_type']) ?> 
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                  <input id="edit_username" name="edit_username" class="form-control" style="width: 100%;">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input id="edit_name" name="edit_name" class="form-control" style="width: 100%;">
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
  <script>
    function showEditModal(id){
      // Implementation for showing edit modal
      // This function should populate the form fields with the user's current data
      // and then display the modal.
      // Example:
      loadUserTypes();
      $.ajax({
        url: '<?=base_url('/api/user_manager/user_data/')?>' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          var data = data.data; // Assuming the API returns user data in a 'data' field
          $('#edit_id').val(data.id);
          loadUserTypes(data.user_type_seq); // Load user types and set the selected one
          $('#edit_username').val(data.username);
          $('#edit_name').val(data.name);
          $('#modal-edit').modal('show');
        }
      });
    }

    $('#form_edit').validate({
      rules: {
        edit_user_type: {
          required: true,
        },
        edit_username: {
          required: true,
          uniqueUsername: true,
        },
        edit_name: {
          required: true,
        },
      },
      messages: {
        new_username: {
          uniqueUsername: "Username sudah digunakan."
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
        $(element).addClass('is-valid');
      },
      submitHandler:function(event){
        var form_data = new FormData();
        form_data.append('id',$('#edit_id').val());
        form_data.append('user_type',$('#edit_user_type').val());
        form_data.append('username',$('#edit_username').val());
        form_data.append('name',$('#edit_name').val());
        form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      
        var request = $.ajax({
              url: '<?=base_url('/api/user_manager/edit/submit')?>',
              type: 'POST',
              contentType: false,
              processData: false,  // Important!
              async: false,
              cache: false,
              timeout: 30000,
              data : form_data,
              dataType: 'json',
          });
        
        request.done(function( reply ) {
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1 ){
            toastr.success('User berhasil diupdate');
            $('#modal-edit').modal('hide');
            table.ajax.reload();
            $("#form_edit")[0].reset();
          }else{
            toastr.danger('User gagal diupdate');
          }
        });
        request.fail(function( jqXHR, textStatus, error ) {
          var err = eval("(" + jqXHR.responseText + ")");
          toastr.danger(err.message);
        });
      }
  });
</script>
<?= $this->endSection() ?>