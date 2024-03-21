<?php


$relative_path = str_replace(base_url(), '', current_url());


?>



<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url() . "admin/dashboard" ?>" class="brand-link">
    <img src='<?= base_url() . "assets/dist/img/AdminLTELogo.png" ?>' alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">
      APS
    </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src='<?= base_url() . "assets/dist/img/user2-160x160.jpg" ?>' class="img-circle elevation-2" alt="User
        Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">

          <?php if (isset ($_SESSION['user'])): ?>

            <?= $_SESSION['user']['name'] ?>
          <?php endif; ?>
        </a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item <?= stripos(current_url(), "admin/dashboard") !== false ? "menu-open" : " " ?>">
          <a href=" <?= base_url() . "admin/dashboard" ?>"
            class="nav-link <?= stripos(current_url(), "admin/dashboard") !== false ? "active" : "" ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url() . "admin/dashboard" ?>"
                class="nav-link  <?= stripos(current_url(), "admin/dashboard") !== false ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard</p>
              </a>
            </li>

          </ul>
        </li>
        <li class="nav-item <?= stripos(current_url(), "admin/financial-years") !== false ? "menu-open" : "" ?>">
          <a href="<?= base_url() . "admin/financial-years/listing" ?>"
            class="nav-link    <?= stripos(current_url(), "admin/financial-years") !== false ? "active" : "" ?>">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Financial Year

            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url() . "admin/financial-years/listing" ?>"
                class="nav-link <?= stripos(current_url(), "admin/financial-years") !== false ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Financial Year</p>
              </a>
            </li>

          </ul>
        </li>

        <li
          class="nav-item <?= stripos(current_url(), "admin/albums") !== false || stripos(current_url(), "admin/gallery") !== false ? "menu-open" : "" ?>">
          <a href="<?= base_url() . "admin/albums/listing" ?>"
            class="nav-link <?= stripos(current_url(), "admin/albums") !== false || stripos(current_url(), "admin/gallery") !== false ? "active" : "" ?>">
            <i class="nav-icon fas fa-tree"></i>
            <p>
              Album
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview ">
            <li class="nav-item">
              <a href="<?= base_url() . "admin/albums/listing" ?>"
                class="nav-link <?= stripos(current_url(), "admin/albums") !== false ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Album</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url() . "admin/gallery/listing" ?>"
                class="nav-link <?= stripos(current_url(), "admin/gallery") !== false ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Album Gallery</p>
              </a>
            </li>

          </ul>
        </li>


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>