<!DOCTYPE html>
<html>
<title>LogisTix</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./css/modalstyle.css">

<body>

    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
       
        <a href="#about" onclick="document.getElementById('id01').style.display='block'" class="w3-bar-item w3-button ">Login |</button></a><a href="./guestpage.php" class="w3-bar-item w3-button"><b>Continue as Guest</button></b></a>
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
    </label><br><br>

</form>
</div>
      </div>
    </div>
  </div>
</div>

    </div>
            
</body>
</html>