<!doctype html>
<html lang="en">
  <?= view_cell('App\Views\adminlte_layout\ViewCell::LoadHead') ?> 
    <body class="hold-transition sidebar-mini  layout-fixed <?= session()->get('auto_sidebar') == 1 ? 'sidebar-collapse' : 'sidebar-open' ?>">
    <div class="wrapper">
      <?= view_cell('App\Views\adminlte_layout\ViewCell::LoadPreloader') ?> 
      <?= view_cell('App\Views\adminlte_layout\ViewCell::LoadNavbar') ?> 
      <?= view_cell('App\Views\adminlte_layout\ViewCell::LoadSidebar') ?> 
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <?= view_cell('App\Views\adminlte_layout\ViewCell::LoadContentHeader') ?> 
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <?= $this->renderSection('page_content') ?>
          </div><!-- /.container-fluid -->
          </section>
      </div>
      <?= view_cell('App\Views\adminlte_layout\ViewCell::LoadFooter') ?> 
    </div>
    <?= view_cell('App\Views\adminlte_layout\ViewCell::LoadScript') ?> 
    <?= $this->renderSection('page_script') ?>

  </body>
</html>
