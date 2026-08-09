<!DOCTYPE html>
<html lang="en">
<head>
  <?=$this->include('meta')?>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('/plugins/select2/css/select2.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/dist/css/adminlte.min.css')?>">
            <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('/plugins/toastr/toastr.min.css')?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?=$this->include('preloader');?>
  <?=$this->include('navbar_lte');?>
  <?=$this->include(session()->get('sidebar'));?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=session()->get('title')?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calon TAD</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <input type="hidden" name="">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img id="img_pas" src="<?=base_url().$data['foto_pas_path'].$data['foto_pas']?>" alt="pas foto" class="img-thumbnail" style="opacity: 1;width:80%"><br>
                  <button class="btn btn-sm" onclick="$('#modal-change-pas').modal('show');"><i class="far fa-edit"></i> Ganti Pas Foto</button>
                </div>

                <h3 id="name_txt" class="profile-username text-center"><?=$data['name']?></h3>

                <ul class="list-group list-group-unbordered mb-3  text-center">
                  <li class="list-group-item">
                    <strong >Posisi Dilamar</strong>
                    <p id="position_txt" class="text-muted">
                      <?=$data['position'] ?: '-'?>
                    </p>
                  </li>
                  <li class="list-group-item">
                    <strong>Tanggal Lamaran Masuk</strong>
                    <p id="entry_date_txt" class="text-muted">
                      <?=$data['created_at'] ?: '-'?>
                    </p>
                  </li>
                  <li class="list-group-item">
                    <div class="btn-group"><button type="button" class="btn btn-primary btn-xs" onclick="showModalEdit()"><i class="far fa-edit"></i> Edit</button><button type="button" id="delete" class="btn btn-danger btn-xs" onclick="$('#modal-delete').modal('show');"><i class="fas fa-trash"></i> Hapus</button></div>
                  </li>
                  
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->   
          </div>

          <!-- /.col -->
          <div class="col-md-9">
            <!-- About Me Box -->
            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3 col-12">
                    <strong class="align-middle"><i class="fas fa-book mr-1"></i> KTP</strong>
                    <button class="btn btn-sm" onclick="$('#modal-change-ktp').modal('show');"><i class="far fa-edit"></i> Ganti Foto KTP</button>
                  </div>
                  <div class="col-sm-9 col-12 text-center">
                    <img id="img_ktp" src="<?=base_url().$data['foto_ktp_path'].$data['foto_ktp']?>" alt="KTP" class="img-thumbnail" style="opacity: 1;width:80%">
                  </div>
                </div>
                
                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Nomor Telepon</strong>

                <p id="phone_txt" class="text-muted"><?=$data['phone'] ?: '-'?>  <a href="https://wa.me/" target="_blank"><i class="fab fa-whatsapp"></i></a></p>

                <hr>

                <div class="row">
                  <div class="col-sm-3 col-12">
                    <strong class="align-middle"><i class="fas fa-book mr-1"></i> SIM</strong>
                    <button class="btn btn-sm" onclick="$('#modal-change-sim').modal('show');"><i class="far fa-edit"></i> Ganti Foto SIM</button>
                  </div>
                  <div class="col-sm-9 col-12 text-center">
                    <img id="img_sim" src="<?=base_url().$data['foto_sim_path'].$data['foto_sim']?>" alt="SIM" class="img-thumbnail" style="opacity: 1;width:80%">
                  </div>
                </div>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Pendidikan Terakhir</strong>

                <p id="education_txt" class="text-muted">
                  <?=$data['education'] ?: '-'?>
                </p>

                

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

                  <!-- modal -->
      <div class="modal fade " id="modal-edit">
        <div class="modal-dialog modal-xl">
          <div class="modal-content text-sm">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Edit Calon TAD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_edit'>
              <input type="hidden" name="edit_id" id="edit_id" value=<?=$data['id']?>>
                <div class="modal-body">
                    <div class="form-group row">
                      <label for="edit_name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Nama Lengkap" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_phone" class="col-sm-3 col-form-label">Telepon/WA</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_phone" name="edit_phone" placeholder="Telepon/WA" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_position" class="col-sm-3 col-form-label">Posisi</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_position" name="edit_position" placeholder="Posisi Dilamar" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_sim" class="col-sm-3 col-form-label">SIM</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edit_sim' name='edit_sim' placeholder='SIM' required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_education" class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                      <div class="col-sm-9">
                        <input class="form-control" id="edit_education"  name="edit_education" placeholder="Pendidikan" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="edit_note" class="col-sm-3 col-form-label">Catatan</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" id="edit_note"  name="edit_note" placeholder="Catatan" required></textarea>
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
           <!-- modal -->
      <div class="modal fade " id="modal-change-ktp">
        <div class="modal-dialog modal-xl">
          <div class="modal-content text-sm">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Ganti Gambar KTP</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_change_ktp'>
              <input type="hidden" id="change_id" value=<?=$data['id']?>>
                <div class="modal-body">
                    <div class="form-group row">
                      <label for="new_ktp" class="col-sm-3 col-form-label">Foto KTP</label>
                      <div class="col-sm-9">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="change_ktp_file" name="change_ktp_file" accept=".jpg,.png,.jpeg">
                              <label class="custom-file-label" for="new_ktp" id='change_ktp_label'>Foto KTP</label>
                            </div>
                          </div>
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

          <!-- modal -->
      <div class="modal fade " id="modal-change-pas">
        <div class="modal-dialog modal-xl">
          <div class="modal-content text-sm">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Ganti Pas Foto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_change_pas'>
              <input type="hidden" id="change_id" value=<?=$data['id']?>>
                <div class="modal-body">
                    <div class="form-group row">
                      <label for="new_ktp" class="col-sm-3 col-form-label">Pas Foto</label>
                      <div class="col-sm-9">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="change_pas_file" name="change_pas_file" accept=".jpg,.png,.jpeg">
                              <label class="custom-file-label" for="change_pas_file" id='change_pas_label'>Pas Foto</label>
                            </div>
                          </div>
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

          <!-- modal -->
      <div class="modal fade " id="modal-change-sim">
        <div class="modal-dialog modal-xl">
          <div class="modal-content text-sm">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Ganti SIM</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_change_sim'>
              <input type="hidden" id="change_id" value=<?=$data['id']?>>
                <div class="modal-body">
                    <div class="form-group row">
                      <label for="new_sim" class="col-sm-3 col-form-label">SIM</label>
                      <div class="col-sm-9">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="change_sim_file" name="change_sim_file" accept=".jpg,.png,.jpeg">
                              <label class="custom-file-label" for="change_sim_file" id='change_sim_label'>SIM</label>
                            </div>
                          </div>
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

      <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="del_title">Hapus Calon TAD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_delete' action=''>
                <input type="hidden" id='delete_id' value="<?=$data['id']?>">
                <div class="modal-body">
                  <center><h3 id="delete_confirm">Hapus Calon TAD <?=$data['name']?> ?</h3></center>
                  <div class="form-group row">
                    <label for="new_education" class="col-sm-3 col-form-label">Alasan </label>
                    <div class="col-sm-9">
                      <input class="form-control" id="delete_reason"  name="delete_reason" placeholder="Alasan penghapusan" required>
                    </div>
                  </div>
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

      <input type="hidden" id="<?= csrf_token() ?>" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?=$this->include('footer');?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- Select2 -->
<script src="<?= base_url('/plugins/select2/js/select2.full.min.js')?>"></script>
<!-- jquery-validation -->
<script src="<?= base_url('/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?= base_url('/plugins/jquery-validation/additional-methods.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
<!-- Toastr -->
<script src="<?= base_url('plugins/toastr/toastr.min.js')?>"></script>
<?=$this->include('jquery_option');?>
<script type="text/javascript">
  $(function () {
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    $("#change_ktp_file").change(function (){
       var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
       //alert(fileName);
       $('#change_ktp_label').text(fileName);
    });
    $("#change_pas_file").change(function (){
       var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
       //alert(fileName);
       $('#change_pas_label').text(fileName);
    });
    $("#change_sim_file").change(function (){
       var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
       //alert(fileName);
       $('#change_sim_label').text(fileName);
    });
  });

  jQuery.validator.addMethod('fileSizeLimit', function(value, element, limit) {
      console.log(element.files[0].size);
      return !element.files[0] || (element.files[0].size <= limit);
  }, 'File is too big max 1 mb');

  function showModalEdit(){
    toastr.success('Memuat Data');
    var form_data = new FormData();
      form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      form_data.append('id',$('#edit_id').val());
      let url="<?=base_url('/candidate/data')?>";
      var request = $.ajax({
        method: "POST",
        contentType: false,
        processData: false,  // Important!
        async: false,
        cache: false,
        timeout: 30000,
        url: url,
        data: form_data,
        dataType: 'json',
      });
      request.done(function( reply ) {
        $('#<?=csrf_token()?>').val(reply['new_csrf']);
        if(reply['status'] == 1 ){
          $('#modal-edit').modal('show');
          $('#edit_id').val(reply.data.id);
          $('#edit_name').val(reply.data.name);
          $('#edit_phone').val(reply.data.phone);
          $('#edit_sim').val(reply.data.sim);
          $('#edit_position').val(reply.data.position);
          $('#edit_education').val(reply.data.education);
          $('#edit_note').val(reply.data.notes);
          $('#modal-edit').modal('show');
        }else{
          toastr.error('Gagal memuat data');
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        toastr.error( "Request failed: " + textStatus );
      });
  }

  $('#form_edit').validate({
    rules: {
      edit_name: {
        required: true,
      },
      edit_phone: {
        required: true,
        digits:true,
      },
      edit_position: {
        required: true,
      },
      edit_sim: {
        required: true,
      },
      edit_education: {
        required: true,
      },
      edit_note: {
        required: true,
      },
    },
    messages:{
      
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
    },
    submitHandler: function () {
      var form_data = new FormData();
      form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      form_data.append('id',$('#edit_id').val());
      form_data.append('name',$('#edit_name').val());
      form_data.append('phone',$('#edit_phone').val());
      form_data.append('position',$('#edit_position').val());
      form_data.append('sim',$('#edit_sim').val());
      form_data.append('education',$('#edit_education').val());
      form_data.append('note',$('#edit_note').val());
      let url="<?=base_url('/candidate/edit/submit')?>";
      var request = $.ajax({
        method: "POST",
        contentType: false,
        processData: false,  // Important!
        async: false,
        cache: false,
        timeout: 30000,
        url: url,
        data: form_data,
        dataType: 'json',
      });
      request.done(function( reply ) {
        $('#<?=csrf_token()?>').val(reply['new_csrf']);
        if(reply['status'] == 1 ){
          location.reload(true);
          $('#form_edit')[0].reset();
          $('#modal-edit').modal('hide');
        }else{
          toastr.error('Gagal menyimpan data');
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        toastr.error( "Request failed: " + textStatus );
      });
    }
  });

  $('#form_delete').validate({
    rules: {
      delete_id: {
        required: true,
      },
      delete_reason: {
        required: true,
      },
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
    submitHandler: function () {
      var form_data = new FormData();
      form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      form_data.append('id',$('#delete_id').val());
      form_data.append('reason',$('#delete_reason').val());
      let url="<?=base_url('/candidate/delete/submit')?>";
      var request = $.ajax({
        method: "POST",
        contentType: false,
        processData: false,  // Important!
        async: false,
        cache: false,
        timeout: 30000,
        url: url,
        data: form_data,
        dataType: 'json',
      });
      request.done(function( reply ) {
        $('#<?=csrf_token()?>').val(reply['new_csrf']);
        if(reply['status'] == 1 ){
          $('#form_delete')[0].reset();
          $('#modal-delete').modal('hide');
          window.location.href = "<?=base_url()?>/candidate";
        }else{
          toastr.error('Gagal menghapus data');
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        toastr.error( "Request failed: " + textStatus );
      });
    }
  });
  
  $('#form_change_ktp').validate({
    rules: {
      change_ktp_file: {
        required: true,
        accept: "image/*",
        fileSizeLimit: 1024000,
      },
    },
    messages:{
      
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
    },
    submitHandler: function () {
      var file_ktp = $('#change_ktp_file')[0].files;
      var form_data = new FormData();
      form_data.append('file_ktp',file_ktp[0]);
      form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      form_data.append('id',$('#change_id').val());
      let url="<?=base_url('/candidate/change_ktp/submit')?>";
      var request = $.ajax({
        method: "POST",
        contentType: false,
        processData: false,  // Important!
        async: false,
        cache: false,
        timeout: 30000,
        url: url,
        data: form_data,
        dataType: 'json',
      });
      request.done(function( reply ) {
        $('#<?=csrf_token()?>').val(reply['new_csrf']);
        if(reply['status'] == 1 ){
          toastr.success('Berhasil menyimpan gambar');
          $('#img_ktp').attr("src", "<?=base_url()?>"+reply.new_path);
          $('#modal-change-ktp').modal('hide');
        }else{
          toastr.error('Gagal menyimpan gambar');
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        toastr.error( "Request failed: " + textStatus );
      });
    }
  });

  $('#form_change_pas').validate({
    rules: {
      change_pas_file: {
        required: true,
        accept: "image/*",
        fileSizeLimit: 1024000,
      },
    },
    messages:{
      
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
    },
    submitHandler: function () {
      var file_pas = $('#change_pas_file')[0].files;
      var form_data = new FormData();
      form_data.append('file_pas',file_pas[0]);
      form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      form_data.append('id',$('#change_id').val());
      let url="<?=base_url('/candidate/change_pas_foto/submit')?>";
      var request = $.ajax({
        method: "POST",
        contentType: false,
        processData: false,  // Important!
        async: false,
        cache: false,
        timeout: 30000,
        url: url,
        data: form_data,
        dataType: 'json',
      });
      request.done(function( reply ) {
        $('#<?=csrf_token()?>').val(reply['new_csrf']);
        if(reply['status'] == 1 ){
          toastr.success('Berhasil menyimpan gambar');
          $('#img_pas').attr("src", "<?=base_url()?>"+reply.new_path);
          $('#modal-change-pas').modal('hide');
        }else{
          toastr.error('Gagal menyimpan gambar');
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        toastr.error( "Request failed: " + textStatus );
      });
    }
  });

  $('#form_change_sim').validate({
    rules: {
      change_sim_file: {
        required: true,
        accept: "image/*",
        fileSizeLimit: 1024000,
      },
    },
    messages:{
      
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
    },
    submitHandler: function () {
      var file_sim = $('#change_sim_file')[0].files;
      var form_data = new FormData();
      form_data.append('file_sim',file_sim[0]);
      form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      form_data.append('id',$('#change_id').val());
      let url="<?=base_url('/candidate/change_sim/submit')?>";
      var request = $.ajax({
        method: "POST",
        contentType: false,
        processData: false,  // Important!
        async: false,
        cache: false,
        timeout: 30000,
        url: url,
        data: form_data,
        dataType: 'json',
      });
      request.done(function( reply ) {
        $('#<?=csrf_token()?>').val(reply['new_csrf']);
        if(reply['status'] == 1 ){
          toastr.success('Berhasil menyimpan gambar');
          $('#img_sim').attr("src", "<?=base_url()?>"+reply.new_path);
          $('#modal-change-sim').modal('hide');
        }else{
          toastr.error('Gagal menyimpan gambar');
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        toastr.error( "Request failed: " + textStatus );
      });
    }
  });


</script>

</body>
</html>
