
<html>
    <title>Change Password</title>
	<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
</head>
<body>       
<?php	       
    // Needed For SQLFunctions getFaculty call
    require_once('includes/functions.php');
    require_once('changeProfilePic.php');

	            
        if(isset($_POST["submit"]) && $_SESSION['uname']== $_POST['uname']) {    	 
        
            updatePassword();	
            echo "<script>window.open('home.php','_self')</script>";
//            header('Refresh: 1; URL = home.php');
            
	}
       
 ?>
    </div>
</body>
</html>

