    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Hapus Area</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_delete' action=''>
                <input type="hidden" id='delete_id' value="">
                <div class="modal-body">
                  <h3 id='delete_confirm_text'></h3>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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
            function showDeleteModal(id){
                $('#delete_id').val(id);
                $('#delete_confirm_text').html("Apakah anda yakin ingin menghapus area ini ?");
                $('#modal-delete').modal('show');
            }
            $('#form_delete').submit(function(e){
                e.preventDefault();
                let id = $('#delete_id').val();
                var request = $.ajax({
                    url: "<?=base_url('api/area/delete')?>",
                    type: "POST",
                    data: {id:id,["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val()},
                });
                request.done(function(reply){
                  $('#<?=csrf_token()?>').val(reply['new_csrf']);
                  if(reply['status'] == 1){
                    $('#modal-delete').modal('hide');
                    table.ajax.reload();
                    toastr.success('Area berhasil dihapus');
                  }else{
                    toastr.error('Area gagal dihapus');
                  }
                });
                request.fail(function(){
                  alert('request failed');
                });
            });
        </script>
        <?= $this->endSection() ?>