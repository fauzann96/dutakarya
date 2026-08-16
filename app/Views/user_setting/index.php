<!--pick layout-->
<?= $this->extend('adminlte_layout/main') ?>

<?= $this->section('page_content') ?>

<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Profil Pengguna</h3>
                <div class="card-tools">
                <button type="button" class="btn bg-warning btn-sm" onclick="showModalEdit()">
                  <i class="fas fa-pencil-alt"></i> Ubah
                </button>
                <button type="button" class="btn bg-danger btn-sm" onclick="showModalPassword()">
                  <i class="fas fa-key"></i> Ganti Password
                </button>
              </div>
              </div>
              
              <div class="card-body">
                  <h3 class="profile-username" id="text-name"><?=$user['name']?></h3>
                  <p class="text-muted" id="text-username"><?=$user['username']?></p>
              </div>
              <div class="card-footer">
              </div>
            </div>
            <?= $this->include('user_setting/signature') ?>
          </div>
        </div>

<?= $this->endSection() ?>

<?= $this->section('page_modal') ?>

<?= $this->include('user_setting/change_password') ?>
<?= $this->include('user_setting/edit_profile') ?>

<?= $this->endSection() ?>

<?= $this->section('on_document_ready_script') ?>
    <!-- loadTableData();  contoh -->
<?= $this->endSection() ?>

<?= $this->section('page_script') ?>

<?= $this->endSection() ?>
