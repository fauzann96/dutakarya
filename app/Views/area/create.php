     <div class="modal fade" id="modal-new">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h4 class="modal-title">Tambah Area Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_new' action=''>
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="area_name" class="col-sm-3 col-form-label">Nama Area</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_area_name" name="new_area_name" placeholder="Nama area" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                    <div class="col-sm-9">
                      <textarea type="text" class="form-control" id="new_desc" name="new_desc" placeholder="Keterangan"></textarea>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <?= $this->section('page_script') ?>
        <script type="text/javascript">
            function showModalCreate(){
                $('#modal-new').modal('show');
            }
            $('#form_new').validate({
                rules: {
                    new_name: {
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
                    let url="<?=base_url('/api/area/create')?>";
                    var request = $.ajax({
                        method: "POST",
                        async: false,
                        cache: false,
                        timeout: 30000,
                        url: url,
                        data: {
                        ["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val(),
                        name : $('#new_area_name').val(),
                        desc : $('#new_desc').val(),
                        },
                    });
                    request.done(function( reply ) {
                        $('#<?=csrf_token()?>').val(reply['new_csrf']);
                        if(reply['status'] == 1 ){
                        toastr.success('Area berhasil ditambahkan');
                        table.ajax.reload();
                        $('#modal-new').modal('hide');
                        }else{
                        toastr.error('Area gagal disimopan');
                        }
                    });
                    request.fail(function( jqXHR, textStatus, error ) {
                        var err = eval("(" + jqXHR.responseText + ")");
                        toastr.error(err.message);
                    });
                }
            });

        </script>
        <?= $this->endSection() ?>
