<?php
require_once('includes/functions.php');

if(!isset($_SESSION['uname'])){
    
$name = "Guest";
$account = "Guest";
}
else {
}
?>
<!DOCTYPE html>
<html>
<title>LogisTix</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="includes/style.css">
<link rel="stylesheet" href="css/style.css">
<link rel="icon" href="images/LogistixFavicon.ico" type="image/x-icon">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card"><div class ="logistixOrange">
          <a href="#home" class="w3-bar-item w3-button">
              <b>LogisTix</div> <div class="logistixBlue"></b>Inventory</div></a>
          
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
        <span><a href="logout.php" class="w3-bar-item w3-button">Exit</a></span>
    </div>  
  </div>   
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
        <img src="images/defaultPic.jpg" class="w3-circle w3-margin-right" style="width:60px">       
    </div>
      <div class="">         
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong><?php echo $name;?></strong></span><br>
      <span>Today is: <strong><?php echo date("m-d-y");?></strong></span><br> 
      <span>Access Level: <strong>Guest</strong></span><br>    
    </div>
  </div>  
  <div class="w3-container">
    <h5>Guest Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="inventory.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Inventory</a>
<br>
  </div>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay">
</div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>

  <div class="w3-container">
      <h5>List of Inventory &nbsp&nbsp</h5> 

    <!--This starts inventory list-->
<?php    showAllProduct(); ?>
  <!-- end of inventory list-->  

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>UMGC | CMSC 495</h4>
    <p>Team 1 - LogisTix Inventory Management System 2019</p>
  </footer>
  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>
</body>
</html>
