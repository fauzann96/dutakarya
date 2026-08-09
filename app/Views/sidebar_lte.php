
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
        <div class="image">
          <img src="<?= base_url('dist/img/user2-160x160.jpg')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= session()->get('username') ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item <?php if($active=='employee_data'&&$active_sub!=''){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if($active=='employee_data'){echo 'active';}?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Data Karyawan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/employee/data')?>" class="nav-link <?php if($active_sub=='active_employee'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Karyawan Aktif</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/employee/data/resigned')?>" class="nav-link <?php if($active_sub=='resigned_employee'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Karyawan Resign</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if($active=='job_application'&&$active_sub!=''){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if($active=='job_application'){echo 'active';}?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Lamaran Kerja
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/job_application/input')?>" class="nav-link <?php if($active_sub=='application_input'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Form Input Lamaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/job_application')?>" class="nav-link <?php if($active_sub=='active_application'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Lamaran</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if($active=='payslip'&&$active_sub!=''){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if($active=='payslip'){echo 'active';}?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Penggajian
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/payslip/input/start')?>" class="nav-link <?php if($active_sub=='payslip_input'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>From Input Slip Gaji</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/payslip/data')?>" class="nav-link <?php if($active_sub=='salary_data'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Slip Gaji</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if($active=='attendance'&&$active_sub!=''){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if($active=='attendance'){echo 'active';}?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Absensi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/attendance/input/start')?>" class="nav-link <?php if($active_sub=='attendance_input'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>From Input Absensi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/attendance/data')?>" class="nav-link <?php if($active_sub=='attendance_data'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Absensi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/assignment/backup')?>" class="nav-link <?php if($active_sub=='attendance_backup'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penugasan Backup</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if($active=='report'&&$active_sub!=''){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if($active=='report'){echo 'active';}?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/job_application')?>" class="nav-link <?php if($active_sub=='attendance_report'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Absensi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/job_application/accepted')?>" class="nav-link <?php if($active_sub=='worker_report'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/job_application/accepted')?>" class="nav-link <?php if($active_sub=='worker_report'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Unit Kerja</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if($active=='import'&&$active_sub!=''){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if($active=='import'){echo 'active';}?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Import
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/import/employee')?>" class="nav-link <?php if($active_sub=='import_employee'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Import Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/import/job_application')?>" class="nav-link <?php if($active_sub=='import_attendance'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Import Lamaran</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if($active=='working_unit'&&$active_sub!=''){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if($active=='working_unit'){echo 'active';}?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Unit Kerja
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/working_unit/data')?>" class="nav-link <?php if($active_sub=='working_unit_data'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Unit Kerja</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/area/data')?>" class="nav-link <?php if($active_sub=='working_unit_area'){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Area Unit Kerja</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('/fc_manager')?>" class="nav-link <?php if($active_sub=='fc_manager'){echo 'active';}?>">
              <i class="nav-icon far fa-image"></i>
              <p>
                Manajer Korlap
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="<?= base_url('/calendar_manager')?>" class="nav-link <?php if($active_sub=='calendar_manager'){echo 'active';}?>">
              <i class="nav-icon far fa-image"></i>
              <p>
                Manajer Kalender
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="<?= base_url('/user_manager')?>" class="nav-link <?php if($active_sub=='user_manager'){echo 'active';}?>">
              <i class="nav-icon far fa-image"></i>
              <p>
                Manajer Pengguna
              </p>
            </a>
          </li>       
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
