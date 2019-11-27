<?php
require_once('includes/functions.php');
require_once('process.php');

if (!isset($_SESSION['uname'])) {
  echo "<script>window.open('index.php','_self')</script>";
} else { }
initAdmin();
?>
<?php include 'header.php'; ?>

<body id="page-top" cz-shortcut-listen="true" class="">
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
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="user-greetings">Good Day,</span>
            <span class="user-name"><?php echo $_SESSION['uname']; ?></span>
            <img class="user-topbar-img" src="<?php showProfilePic(); ?>" alt="">
          </a>
          <!-- Dropdown Menu -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Settings
            </a>
            <a class="dropdown-item" href="logout.php">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- End of Topbar -->
    <!-- Page Content Wrapper-->
    <div id="content-wrapper" class="d-flex">

      <!-- Sidebar -->
      <?php displaySidebar(); ?>
      <!-- End of Sidebar -->

      <!-- Page Content -->
      <div id="content" class="container-fluid" style="">
        <h1 class="">Profile</h1>
        <div class="w3-container w3-row">
          <div class="w3-col s4">
            <img src="images/ironman2.jpg" class="w3-circle w3-margin-right" style="width:60px">
          </div>
          <div class="w3-col s8 w3-bar">
            <span>Welcome, <strong><?php echo $_SESSION['uname']; ?></strong></span><br>
            <span>Today is: <strong><?php echo date("m-d-y"); ?></strong></span><br>
            <span>Access Level: <strong><?php displayAccessLevel(); ?></strong></span><br>
          </div>
        </div>

        <!-- Update Profile Picture -->
        <div style="padding: 22px 0;">
          <h5><b><i class="fa fa-cog"></i> Update Profile Picture</b></h5>
          <div class="w3-third">
            <h5><?php echo $name; ?></h5>
            <img src="<?php echo showProfilePic(); ?>"  style="object-fit: cover" width="200px" height="200px" alt="Profile Pic">
          </div>
          <div class="w3-twothird">
            <div class="row justify-content-center">
              <form method="POST" action="process.php" enctype="multipart/form-data">
                <div class="container">
                  <div class="form-group">
                    <br><label for="image"><b>Image</b></label><br>
                    <input type="file" name="image">
                  </div>
                  <br>
                  <div class="form-group">
                    <button type="submit" name="updatepic" class="w3-button logistixBlueBack">Update</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End of Change Profile Picture -->

        </div>
        <!-- End of Page Content -->
      </div>
      <!-- End of Page Content Wrapper -->
    </div>
    <!-- End of Main Content -->
    <?php include 'footer.php'; ?>