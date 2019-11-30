<?php
require_once('includes/functions.php');

if (!isset($_SESSION['uname'])) {
  $name = "Guest";
  $account = "Guest";
} else { }
?>
<?php include 'header.php'; ?>

<body cz-shortcut-listen="true">
  <!-- Main Content -->
  <div id="wrapper">

    <!-- Topbar -->
    <nav class="navbar-top topbar">
      <ul class="navbar navbar-user">
        <!-- Nav Item - Brand Logo -->
        <li class="nav-item brand">
          <a class="sidebar-logo" href="home.php"><img class="navbar-brand-img sidebar-logo" src="./images/logistix_navbar_logo.png" alt="Logistix Logo"></a>
          <a class="sidebar-logo-single" href="home.php"><img class="sidebar-logo-single" src="./images/logoNoText.png" alt="Logistix Logo"></a>
        </li>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="index.php">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            <span class="user-greetings">Exit</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- End of Topbar -->

    <div id="content-wrapper" class="d-flex">
      <!-- Sidebar -->
      <ul class="sidebar navbar" id="accordionSidebar">
        <!-- Divider -->
        <hr class="sidebar-divider sidebar-top">

        <!-- Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Menu
        </div>

        <!-- Nav Item 1 - Inventory Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-folder"></i>
            <span>Inventory</span>
          </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="sidebar-toggler">
          <button class="rounded-circle" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Page Content -->
      <div id="content" class="container-fluid" style="">
        <h1 class="">Guest Dashboard</h1>
        <div class="w3-container w3-row">
          <div class="w3-col  w3-third">
            <img src="images/defaultPic.jpg" class="w3-circle w3-margin-right" style="width:60px">
          </div>
          <div class="w3-col  w3-third">
            <span>Welcome, <strong>Guest</strong></span><br>
            <span>Today is: <strong><?php echo date("m-d-y"); ?></strong></span><br>
            <span>Access Level: <strong>Guest</strong></span><br>
          </div>
        </div>
        <div style="padding: 22px 0;">
          <?php showAllProduct(); ?>
        </div>

      </div>
      <!-- End of Page Content -->
    </div>
    <!-- End of Page Content Wrapper -->
  </div>
  <!-- End of Wrapper -->
  <?php include 'footer.php'; ?>