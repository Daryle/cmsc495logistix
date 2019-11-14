<?php

// Include the required DBConnection information
require_once('Includes/Dbconnect.php');

//include the userclass
require_once('Includes/FormObjects.php');

//function of verification if user login is correct
function verifylogin($username, $password)
{
    $mysqli = connectdb();
    $sql = "SELECT * from users WHERE userName='$username'";
    $result = $mysqli->query($sql);

    if ($result->num_rows === 1)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $authcheck = password_verify($password, $row['passWord']);        
        if ($authcheck){
       
        // session_start();
        
        $_SESSION['uname'] = $username;
        
        echo "<script>window.open('home.php','_self')</script>";
        
        }else{
            echo "<br>";
            echo "Invalid entry<br><br>";
            header('Refresh: 1; URL = index.php');
            }
    }else{
        echo "<br>";
        echo "invalid entry";
        echo "<br>";
        header('Refresh: 1; URL = index.php');
     }
}

//update password function
function updatePassword ()
{
    // Connect to the database
    $mysqli = connectdb();
    $username = $_POST['uname'];
    //$username=$_SESSION['uname'];
    $initAccess = "1";
    //$password =  $user->getPassword();
    $password = password_hash($_POST["pword"],PASSWORD_DEFAULT);

    $mysqli->query("UPDATE users SET passWord = '$password', initAccess= '$initAccess' WHERE userName='$username'")
    or die($mysqli->error());
}

function countUser ($user)
{        
    // Connect to the database
    $mysqli = connectdb();

    $username = $user-> getUsername();
    // Define the Query
    // For Windows MYSQL String is case insensitive
    $Myquery = "SELECT count(*) as count from users where userName='$username'";

    if ($result = $mysqli->query($Myquery)) 
        {
            /* Fetch the results of the query */         
            while( $row = $result->fetch_assoc() )
            {
                $count=$row["count"];                                             
            }    
            /* Destroy the result set and free the memory used for it */
            $result->close();         
        }   
            $mysqli->close();   
            return $count;          
}

function createUser ($user)
  {
   // Connect to the database
   $mysqli = connectdb();
   $date = date('Y-m-d H:i:s');
   $access = 0;
   $failLog = 0;
   $initAccess = 1;
   $firstname = $user->getFirstname();
   $lastname = $user->getLastname();
   $username = $user-> getUsername();
   $email = $user->getEmail();
   //$password =  $user->getPassword();
   $password = password_hash($_POST["pword"],PASSWORD_DEFAULT);		
    // Add Prepared Statement
    $Query = "INSERT INTO users 
	     (firstName, lastName,userName,email,passWord,dateTime, access,failLog,initAccess) 
              VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($Query);				
    $stmt->bind_param("sssssssss", $firstname, $lastname, $username, $email, $password,$date,$access,$failLog,$initAccess);
    $stmt->execute();		
    $stmt->close();
    $mysqli->close();            	
    return true;
    }

function updateProfilePic(){
    $mysqli = connectdb();
    $username=$_POST['uname'];
       
    $image='images/' .$_FILES['image']['name'];
    $image= mysqli_real_escape_string($mysqli, $image);
    
    if(preg_match("!image!", $_FILES['image']['type'])){
       if(copy($_FILES['image']['tmp_name'], $image)){

    $mysqli->query("UPDATE users SET image = '$image' WHERE userName='$username'") or die($mysqli->error);


    header("location: home.php");
}}}


function initAdmin(){
    $mysqli = connectdb();
    $initAdmin ="";
    $access = "";
    $user= $_SESSION['uname'];
    $sql = "SELECT initAccess, access from users WHERE userName='$user'";
    $result = $mysqli->query($sql);
         
    if ($result->num_rows===1)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);

        $initAdmin = $row['initAccess'];
        $access = $row['access'];
        
  if ($access == 1){
       
      if($initAdmin == 0){
          
            echo "<script>window.open('changePassword.php','_self')</script>";
    }}}        
}



function isAdminMember(){
    $mysqli = connectdb();
    $access = "";
    $user=$_SESSION['uname'];
    $sql = "SELECT initAccess, access from users WHERE userName='$user'";
    $result = $mysqli->query($sql);
         
    if ($result->num_rows===1)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $access = $row['access'];
        
        if ($access == 1){
            echo "Admin";
       
        }  if($access == 0){
            echo "Member";
        } if($access == 3){
            echo "Guest";
        }
    }  
}

function isAdminSide(){
    $mysqli = connectdb();
    $access = "";
    $user=$_SESSION['uname'];
    $sql = "SELECT initAccess, access from users WHERE userName='$user'";
    $result = $mysqli->query($sql);
         
    if ($result->num_rows===1)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $access = $row['access'];
        
        if ($access == 1){
            isAdminSideDisplay();
       
        }  if($access == 0){
            isMemberSideDisplay();
            
        } 
    }  
}

function isAdminSideDisplay(){
    ?>
    <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="#" class="w3-bar-item w3-button w3-padding logistixBlueBack"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="inventory.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Inventory</a>
    <a href="addStaff.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Add Staff</a>
    <a href="changePassword.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>Change Password</a><br><br>
  </div>
  <?php
}

function isMemberSideDisplay(){
    ?>
    <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="#" class="w3-bar-item w3-button w3-padding logistixBlueBack"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="changePassword.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>Change Password</a><br><br>
  </div>
  <?php
}

//End user management



//Start product management

//will insert product table and manufacturers table


function indexShowProducts(){
    $mysqli = connectdb();
    $sql = "SELECT *, Timestamp(dateup) from products ORDER BY dateup DESC limit 4";
    $result = $mysqli->query($sql);
      
    if ($result->num_rows===1)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
  }
  ?><br><div class="w3-row-padding"><?php
            /* Fetch the results of the query */       
            while( $row = $result->fetch_assoc() )
            {
                $image = $row["PImage"];
                $name = $row["PName"];
   ?>
  
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft logistixBlueBack w3-padding"><?php echo $name; ?></div>
        <img src="<?php echo $image;?>" alt="<?php echo $name;?>" style="width:100%"></div></div><?php
}}

?>
