<?php
require_once('includes/functions.php');
require_once('process.php');

if (!isAdmin()) {
  echo "<script>window.open('index.php','_self')</script>";
}
if (!isset($_SESSION['uname'])) {
  echo "<script>window.open('index.php','_self')</script>";
} else { }
initAdmin();
idleKick();
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
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="user-greetings">Good Day,</span>
            <span class="user-name"><?php echo $_SESSION['uname']; ?></span>
            <img class="user-topbar-img" src="<?php showProfilePic(); ?>" alt="">
          </a>
          <!-- Dropdown Menu -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Last sign on :<br>
              <?php echo $_SESSION['dateTime']; ?>
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Access level :
              <?php displayAccessLevel(); ?>
            </a>
            <hr style="margin: .25rem 1.5rem;">
            <a class="dropdown-item" href="updateProfile.php">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="changePassword.php">
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
      <?php displaySidebar(); ?>
      <!-- End of Sidebar -->

      <!-- Page Content -->
      <div id="content" class="container-fluid" style="">
        <h1 class="">Add new account</h1>
        <div class="w3-container w3-row">
          <div class="w3-col s4">
              <img src="<?php echo showProfilePic(); ?>" class="w3-circle w3-margin-right" style="width:60px">
          </div>
          <div class="w3-col s8 w3-bar">
            <span>Welcome, <strong><?php echo $_SESSION['uname']; ?></strong></span><br>
            <span>Today is: <strong><?php echo date("m-d-y"); ?></strong></span><br>
            <span>Access Level: <strong><?php displayAccessLevel(); ?></strong></span><br>
          </div>
        </div>

        <div style="padding: 22px 0;">
          <form class="modal-content animate" name="register" method="POST" action="register.php">
            <label for="fname"><b>First Name</b></label><br>
            <input class="w3-input" type="text" placeholder="Enter First Name" name="fname" required>
            <br>
            <label for="lname"><b>Last Name</b></label><br>
            <input class="w3-input" type="text" placeholder="Enter Last Name" name="lname" required>
            <br>
            <label for="cpword"><b>Username</b></label><br>
            <input class="w3-input" type="text" placeholder="Username" name="uname" required>
            <br>
            <label for="email"><b>Email</b></label><br>
            <input class="w3-input" type="text" placeholder="Enter Email" name="email" required>
            <br>
            <label for="pword"><b>Password</b></label><br>
            <input class="w3-input" type="password" placeholder="Enter Password" name="pword" required>
            <!-- <label for="cpword"><b>Confirm Password</b></label>
            <input type="password" placeholder="Confirm Password" name="cpword" required>-->
            <br><br>
            <button class="w3-button logistixBlueBack" type="submit" name="submit">Register</button><br><br>
            <!-- <label>
              <input type="checkbox" checked="checked" name="remember"> Remember me
            </label><br> -->
            <!-- <div class="w3-container" style="background-color:#f1f1f1">
              <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
            </div> -->
          </form>
        </div>

      </div>
      <!-- End of Page Content -->
    </div>
    <!-- End of Page Content Wrapper -->
  </div>
  <!-- End of Wrapper -->
  <?php include 'footer.php'; ?>