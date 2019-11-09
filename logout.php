<!DOCTYPE html>
<html>
<title>LogisTix Inventory</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, min-width=800, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<body>

<?php
   
    session_start();

    session_destroy();?>
    <div class="w3-container logisTixContainerAlpha">
    <div class= "w3-container w3-center logisTixBorderLineDGray">
    
        <?php echo 'You have logged out';?>
   </div></div>
        <?php header('Refresh: 2; URL = index.php');?>
</body>
</html>