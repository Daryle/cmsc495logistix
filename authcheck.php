
<?php
    // Needed For SQLFunctions to find users
	require_once('./includes/functions.php');
	
	$mysqli = connectdb();	
	// Retrieve Post Data
    if(isset($_POST["uname"])){
	   $username = mysqli_real_escape_string($mysqli, $_POST["uname"]);	
	   $password = mysqli_real_escape_string($mysqli, $_POST["psw"]);	
         
	// Authenticate User
    verifylogin($username, $password);
         }else{
             echo "<script>window.open('index.php','_self')</script>";
         }
?>   
<html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>User Authenticate</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/modalstyle.css">
    </head>
    <body>
    <div class="container-reg">   
    </body>
</html>