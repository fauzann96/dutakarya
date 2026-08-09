
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
          <li class="nav-item">
            <a href="<?= base_url('/user_manager')?>" class="nav-link <?php if(session()->get('active_sub')=='user_manager'){echo 'active';}?>">
              <i class="nav-icon fas fa-users"></i></i>
              <p>
                User Manager
              </p>
            </a>
          </li> 
          <!--
          <li class="nav-item">
            <a href="<?= base_url('/system_setting')?>" class="nav-link <?php if(session()->get('active') == 'System_setting'){echo 'active';}?>">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Pengaturan Sistem
              </p>
            </a>
          </li>    -->
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
