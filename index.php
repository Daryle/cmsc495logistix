<?php include 'header.php'; ?>

<body id="page-top" cz-shortcut-listen="true">
  <!-- Navbar (sit on top) -->
  <div class="w3-top">
    <div class="w3-bar w3-white w3-wide w3-padding w3-card">
      <a href="index.php" class=""><img class="navbar-brand-img" src="/images/logistix_navbar_logo.png" alt="Logistix Inventory Text Logo"></a>
      <!-- Float links to the right. Hide them on small screens -->
      <div class="w3-right w3-hide-small ">
        <!-- TODO: if-else for login / logout -->
        <a onclick="document.getElementById('id01').style.display='block'" class="w3-bar-item w3-button ">Login</a>
        <!-- TODO: if-else for Continue as guest / None -->
        <a href="./guestpage.php" class="w3-bar-item w3-button">Continue as Guest</a>
      </div>
    </div>
    <?php include('includes/LoginModal.php'); ?>
  </div>

  <!-- Header -->
  <header class="w3-display-container w3-content w3-wide" style="max-width:2000px;" id="home">
    <img class="w3-image" src="images/6648.jpg" alt="Architecture" width="2000" height="800">
    <div class="w3-display-middle w3-margin-top w3-center">
      <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding logistixOrangeBack w3-opacity-min">
          <b>LogisTix</b></span> <span class="w3-hide-small logistixBlue">
          Inventory</span></h1>
    </div>
  </header>

  <!-- Page content -->
  <div class="w3-content w3-padding" style="max-width:1564px">

    <!-- Project Section -->
    <div class="w3-container w3-padding-32" id="projects">
      <h3 class="w3-border-bottom logistixOrange w3-padding-16">New Items</h3>
    </div>
    <?php indexShowProducts(); ?>
  </div>

  <!-- About Section -->
  <div class="w3-container w3-padding-32" id="about">
    <h3 class="w3-border-bottom logistixOrange w3-padding-16">About Team LogisTix</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
      occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
      laboris nisi ut aliquip ex ea commodo consequat.
    </p>
  </div>

  <div class="w3-row-padding w3-grayscale">
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="images/capAmerica2.jpg" alt="John" style="width:100%">
      <h3>Brandon Elliott</h3>
      <p class="w3-opacity">Project Manager</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-blue w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="images/capMarvel2.jpg" alt="Jane" style="width:100%">
      <h3>Jella An</h3>
      <p class="w3-opacity">Full Stack Developer</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-blue w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="images/thor2.jpg" alt="Mike" style="width:100%">
      <h3>Tom Cress</h3>
      <p class="w3-opacity">Lead Tester</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-blue w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="images/ironman2.jpg" alt="Dan" style="width:100%">
      <h3>Daryle Urrea</h3>
      <p class="w3-opacity">Lead Developer</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-blue w3-block">Contact</button></p>
    </div>
  </div>

  <!-- Contact Section -->
  <div class="w3-container w3-padding-32" id="contact">
    <h3 class="w3-border-bottom logistixOrange w3-padding-16">Contact</h3>
    <p>Let's get in touch and talk about your item of interest.</p>

    <form action="mailer.php" method="post">

      <input class="w3-input w3-border" type="text" placeholder="Name" required name="Name">
      <input class="w3-input w3-section w3-border" type="text" placeholder="Email" required name="email">
      <input class="w3-input w3-section w3-border" type="text" placeholder="Subject" required name="subject">
      <input class="w3-input w3-section w3-border" type="text" placeholder="Comment" required name="comment">
      <button class="w3-button logistixBlueBack w3-section" type="submit" name="submit">
        <i class="fa fa-paper-plane"></i> SEND MESSAGE
      </button>
    </form>
  </div>

  <!-- Image of location/map -->
  <div class="w3-container">
    <div class="w3-center">
      <img src="images/logistixlogoTrue.png" class="w3-image" style="width:15%">
    </div>
  </div>

  <!-- End page content -->
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>