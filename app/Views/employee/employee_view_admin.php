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
    <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')?>">
         <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('/plugins/toastr/toastr.min.css')?>">
    <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/dist/css/adminlte.min.css')?>">
  <style type="text/css">
    p{
      margin-bottom: 0;
    }
  </style>
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
            <h1><?=session()->get('title');?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data TAD</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-3">

            <!-- Profile Image -->
            <div class="card <?php if($employee['resign_date'] != null){echo 'card-danger';} else{echo 'card-primary';}?> card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img id="img_pas" src="<?=base_url().$employee['foto_pas_path'].$employee['foto_pas']?>" alt="pas foto" class="img-thumbnail" style="opacity: 1;width:80%"><br>
                  <button class="btn btn-sm" onclick="$('#modal-change-pas').modal('show');"><i class="far fa-edit"></i> Ganti Pas Foto</button>
                </div>
                
                <h3 id="name" class="profile-username text-center"><?=$employee['name']?></h3>

                <ul class="list-group list-group-unbordered mb-3  text-center">

                  <li class="list-group-item">
                    <strong >NIP</strong>
                    <p id="nip_text" class="text-muted">
                      <?= $employee['nip'] ?: '-'?>
                    </p>
                  </li>
                  <li class="list-group-item">
                    <strong >Jabatan</strong>
                    <p id="position_text" class="text-muted">
                      <?= $employee['position'] ?: '-'?>
                    </p>
                  </li>
                  <li class="list-group-item">
                    <strong>Customer</strong>
                    <p id="customer_name_text" class="text-muted">
                      <?= $employee['customer_name'] ?: '-'?>
                    </p>
                  </li>
                  <li class="list-group-item">
                    <strong>Lokasi</strong>
                    <p id="customer_location_text" class="text-muted">
                       <?= $employee['customer_location_name'] ?: '-'?>
                    </p>
                  </li>
                  <li class="list-group-item">
                    <strong>Tanggal Bergabung</strong>
                    <p id="join_date" class="text-muted">
                      <?= $employee['join_date'] ?: '-'?>
                    </p>
                  </li>
                  <li class="list-group-item">
                    <strong>SPK</strong>
                    <p id="spk_text" class="text-muted">
                      <?= $employee['spk'] ?: '-'?>
                    </p>
                  </li>
                  <li class="list-group-item">
                    <strong>PKWT</strong>
                    <p id="pkwt_text" class="text-muted">
                      <?= $employee['pkwt'] ?: '-'?>
                    </p>
                  </li>
                  <?php if($employee['resign_date'] != null) {?>
                  <li class="list-group-item">
                    <strong>Tanggal Resign</strong>
                    <p id="join_date" class="text-muted">
                      <?= $employee['resign_date'] ?: '-'?>
                    </p>
                  </li>
                <?php }?>

                </ul>
                <?php if($employee['resign_date'] == null){ ?>
                <button class="btn btn-info btn-block" onclick="showSpkPkwtModal()"><b>Update SPK,PKWT</b></button>
                <button class="btn btn-warning btn-block" onclick="showMutationModal()"><b>Mutasi</b></button>
                <button class="btn btn-danger btn-block" onclick="showResignModal()"><b>Resign</b></button>
                
              <?php }?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->   
          </div>

          <!-- /.col -->
          <div class="col-12 col-sm-9">
            <div class="row">
              <div class="col-12 col-sm-6">
                <div class="card <?php if($employee['resign_date'] != null){echo 'card-danger';} else{echo 'card-primary';}?>">
                  <div class="card-header">
                    <h3 class="card-title">Data Pekerjaan</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-primary btn-sm" title="Edit Info" onclick="showEditJobModal()">
                        <i class="fas fa-edit"></i> Edit
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="text-center">
                      <img id="img_sim" src="<?=base_url().$employee['foto_sim_path'].$employee['foto_sim']?>" alt="pas foto" class="img-thumbnail" style="opacity: 1;width:80%"><br>
                      <button class="btn btn-sm" onclick="$('#modal-change-sim').modal('show');"><i class="far fa-edit"></i> Ganti Foto SIM</button>
                    </div>
                    <strong><i class="fas fa-credit-card mr-1"></i> SIM</strong>
                    <p id="txt_sim" class="text-muted">
                      <?= $employee['sim'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-pencil-alt mr-1"></i> Pendidikan Terakhir</strong>
                    <p id="txt_education" class="text-muted">
                      <?=$employee['last_education'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-money-bill-wave-alt mr-1"></i> Rekening</strong>
                    <p id="txt_bank_account" class="text-muted">
                      <?= $employee['no_rekening'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-hospital mr-1"></i> BPJS Kesehatan</strong>
                    <p id="txt_bpjs_kes" class="text-muted">
                      <?= $employee['bpjs_kes'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-user-shield mr-1"></i> BPJS Ketenagakerjaan</strong>
                    <p id="txt_bpjs_tk" class="text-muted">
                    <?= $employee['bpjs_tk'] ?: '-'?>   
                    </p>
                    <hr>
                    <strong><i class="far fa-money-bill-alt mr-1"></i> NPWP</strong>
                    <p id="txt_npwp" class="text-muted">
                      <?= $employee['npwp'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-home mr-1"></i> Alamat Tinggal</strong>
                    <p id="txt_address" class="text-muted">
                        <?=$employee['address'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-phone mr-1"></i> Nomor Telepon</strong>
                    <p id="txt_phone" class="text-muted">
                      <?= $employee['phone'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-inbox mr-1"></i> Email</strong>
                    <p id="txt_email" class="text-muted">
                      <?= $employee['email'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-phone mr-1"></i> Emergency</strong>
                    <p id="txt_emergency" class="text-muted">
                      <?= $employee['emergency_contact'] ?: '-'?>
                    </p>
                    <hr>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="card <?php if($employee['resign_date'] != null){echo 'card-danger';} else{echo 'card-primary';}?>">
                  <div class="card-header">
                    <h3 class="card-title">Data Pribadi</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-primary btn-sm" title="Edit Info" onclick="showEditPrivateModal()">
                        <i class="fas fa-edit"></i> Edit
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="text-center">
                      <img id="img_ktp" src="<?=base_url().$employee['foto_ktp_path'].$employee['foto_ktp']?>" alt="pas foto" class="img-thumbnail" style="opacity: 1;width:80%"><br>
                      <button class="btn btn-sm" onclick="$('#modal-change-ktp').modal('show');"><i class="far fa-edit"></i> Ganti Foto KTP</button>
                    </div>
                    <strong><i class="fas fa-book mr-1"></i> NIK</strong>
                    <p id="txt_nik" class="text-muted">
                      <?= $employee['nik'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Jenis Kelamin</strong>
                    <p id="txt_gender" class="text-muted">
                      <?= $employee['gender_name'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Tempat & Tanggal Lahir</strong>
                    <p id="txt_ttl" class="text-muted">
                      <?= $employee['birth_place'] ?: '-'?>, <?= $employee['birth_date'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-user mr-1"></i> Nama Ibu Kandung</strong>
                    <p id="txt_mother_name" class="text-muted">
                      <?= $employee['mother_name'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-user-friends mr-1"></i> Status Pernikahan </strong>
                    <p id="txt_marrital_status" class="text-muted">
                      <?= $employee['marrital_status'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-user-friends mr-1"></i> Nama Istri/Suami</strong>
                    <p id="txt_spouse_name" class="text-muted">
                      <?= $employee['spouse_name'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-briefcase mr-1"></i> Pekerjaan Istri/Suami</strong>
                    <p id="txt_spouse_job" class="text-muted">
                      <?= $employee['spouse_job'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-briefcase mr-1"></i> Anak 1</strong>
                    <p id="txt_child_1" class="text-muted">
                      <?= $employee['child_1_name'] ?: '-'?>, <?= $employee['child_1_ttl'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-briefcase mr-1"></i> Anak 2</strong>
                    <p id="txt_child_2" class="text-muted">
                      <?= $employee['child_2_name'] ?: '-'?>, <?= $employee['child_2_ttl'] ?: '-'?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-briefcase mr-1"></i> Anak 3</strong>
                    <p id="txt_child_3" class="text-muted">
                      <?= $employee['child_3_name'] ?: '-'?>, <?= $employee['child_3_ttl'] ?: '-'?>
                    </p>
                    <hr>
                  </div>
                </div>
              </div>
              
            </div>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

      <!-- modal -->
      <div class="modal fade " id="modal-mutation">
        <div class="modal-dialog">
          <div class="modal-content text-sm">
            <div class="modal-header bg-warning">
              <h4 class="modal-title">Mutasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='mutation_form' action=''>
                <input type="hidden" id='user_id' value="">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="mut_wu" class="col-sm-3 col-form-label">Customer</label>
                    <div class="col-sm-9">
                      <select class="form-control select2bs4" id='mut_customer' name='mut_customer' required></select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="mut_div" class="col-sm-3 col-form-label">Lokasi</label>
                    <div class="col-sm-9">
                      <select class="form-control select2bs4" id='mut_customer_location' name='mut_customer_location' required></select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="mut_position" class="col-sm-3 col-form-label" required>Jabatan</label>
                    <div class="col-sm-9">
                      <input class="form-control" id='mut_position' name='mut_position'>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="mut_note" class="col-sm-3 col-form-label">Catatan</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id='mut_note' name='mut_note'></textarea>
                    </div>
                  </div>
                    <input type="hidden" id="csrf" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
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

      <!-- modal -->
      <div class="modal fade " id="modal-update-spk-pkwt">
        <div class="modal-dialog">
          <div class="modal-content text-sm">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Update SPK & PKWT</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='update_spk_form' action=''>
                <input type="hidden" id='user_id' value="">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="spk_new" class="col-sm-3 col-form-label">SPK</label>
                    <div class="col-sm-9">
                      <input class="form-control" id='spk_new' name='spk_new' required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pkwt_new" class="col-sm-3 col-form-label">PKWT</label>
                    <div class="col-sm-9">
                      <input class="form-control" id='pkwt_new' name='pkwt_new' required>
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

      <!-- modal -->
      <div class="modal fade" id="modal-resign">
        <div class="modal-dialog">
          <div class="modal-content text-sm">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Resign</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='resign_form' action=''>
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="resign_reason" class="col-sm-3 col-form-label">Catatan</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id='resign_reason' name='resign_reason' required></textarea>
                    </div>
                  </div>
                    <input type="hidden" id="csrf" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash()?>" />
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-danger">RESIGN</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- modal -->
      <div class="modal fade" id="modal-edit-job-data">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Edit Data Pekerjaan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='edit_job_data_form' action=''>
                <div class="modal-body row">
                  <div class="col-12 col-sm-12">
                    <div class="form-group row">
                      <label for="edt_sim" class="col-sm-3 col-form-label">SIM</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edt_sim' name='edt_sim' required></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edt_education" class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edt_education' name='edt_education' required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edt_bank_number" class="col-sm-3 col-form-label">Rekening Bank</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edt_bank_number' name='edt_bank_number'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edt_bpjs_kes" class="col-sm-3 col-form-label">BPJS Kesehatan</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edt_bpjs_kes' name='edt_bpjs_kes'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edt_bpjs_tk" class="col-sm-3 col-form-label">BPJS Ketenagakerjaan</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edt_bpjs_tk' name='edt_bpjs_tk'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edt_npwp" class="col-sm-3 col-form-label">NPWP</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edt_npwp' name='edt_npwp'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edt_address" class="col-sm-3 col-form-label">Alamat</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" id='edt_address' name='edt_address' required></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edt_phone" class="col-sm-3 col-form-label">Telepon</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edt_phone' name='edt_phone'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edt_email" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edt_email' name='edt_email'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edt_emergency" class="col-sm-3 col-form-label">Emergency</label>
                      <div class="col-sm-9">
                        <input class="form-control" id="edt_emergency" name="edt_emergency">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

       <!-- modal -->
      <div class="modal fade" id="modal-edit-private-data">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Edit Data Pribadi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='edit_private_data_form' action=''>
                <div class="modal-body row">
                  <div class="col-12 col-sm-12">
                    <div class="form-group row">
                      <label for="edt_nik" class="col-sm-3 col-form-label">NIK</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edt_nik' name='edt_nik' required></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edt_gender" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                      <div class="col-sm-9">
                        <select class="form-control" id='edt_gender' name='edt_gender' required></select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edt_ttl" class="col-sm-3 col-form-label">Tempat,Tgl Lahir</label>
                      <div class="col-sm-9">
                        <div class="row">
                          <div class="col-sm-4"><input class="form-control" type='text' id='edt_birth_place' name='edt_birth_place' required></div>
                          <div class="col-sm-8"><input class="form-control" type='date' id='edt_birth_date' name='edt_birth_date' required></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edt_mother_name" class="col-sm-3 col-form-label">Nama Ibu Kandung</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edt_mother_name' name='edt_mother_name' required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edt_marrital_status" class="col-sm-3 col-form-label">Status Pernikahan</label>
                      <div class="col-sm-9">
                        <select class="form-control" id='edt_marrital_status' name='edt_marrital_status' required></select>
                      </div>
                    </div>
                    <div id="div_spouse_name" class="form-group row">
                      <label for="edt_spouse_name" class="col-sm-3 col-form-label">Nama Istri/Suami</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edt_spouse_name' name='edt_spouse_name' required>
                      </div>
                    </div>
                    <div id="div_spouse_job" class="form-group row">
                      <label for="edt_spouse_job" class="col-sm-3 col-form-label">Pekerjaan Istri/Suami</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edt_spouse_job' name='edt_spouse_job' required>
                      </div>
                    </div>
                    <div id="div_child_name_1" class="form-group row">
                      <label for="edt_child_name_1" class="col-sm-3 col-form-label">Nama Anak 1</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="edt_child_name_1" name="edt_child_name_1" placeholder="Nama anak pertama">
                      </div>
                    </div>
                    <div id="div_child_ttl_1" class="form-group row">
                      <label for="edt_child_ttl_1" class="col-sm-3 col-form-label">Ttl Anak 1</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" id="edt_child_ttl_1" name="edt_child_ttl_1" placeholder="Tempat tgl lahir anak pertama">
                      </div>
                    </div>
                    <div id="div_child_name_2" class="form-group row">
                      <label for="edt_child_name_2" class="col-sm-3 col-form-label">Nama Anak 2</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="edt_child_name_2" name="edt_child_name_2" placeholder="Nama anak kedua">
                      </div>
                    </div>
                    <div id="div_child_ttl_2" class="form-group row">
                      <label for="edt_child_ttl_2" class="col-sm-3 col-form-label">Ttl Anak 2</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" id="edt_child_ttl_2" name="edt_child_ttl_2" placeholder="Tempat tgl lahir anak kedua">
                      </div>
                    </div>
                    <div id="div_child_name_3" class="form-group row">
                      <label for="edt_child_name_3" class="col-sm-3 col-form-label">Nama Anak 3</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="edt_child_name_3" name="edt_child_name_3" placeholder="Nama anak ketiga">
                      </div>
                    </div>
                    <div id="div_child_ttl_3" class="form-group row">
                      <label for="edt_child_ttl_3" class="col-sm-3 col-form-label">Ttl Anak 3</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" id="edt_child_ttl_3" name="edt_child_ttl_3" placeholder="Tempat tgl lahir anak ketiga">
                      </div>
                    </div> 
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
             <!-- modal -->

                 <!-- modal -->
      <div class="modal fade " id="modal-change-ktp">
        <div class="modal-dialog modal-md">
          <div class="modal-content text-sm">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Ganti Gambar KTP</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_change_ktp'>
              <input type="hidden" id="change_id" value=<?=$employee['id']?>>
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
        <div class="modal-dialog modal-md">
          <div class="modal-content text-sm">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Ganti Pas Foto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_change_pas'>
              <input type="hidden" id="change_id" value=<?=$employee['id']?>>
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
        <div class="modal-dialog modal-md">
          <div class="modal-content text-sm">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Ganti SIM</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_change_sim'>
              <input type="hidden" id="change_id" value=<?=$employee['id']?>>
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

    </section>
    <!-- /.content -->
    <input type="hidden" id="<?= csrf_token() ?>" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
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
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
<!-- jquery-validation -->
<script src="<?= base_url('/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?= base_url('/plugins/jquery-validation/additional-methods.min.js')?>"></script>
<script src="<?= base_url('/plugins/select2/js/select2.full.min.js')?>"></script>
<!-- Toastr -->
<script src="<?= base_url('plugins/toastr/toastr.min.js')?>"></script>

<?=$this->include('option/gender_option');?>
<?=$this->include('option/customer_option');?>
<?=$this->include('option/candidate_option');?>
<?=$this->include('option/customer_location_option');?>
<?=$this->include('option/marrital_status_option');?>
<?=$this->include('option/position_option');?>
<script type="text/javascript">
  var employee;
  var table;
  $(function () {
    employee=<?=json_encode($employee)?>;
     //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    jQuery.validator.addMethod('fileSizeLimit', function(value, element, limit) {
        console.log(element.files[0].size);
        return !element.files[0] || (element.files[0].size <= limit);
    }, 'File is too big max 1 mb');
  });

  function showEditPrivateModal(){
    toastr.info('Memuat Data');
    loadGenderOption($('#edt_gender'));
    loadMarritalOption($('#edt_marrital_status'))
    var request = $.ajax({
      method: "POST",
      async: false,
      cache: false,
      timeout: 30000,
      url: "<?=base_url('/employee/data')?>",
      data: {
        '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
        id : <?=$employee['id']?>,
        data_type : 2,//job
      },
    });
    request.done(function( reply ) {
      $('#<?=csrf_token()?>').val(reply['new_csrf']);
      if(reply['status'] == 1 ){
        $('#edt_nik').val(reply.data['nik']);
        $('#edt_gender').val(reply.data['gender_seq']);
        $('#edt_birth_place').val(reply.data['birth_place']);
        $('#edt_birth_date').val(reply.data['birth_date']);
        $('#edt_mother_name').val(reply.data['mother_name']);
        $('#edt_marrital_status').val(reply.data['marrital_status_seq']);
        $('#edt_spouse_name').val(reply.data['spouse_name']);
        $('#edt_spouse_job').val(reply.data['spouse_job']);
        $('#edt_child_name_1').val(reply.data['child_1_name']);
        $('#edt_child_ttl_1').val(reply.data['child_1_ttl']);
        $('#edt_child_name_2').val(reply.data['child_2_name']);
        $('#edt_child_ttl_2').val(reply.data['child_2_ttl']);
        $('#edt_child_name_2').val(reply.data['child_3_name']);
        $('#edt_child_ttl_2').val(reply.data['child_3_ttl']);

        $('#modal-edit-private-data').modal('show');
      }else{
        toastr.error('Gagal memuat data');
      }
    });
    request.fail(function( jqXHR, textStatus ) {
      toastr.error( "Request failed: " + textStatus );
    });
  };

  $("#edt_marrital_status").change(function (){
    console.log('changer');
    if($("#edt_marrital_status").val() == 1){
      $('#div_spouse_name').fadeOut();
      $("#edt_spouse_name").prop('required',false);
      $('#div_spouse_job').fadeOut();
      $("#edt_spouse_job").prop('required',false);
      $('#div_child_name_1').fadeOut();
      $("#edt_child_name_1").prop('required',false);
      $('#div_child_ttl_1').fadeOut();
      $("#edt_child_ttl_1").prop('required',false);
      $('#div_child_name_2').fadeOut();
      $("#edt_child_name_3").prop('required',false);
      $('#div_child_ttl_2').fadeOut();
      $("#edt_child_ttl_2").prop('required',false);
      $('#div_child_name_3').fadeOut();
      $("#edt_child_name_3").prop('required',false);
      $('#div_child_ttl_3').fadeOut();
      $("#edt_child_ttl_2").prop('required',false);
    }else if($("#edt_marrital_status").val() == 2){
      $('#div_spouse_name').fadeIn();
      $("#edt_spouse_name").prop('required',true);
      $('#div_spouse_job').fadeIn();
      $("#edt_spouse_job").prop('required',true);
      $('#div_child_name_1').fadeOut();
      $("#edt_child_name_1").prop('required',false);
      $('#div_child_ttl_1').fadeOut();
      $("#edt_child_ttl_1").prop('required',false);
      $('#div_child_name_2').fadeOut();
      $("#edt_child_name_3").prop('required',false);
      $('#div_child_ttl_2').fadeOut();
      $("#edt_child_ttl_2").prop('required',false);
      $('#div_child_name_3').fadeOut();
      $("#edt_child_name_3").prop('required',false);
      $('#div_child_ttl_3').fadeOut();
      $("#edt_child_ttl_2").prop('required',false);
    }else if($("#edt_marrital_status").val() == 3){
      $('#div_spouse_name').fadeIn();
      $("#edt_spouse_name").prop('required',true);
      $('#div_spouse_job').fadeIn();
      $("#edt_spouse_job").prop('required',true);
      $('#div_child_name_1').fadeIn();
      $("#edt_child_name_1").prop('required',true);
      $('#div_child_ttl_1').fadeIn();
      $("#edt_child_ttl_1").prop('required',true);
      $('#div_child_name_2').fadeOut();
      $("#edt_child_name_3").prop('required',false);
      $('#div_child_ttl_2').fadeOut();
      $("#edt_child_ttl_2").prop('required',false);
      $('#div_child_name_3').fadeOut();
      $("#edt_child_name_3").prop('required',false);
      $('#div_child_ttl_3').fadeOut();
      $("#edt_child_ttl_2").prop('required',false);
    }else if($("#edt_marrital_status").val() == 4){
      $('#div_spouse_name').fadeIn();
      $("#edt_spouse_name").prop('required',true);
      $('#div_spouse_job').fadeIn();
      $("#edt_spouse_job").prop('required',true);
      $('#div_child_name_1').fadeIn();
      $("#edt_child_name_1").prop('required',true);
      $('#div_child_ttl_1').fadeIn();
      $("#edt_child_ttl_1").prop('required',true);
      $('#div_child_name_2').fadeIn();
      $("#edt_child_name_3").prop('required',true);
      $('#div_child_ttl_2').fadeIn();
      $("#edt_child_ttl_2").prop('required',true);
      $('#div_child_name_3').fadeOut();
      $("#edt_child_name_3").prop('required',false);
      $('#div_child_ttl_3').fadeOut();
      $("#edt_child_ttl_2").prop('required',false);
    }else if($("#edt_marrital_status").val() == 5){
      $('#div_spouse_name').fadeIn();
      $("#edt_spouse_name").prop('required',true);
      $('#div_spouse_job').fadeIn();
      $("#edt_spouse_job").prop('required',true);
      $('#div_child_name_1').fadeIn();
      $("#edt_child_name_1").prop('required',true);
      $('#div_child_ttl_1').fadeIn();
      $("#edt_child_ttl_1").prop('required',true);
      $('#div_child_name_2').fadeIn();
      $("#edt_child_name_3").prop('required',true);
      $('#div_child_ttl_2').fadeIn();
      $("#edt_child_ttl_2").prop('required',true);
      $('#div_child_name_3').fadeIn();
      $("#edt_child_name_3").prop('required',true);
      $('#div_child_ttl_3').fadeIn();
      $("#edt_child_ttl_2").prop('required',true);
    }
  });

  $('#edit_private_data_form').validate({
      rules: {
        edt_nik: {
          required: true,
          maxlength : 50,
        },
        edt_gender: {
          required: true,
        },
        edt_mother_name: {
          required: true,
        },
        edt_marrital_status: {
          required :true,
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
          toastr.info('Menyimpan perubahan');
          var csrfName = '<?=csrf_token()?>';
          let url="<?=base_url('/employee/edit/submit')?>";
          var request = $.ajax({
          method: "POST",
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: {
            '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
            id : <?=$employee['id']?>,
            data_type : 2,//private
            nik:$('#edt_nik').val(),
            gender:$('#edt_gender').val(),
            birth_place:$('#edt_birth_place').val(),
            birth_date:$('#edt_birth_date').val(),
            mother_name:$('#edt_mother_name').val(),
            marrital_status:$('#edt_marrital_status').val(),
            spouse_name:$('#edt_spouse_name').val(),
            spouse_job:$('#edt_spouse_job').val(),
            child_1_name:$('#edt_child_name_1').val(),
            child_1_ttl:$('#edt_child_ttl_1').val(),
            child_2_name:$('#edt_child_name_2').val(),
            child_2_ttl:$('#edt_child_ttl_2').val(),
            child_3_name:$('#edt_child_name_3').val(),
            child_3_ttl:$('#edt_child_ttl_3').val(),
          },
        });
          request.done(function( reply ) {
            if(reply['status'] == 1 ){
              toastr.success('Perubahan berhasil disimpan');
              $('#txt_nik').text(reply.data['nik']);
              $('#txt_gender').text(reply.data['gender_name']);
              $('#txt_ttl').text(reply.data['birth_place']+', '+reply.data['birth_date']);
              $('#txt_mother_name').text(reply.data['mother_name']);
              $('#txt_marrital_status').text(reply.data['marrital_status_name']);
              $('#txt_spouse_name').text(reply.data['spouse_name']);
              $('#txt_spouse_job').text(reply.data['spouse_job']);
              $('#txt_child_1').text(reply.data['child_1_name']+', '+reply.data['child_1_ttl']);
              $('#txt_child_2').text(reply.data['child_2_name']+', '+reply.data['child_2_ttl']);
              $('#txt_child_3').text(reply.data['child_3_name']+', '+reply.data['child_3_ttl']);
              $('#edit_private_data_form')[0].reset();
              $('#modal-edit-private-data').modal('hide');
            }else{
              toastr.error('gagal disimpan');
            }
          });
          request.fail(function( jqXHR, textStatus ) {
            toastr.error( "Request failed: " + textStatus );
          });
      }
  });

  function showEditJobModal(){
    toastr.info('Memuat Data');
    var request = $.ajax({
      method: "POST",
      async: false,
      cache: false,
      timeout: 30000,
      url: "<?=base_url('/employee/data')?>",
      data: {
        '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
        id : <?=$employee['id']?>,
        data_type : 1,//job
      },
    });
    request.done(function( reply ) {
      $('#<?=csrf_token()?>').val(reply['new_csrf']);
      if(reply['status'] == 1 ){
        $('#edt_sim').val(reply.data['sim']);
        $('#edt_education').val(reply.data['last_education']);
        $('#edt_bank_number').val(reply.data['no_rekening']);
        $('#edt_bpjs_kes').val(reply.data['bpjs_kes']);
        $('#edt_bpjs_tk').val(reply.data['bpjs_tk']);
        $('#edt_npwp').val(reply.data['npwp']);
        $('#edt_phone').val(reply.data['phone']);
        $('#edt_address').text(reply.data['address']);
        $('#edt_email').val(reply.data['email']);
        $('#edt_emergency').val(reply.data['emergency_contact']);
        $('#modal-edit-job-data').modal('show');
      }else{
        toastr.error('mutasi tidak disimpan');
      }
    });
    request.fail(function( jqXHR, textStatus ) {
      toastr.error( "Request failed: " + textStatus );
    });
  };

  $('#edit_job_data_form').validate({
      rules: {
        edt_sim: {
          required: true,
          maxlength : 50,
        },
        edt_education: {
          required: true,
          maxlength : 50,
        },
        edt_bank_number: {
          required: true,
          maxlength : 50,
        },
        edt_bpjs_kes: {
          required: true,
          digits: true,
        },
        edt_bpjs_tk: {
          required :true,
          digits:true,
        },
        edt_address: {
          required :true,
          maxlength:255,
        },
        edt_phone: {
          required: true,
          digits:true,
        },
        edt_email: {
          required: true,
          email : true,
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
          toastr.info('perubahan berhasil disimpan');
          var csrfName = '<?=csrf_token()?>';
          let url="<?=base_url('/employee/edit/submit')?>";
          var request = $.ajax({
          method: "POST",
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: {
            [<?=csrf_token()?>] : $('#<?=csrf_token()?>').val(),
            id : <?=$employee['id']?>,
            data_type : 1,//job
            sim:$('#edt_sim').val(),
            education:$('#edt_education').val(),
            bank_number:$('#edt_bank_number').val(),
            bpjs_kes:$('#edt_bpjs_kes').val(),
            bpjs_tk:$('#edt_bpjs_tk').val(),
            npwp:$('#edt_npwp').val(),
            address:$('#edt_address').val(),
            phone:$('#edt_phone').val(),
            email:$('#edt_email').val(),
            emergency:$('#edt_emergency').val(),
          },
        });
          request.done(function( reply ) {
            if(reply['status'] == 1 ){
              var update = reply['new_update'];
              toastr.success('perubahan berhasil disimpan');
              $('#txt_sim').text(reply.data['sim']);
              $('#txt_education').text(reply.data['last_education']);
              $('#txt_bank_account').text(reply.data['no_rekening']);
              $('#txt_bpjs_kes').text(reply.data['bpjs_kes']); 
              $('#txt_bpjs_tk').text(reply.data['bpjs_tk']);
              $('#txt_npwp').text(reply.data['npwp']);
              $('#txt_address').text(reply.data['address']);
              $('#txt_phone').text(reply.data['phone']);
              $('#txt_email').text(reply.data['email']);
              $('#txt_emergency').text(reply.data['emergency_contact']);
              $('#edit_job_data_form')[0].reset();
              $('#modal-edit-job-data').modal('hide');
            }else{
              toastr.error('gagal disimpan');
            }
          });
          request.fail(function( jqXHR, textStatus ) {
            toastr.error( "Request failed: " + textStatus );
          });
      }
  });

  function showResignModal(){
    $('#modal-resign').modal('show');
  }
  $('#resign_form').validate({
      rules: {
        resign_reason: {
          required: true,
        },
      },
      messages: {
        resign_reason:{
          required: "Harap isi alasan resign",
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
      submitHandler:function(event){
          var csrfName = '<?=csrf_token()?>';
          let url="<?=base_url('/employee/resign/submit')?>";
          var request = $.ajax({
          method: "POST",
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: {
            [csrfName] : '<?=csrf_hash()?>',
            emp_id : <?=$employee['id']?>,
            reason : $('#resign_reason').val(),
          },
        });
          request.done(function( reply ) {
            $('#<?=csrf_token()?>').val(reply['new_csrf']);
            if(reply['status'] == 1 ){
              //$('#spk').text(reply['spk']);
              //$('#modal-update-spk').modal('hide');
              toastr.success('TAD berhasil diupdate');
              window.location = "<?= base_url('/employee/resigned')?>";
            }else{
              toastr.error('Resign tidak disimpan');
            }
          });
          request.fail(function( jqXHR, textStatus ) {
            toastr.error( "Request failed: " + textStatus );
          });
      }
  });

  function showSpkPkwtModal() {
    toastr.info('Mendapatkan data...');
    var request = $.ajax({
      method: "POST",
      async: false,
      cache: false,
      timeout: 30000,
      url: "<?=base_url('/employee/data')?>",
      data: {
        [<?=csrf_token()?>] : $('#<?=csrf_token()?>').val(),
        id : <?=$employee['id']?>,
        data_type : 3,
      },
    });
    request.done(function( reply ) {
      $('#<?=csrf_token()?>').val(reply['new_csrf']);
      if(reply['status'] == 1 ){
        toastr.success('Berhasil mendapatkan data');
        $('#spk_new').val(reply.data['spk']);
        $('#pkwt_new').val(reply.data['pkwt']);
        $('#modal-update-spk-pkwt').modal('show');
      }else{
        toastr.error('Gagal mendapatkan data');
      }
    });
    request.fail(function( jqXHR, textStatus ) {
      toastr.error( "Request failed: " + textStatus );
    });
    
    // body...
  }
  $('#update_spk_form').validate({
      rules: {
        spk_new: {
          required: true,
        },
        pkwt_new: {
          required: true,
        },
      },
      messages: {
        spk_new:{
          required: "Harap isi SPK",
        },
        pkwt_new: {
          required: "Harap isi PKWT",
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
      submitHandler:function(event){
        toastr.info('Menyimpan perubahan');
        let url="<?=base_url('/employee/spk_update/submit')?>";
          var request = $.ajax({
          method: "POST",
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: {
            [<?=csrf_token()?>] : $('#<?=csrf_token()?>').val(),
            emp_id : <?=$employee['id']?>,
            spk : $('#spk_new').val(),
            pkwt : $('#pkwt_new').val(),
          },
        });
          request.done(function( reply ) {
            $('#<?=csrf_token()?>').val(reply['new_csrf']);
            if(reply['status'] == 1 ){
              toastr.success('Perubanan berhasil disimpan');
              $('#spk_text').text(reply['spk']);
              $('#pkwt_text').text(reply['pkwt']);
              $('#update_spk_form')[0].reset();
              $('#modal-update-spk-pkwt').modal('hide');
            }else{
              toastr.error('Gagal menyimpan perubahan');
            }
          });
          request.fail(function( jqXHR, textStatus ) {
            toastr.error( "Request failed: " + textStatus );
          });
      }
  });

  function showMutationModal(){
    loadCustomerOption($('#mut_customer'));
    $('#modal-mutation').modal('show');
  }
  $('#mut_customer').on('change',function(){
    loadCustomerLocationOption($('#mut_customer_location'),$('#mut_customer').val());
  })
  $('#mutation_form').validate({
      rules: {
        mut_customer: {
          required: true,
        },
        mut_customer_location: {
          required: true,
        },
        mut_position: {
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
          var request = $.ajax({
            method: "POST",
            async: false,
            cache: false,
            timeout: 30000,
            url: "<?=base_url('/employee/mutation/submit')?>",
            data: {
              [<?=csrf_token()?>] : $('#<?=csrf_token()?>').val(),
              id : <?=$employee['id']?>,
              customer : $('#mut_customer').val(),
              customer_location : $('#mut_customer_location').val(),
              position : $('#mut_position').val(),
              note : $('#mut_note').val(),
            },
          });
          request.done(function( reply ) {
            $('#<?=csrf_token()?>').val(reply['new_csrf']);
            if(reply['status'] == 1 ){
              toastr.success('Mutasi berhasil disimpan');
              $('#customer_location_text').text(reply.updates['customer_location_name'])
              $('#customer_text').text(reply.updates['customer_name'])
              $('#position_text').text(reply.updates['position'])
              $('#mutation_form')[0].reset();
              $('#modal-mutation').modal('hide');
            }else{
              toastr.error('Mutasi gagal disimpan');
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
      let url="<?=base_url('/employee/change_ktp/submit')?>";
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
      let url="<?=base_url('/employee/change_pas_foto/submit')?>";
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
      let url="<?=base_url('/employee/change_sim/submit')?>";
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
