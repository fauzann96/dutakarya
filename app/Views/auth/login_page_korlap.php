<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=session()->get('company_name')?> | <?=session()->get('title')?></title>
  <link rel="icon" type="image/x-icon" href="<?= base_url('upload/system/logo_dks.jpg')?>">


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/dist/css/adminlte.min.css')?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-danger">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>PT</b> DKS</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Masuk untuk memulai</p>

      <form action="<?= base_url('korlap/login/submit')?>" method="post">
        <div class="input-group mb-3">
          <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
          <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" value="<?= old('nip') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="<?= old('password') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="visible" onclick="setVisible()">
              <label for="visible">
                Tampilkan password
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i> Masuk</button>
          </div>
          <div class="col-12 col-sm-12 mt-1">
            <a href="<?=base_url('login')?>"><button type="button" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Akses Admin</button></a>
          </div>
          <!-- /.col -->
        </div>
        
      </form>
    <!--<p class="mb-1">
        <a href="<?= base_url('forgot_password')?>">Lupa password</a>
      </p>
    </div>-->
    <!-- /.card-body -->
    <div class="card-footer" <?php if(session()->getFlashdata('msg') == null){echo 'hidden';}?>>
      <?php if(session()->getFlashdata('msg')){ ?>
        <div class="alert alert-danger alert-dismissible">
          <h5><i class="icon fas fa-ban"></i> Alert!</h5><?=session()->getFlashdata('msg')?>
        </div>
        <?php } ?>
    </div>
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
<script>
  function setVisible() {
  var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  } 
</script>
</body>
</html>
