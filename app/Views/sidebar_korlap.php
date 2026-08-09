
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url('upload/system/logo_dks.jpg')?>" alt="CompanyLogo" class="brand-image  elevation-3" style="opacity: 1">
      <span class="brand-text font-weight-light">PT DKS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?= session()->get('name') ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item <?php if(session()->get('active')=='employee'&&session()->get('active_sub')!=''){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if(session()->get('active')=='employee'){echo 'active';}?>">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Data TAD
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('korlap/employee')?>" class="nav-link <?php if(session()->get('active_sub')=='employee_active'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>TAD Aktif</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if(session()->get('active')=='attendance'&&session()->get('active_sub')!=''){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if(session()->get('active')=='attendance'){echo 'active';}?>">
              <i class="nav-icon fas fa-user-check"></i>
              <p>
                Absensi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('korlap/attendance/input')?>" class="nav-link <?php if(session()->get('active_sub')=='attendance_input'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Input Absensi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('korlap/attendance/data')?>" class="nav-link <?php if(session()->get('active_sub')=='attendance_data'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Absensi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('korlap/assignment/backup')?>" class="nav-link <?php if(session()->get('active_sub')=='attendance_backup'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penugasan Backup</p>
                </a>
              </li>
            </ul>
          </li>      
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
