<link rel="stylesheet" href="./css/modalstyle.css">

<div id="id01" class="w3-modal">
  <div class="w3-modal-content">
      <form action="./authcheck.php" method="post">
        <a onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">X</a>
        <div class="imgcontainer">
          <img src="./images/logistixlogotrue.png" alt="Avatar" class="avatar">
        </div>
        <div class="w3-container">
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="uname" required>
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" required>
          <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
          </label>
          <button type="submit">LOGIN</button>
        </div>
      </form>
  </div>
</div>
