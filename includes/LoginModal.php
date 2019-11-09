<!DOCTYPE html>
<html>
<title>LogisTix</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./css/modalstyle.css">

<body>
<style>
    button{
        background-color: #246EB5 !important;
    }
    /* Extra styles for the cancel button */
    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: orangered !important;
    }
    img.avatar {
        width: 40%;
        border-radius: 0%;
}
        /* The Modal (background) */
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 50% !important;  /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding: 60px;
    color: #3a3a3a!important;
}
</style>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
       
        <a href="#about" onclick="document.getElementById('id01').style.display='block'" class="w3-bar-item w3-button ">Login |</button></a><a href="./guestAuth.php" class="w3-bar-item w3-button"><b>Continue as Guest</button></b></a>
<div class="w3-container">
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        
<form action="./authcheck.php" method="post">
  <div class="imgcontainer">
      <img src="./images/logistixlogotrue.png" alt="Avatar" class="avatar">
  </div>

  <div class="w3-container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    
    <button type="submit">Login</button></style>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>

  </div>
</form>
</div>
      </div>
    </div>
  </div>
</div>

    </div>
            
</body>
</html>