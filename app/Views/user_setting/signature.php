<div class="card">
              <div class="card-header">
                <h3 class="card-title">Tanda tangan</h3>
              </div>
                <div class="card-body row">
                  <div class="col-md-3 text-center">
                    <img id='view_sign_img' class="img-fluid img-square" src="<?=base_url().$user['signature']?>" alt="User signature">
                  </div>
                  <div class="col-md-9">
                    <form id='sign_img_form' enctype="multipart/form-data">
                      <input type="hidden" id="csrf" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                      <div class="form-group">
                        <label for="exampleInputFile">Gambar tanda tangan</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file">
                            <label class="custom-file-label" for="sign_img">Pilih file png transparan</label>
                          </div>
                          <div class="input-group-append">
                            <button type='submit' class="btn btn-success">Upload</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              
              <div class="card-footer">
              </div>

            </div>
<?= $this->section('page_script') ?>
<script>
    $("#file").change(function (){
        var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
        //alert(fileName);
        $('[for="sign_img"]').text(fileName);
    });
    $('#sign_img_form').on('submit',function(e){
        e.preventDefault();
        var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash
        var files = $('#file')[0].files;
        // Create an FormData object 
        var form_data = new FormData();
        form_data.append('file',files[0]);
        form_data.append([csrfName],csrfHash);
        
        var request = $.ajax({
            url: '<?=base_url('/api/user-setting/upload-signature')?>',
            type: 'POST',
            contentType: false,
            processData: false,  // Important!
            async: false,
            cache: false,
            timeout: 30000,
            data : form_data,
            dataType: 'json',
        });
        request.done(function(reply){
            if(reply['status'] == 1){
            $('#view_sign_img').attr("src", reply['filepath']);
            }else{
            //$('#username').val(reply['fc_data']['username']);
            alert(reply['error']);
            }
            $('#csrf').val(reply['token']);
        });
        request.fail(function(){
            alert('request failed');
        });
    });
</script>

<?= $this->endSection() ?>