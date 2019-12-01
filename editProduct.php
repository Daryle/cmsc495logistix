<?php
require_once('includes/functions.php');
require_once('process.php');

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
            <img class="user-topbar-img" src="<?php showProfilePic();  ?>" alt="">
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
        <h1 class="">Edit Product</h1>
        <div class="w3-container w3-row">
          <div class="w3-col  w3-third">
            <img src="<?php echo showProfilePic(); ?>" class="w3-circle w3-margin-right" style="width:60px">
          </div>
          <div class="w3-col  w3-third">
            <span>Welcome, <strong><?php echo $_SESSION['uname']; ?></strong></span><br>
            <span>Today is: <strong><?php echo date("m-d-y"); ?></strong></span><br>
            <span>Access Level: <strong><?php displayAccessLevel(); ?></strong></span><br>
          </div>
          <div class="w3-col  w3-third">
            <span>Out of Stock: <strong><?php echo outOfStock(); ?></strong></span><br>
            <span>Total Stocks: <strong><?php echo totalStocks(); ?></strong></span><br>
            <span>Total Manufacturers: <strong><?php echo totalManufacturer(); ?></strong></span><br>
          </div>
        </div>
        <!--image and inventory-->

        <div class="w3-panel">
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-third">
              <h5><?php echo $name; ?></h5>
              <img src="<?php echo $image; ?>" style="width:100%" alt="Image">
            </div>
            <div class="w3-twothird">
              <h5>Edit Product</h5>
              <div class="row justify-content-center">


                <form method="POST" action="process.php" enctype="multipart/form-data">
                  <div class="container">

                    <input type="hidden" value="<?php echo $id; ?>" name="id">
                    <div class="form-group">
                      <label for="name"><b>Name</b></label>
                      <input class="w3-input" type="text" placeholder="Product Name" value="<?php echo $name; ?>" name="name" required>
                    </div>
                    <br>
                    <div class="form-group">
                      <label for="lastname"><b>Manufacturer</b></label>
                      <input class="w3-input" value="<?php echo $manu; ?>" type="text" placeholder="lastname" name="manufacturer" required>
                    </div>
                    <br>
                    <div class="form-group">
                      <label for="username"><b>Description</b></label>
                      <input class="w3-input" type="text" placeholder="username" value="<?php echo $desc; ?>" name="desc" required>
                    </div>
                    <br>
                    <div class="form-group">
                      <label for="quantity"><b>Quantity</b></label><br>
                      <input type="number" value="<?php echo $qty; ?>" name="qty" class="w3-input-number" min=0 max=100 required>
                    </div>

                    <div class="form-group">
                      <br><label for="image"><b>Image</b></label><br>
                      <input type="file" name="image">
                    </div>
                    <br>
                    <div class="form-group">
                      <?php if ($update == true) :?>
                        <button type="submit" name="update" class="w3-button logistixBlueBack">Update</button>
                      <?php else : ?>
                        <button type="submit" name="save">Update<style margin="8px !important"></style></button>
                      <?php endif; ?>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- End of Page Content -->
    </div>
    <!-- End of Page Content Wrapper -->
  </div>
  <!-- End of Wrapper -->
  <?php include 'footer.php'; ?>