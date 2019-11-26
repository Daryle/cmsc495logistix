<?php	       
// Needed For SQLFunctions getFaculty call
require_once('includes/functions.php');
require_once('changeProfilePic.php');
	            
if(isset($_POST["submit"]) && $_SESSION['uname']== $_POST['uname']) {    	       
    updatePassword();	
    echo "<script>window.open('home.php','_self')</script>";     
} 