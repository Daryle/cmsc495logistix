<?php
// Needed For SQLFunctions to find users
require_once('./includes/functions.php');
session_start();
session_destroy();
?>
<!-- <?php header('Refresh: 2; URL = index.php'); ?> -->
<?php include 'header.php'; ?>
<body style="min-height:100vh;">
    <div class="w3-container logisTixContainerAlpha">
        <div class="w3-container w3-center logisTixBorderLineDGray">
            <img class="w3-center" src="images/logistixlogotrue.png" width="50%"><br>
            <?php echo 'You have logged out'; ?>
        </div>
    </div>
</body>
</html>