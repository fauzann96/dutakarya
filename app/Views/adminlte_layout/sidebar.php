
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
          <?php 
            foreach($sidebar_items as $item){
                if($item['type'] == 'nav-header'){
                    echo '<li class="nav-header">'.$item['text'].'</li>';
                }else if($item['type'] == 'nav-item'){
                    $active = '';
                    if(session()->get('active') == $item['text']){
                        $active = 'active';
                    }
                    echo '<li class="nav-item '.(count($item['child'])>0?'has-treeview':'').' '.(session()->get('active')==$item['text']?'menu-open':'').'">';
                    echo '<a href="'.$item['link'].'" class="nav-link '.$active.'">';
                    echo '<i class="nav-icon '.$item['nav-icon'].'"></i>';
                    echo '<p>'.$item['text'];
                    if(count($item['child'])>0){
                        echo '<i class="right fas fa-angle-left"></i>';
                    }
                    echo '</p>';
                    echo '</a>';
                    if(count($item['child'])>0){
                        echo '<ul class="nav nav-treeview">';
                        foreach($item['child'] as $child){
                            $active_child = '';
                            if(session()->get('active_sub') == $child['text']){
                                $active_child = 'active';
                            }
                            echo '<li class="nav-item">';
                            echo '<a href="'.$child['link'].'" class="nav-link '.$active_child.'">';
                            echo '<i class="far fa-circle nav-icon"></i>';
                            echo '<p>'.$child['text'].'</p>';
                            echo '</a>';
                            echo '</li>';
                        }
                        echo '</ul>';
                    }
                    echo '</li>';
                }
            }
          ?>
          <li class="nav-header">PENGATURAN LAYOUT</li>
          <li class="nav-item"> 
            <div class="form-group">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="auto_sidebar" <?php if(session()->get('auto_sidebar') == 1){echo 'checked';}?>>
                <label class="custom-control-label text-light" for="auto_sidebar">Auto Collapse Sidebar</label>
              </div>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<?= $this->section('page_script') ?>
<script>
  $('#auto_sidebar').change(function(){
      var auto_sidebar = $(this).is(':checked') ? 1 : 0;
      if (auto_sidebar == 1) {
      console.log('Sidebar Auto Collapse: ON');
          $('body').addClass('sidebar-collapse');
      } else {
          console.log('Sidebar Auto Collapse: OFF');
          $('body').removeClass('sidebar-collapse');
      }
      $.ajax({
          url: '<?= base_url('layout/setSidebar')?>',
          type: 'POST',
          data: {auto_sidebar: auto_sidebar},
          success: function(response){
              console.log(response);
              
          }
      });
  });
</script>
<?= $this->endSection() ?>

