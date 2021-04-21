<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?php echo BASE_URL . '/assets/images/logo-3-128x128.png' ?>" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-bold">EHome</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo BASE_URL . '/node_modules/admin-lte/dist/img/user2-160x160.jpg' ?>"
          class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION['username'] ?></a>
      </div>
    </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="/admin/index.php"
            class="nav-link  <?php echo ($_SERVER['REQUEST_URI'] === '/admin/index.php') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/products/index.php"
            class="nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/admin/products/index.php') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-dolly-flatbed"></i>
            <p>
              Manage Products
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/categories/subcategories/index.php"
            class="nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/admin/categories/subcategories/index.php') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-th-large"></i>
            <p>
              Manage Sub-Categories
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/categories/index.php"
            class="nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/admin/categories/index.php') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Manage Categories
            </p>
          </a>
        </li>
        <li class="nav-item border-top border-light mt-4 py-3">
          <a href="/admin/logout.php" class="nav-link">
            <i class="nav-icon fas fa-power-off text-danger"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="app">