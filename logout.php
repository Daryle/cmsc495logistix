<?php
    session_start();

    session_destroy();
?>
<!DOCTYPE html>
<html>
<title>LogisTix Inventory</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, min-width=800, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/modalstyle.css">
<link rel="icon" href="images/LogistixFavicon.ico" type="image/x-icon">
<body>

    <div class="w3-container logisTixContainerAlpha">
    <div class= "w3-container w3-center logisTixBorderLineDGray">
        <img class= "w3-center" src="images/logistixlogotrue.png" width="50%"><br>
        <?php echo 'You have logged out';?>
   </div></div>
        <?php header('Refresh: 2; URL = index.php');?>
</body>
</html>