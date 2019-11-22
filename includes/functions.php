<?php
require_once('includes/Dbconnect.php'); // Include the required DBConnection information
require_once('includes/FormObjects.php'); //include the userclass

                                                /*** Start of user management functions ***/

//function of verification if user login is correct
function verifylogin($username, $password)
{
    $mysqli = connectdb();
    $sql = "SELECT * from users WHERE userName='$username'";
    $result = $mysqli->query($sql);
    if ($result->num_rows === 1)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if($row['access']==4){
            disabledAccMsg();
            header('Refresh: 3; URL = index.php');
        }else{
        $authcheck = password_verify($password, $row['passWord']);        
        if ($authcheck){      
        session_start();        
        $_SESSION['uname'] = $username;       
        echo "<script>window.open('home.php','_self')</script>";       
        }else{
            ?>
            <div class="w3-container logisTixContainerAlpha">
            <div class= "w3-container w3-center logisTixBorderLineDGray">
            <img class= "w3-center" src="images/logistixlogotrue.png" width="50%"><br>
            <b><?php echo 'Invalid Entry';?></b>
            </div></div><?php
            header('Refresh: 5; URL = index.php');
            }
        } }else{
                echo "<br>";
                echo "invalid entry";
                echo "<br>";
                header('Refresh: 1; URL = index.php');
    }
}

//if account is disabled
function disabledAccMsg(){
    ?>
    <div class="w3-container logisTixContainerAlpha">
    <div class= "w3-container w3-center logisTixBorderLineDGray">
    <img class= "w3-center" src="images/logistixlogotrue.png" width="50%"><br>
    <b><?php echo 'Your account is disabled, contact the administrator';?></b>
   </div></div><?php
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

//count user before creating one to make sure no duplicates
function countUser ($user)
{        
    $mysqli = connectdb();

    $username = $user-> getUsername();
    // Define the Query
    // For Windows MYSQL String is case insensitive
    $Myquery = "SELECT count(*) as count from users where userName='$username'";

    if ($result = $mysqli->query($Myquery)) {
            /* Fetch the results of the query */         
            while( $row = $result->fetch_assoc() ){
                $count=$row["count"];                                             
            }    
            /* Destroy the result set and free the memory used for it */
            $result->close();         
        }   
            $mysqli->close();   
            return $count;          
}

//create new user. default is regular member
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

//update profile pic
function updateProfilePic(){
    $mysqli = connectdb();
    $username=$_SESSION['uname'];
       
    $image='images/' .$_FILES['image']['name'];
    $image= mysqli_real_escape_string($mysqli, $image);
    
    if(preg_match("!image!", $_FILES['image']['type'])){
       if(copy($_FILES['image']['tmp_name'], $image)){

    $mysqli->query("UPDATE users SET image = '$image' WHERE userName='$username'") or die($mysqli->error);

    header("location: home.php");
}}}

//shows profile pic
function showProfilePic(){
    $mysqli = connectdb();
    $username=$_SESSION['uname'];

    // $mysqli->query("SELECT image from users WHERE userName='$username'");
    $sql = "SELECT * from users WHERE userName='$username'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $showPic = $row['image'];
    echo $showPic;
}

//to view all member in a list except the current user
function selectAllMembers(){
    $mysqli = connectdb(); 
    $username = $_SESSION['uname'];
    $result =$mysqli->query("SELECT * from users where userName !='$username'");?>
            <div class ="w3-container">
            <table class="w3-table w3-striped w3-white">
                <thead class= "logistixBlueBack"><tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Date of Status</th>
                        <th colspan="2">Action</th>
                    </tr> </thead> <?php 
            while($row = $result->fetch_assoc()): 
                if ($row['access']==4){
                $access = "Disabled";
                } else{
                    $access = "Active";
                }
                ?>
                <tr><td><?php echo $row['userID'];?></td>
                    <td><?php echo $row['userName'];?></td>
                    <td><?php echo $access;?></td>
                    <td><?php echo $row['dateTime'];?></td>                  
                    <td>
                       <a href="process.php?disable=<?php echo $row['userID'];?>" class="btn w3-button w3-black">Disable</a></td>
                   </tr>
                <?php endwhile; ?>                          
</table>
</div><?php
}

//disables a user account
function disableAccount ()
{
    // Connect to the database
    $mysqli = connectdb();
    $userid = $_GET['disable'];

    $disableAccess = "4";
    $disableDate = date('Y-m-d H:i:s');

    $mysqli->query("UPDATE users SET access = '$disableAccess', dateTime= '$disableDate' WHERE userID='$userid'")
    or die($mysqli->error());
    
    header("location: home.php");
}

//if admin has not changed the password
function initAdmin(){
    $mysqli = connectdb();
    $initAdmin ="";
    $access = "";
    $user= $_SESSION['uname'];
    $sql = "SELECT initAccess, access from users WHERE userName='$user'";
    $result = $mysqli->query($sql);
         
    if ($result->num_rows===1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);

        $initAdmin = $row['initAccess'];
        $access = $row['access'];
        
  if ($access == 1){
       
      if($initAdmin == 0){
          
            echo "<script>window.open('changePassword.php','_self')</script>";
    }}}        
}

//if user is admin
function isAdmin(){
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
            
        return true;
        } 
    }  
}

//if user is admin or member
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

//function to verify access level and call sidenav display function
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

//displays admin sidenav
function isAdminSideDisplay(){
    ?>
    <div class="w3-container w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="home.php" class="w3-bar-item w3-button w3-padding w3-mobile"><i class="fa fa-eye fa-fw"></i>  Overview</a>
    <a href="inventory.php" class="w3-bar-item w3-button w3-padding w3-mobile"><i class="fa fa-check fa-fw"></i>  Inventory</a>
    <a href="addStaff.php" class="w3-bar-item w3-button w3-padding w3-mobile"><i class="fa fa-users fa-fw"></i>  Add Staff</a>
    <a href="updateProfile.php" class="w3-bar-item w3-button w3-padding w3-mobile"><i class="fa fa-photo fa-fw"></i>  Profile Pic</a>
    <a href="changePassword.php" class="w3-bar-item w3-button w3-padding w3-mobile"><i class="fa fa-cog fa-fw"></i>Change Password</a><br><br>
  </div>
  <?php
}

//display member sidenav
function isMemberSideDisplay(){
    ?>
    <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="home.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Overview</a>
    <a href="updateProfile.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-photo fa-fw"></i>  Profile Pic</a>
    <a href="changePassword.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>Change Password</a><br><br>
  </div>
  <?php
}

function idleKick(){
    $expireAfterSeconds = "";
    echo $expireAfterSeconds;
    
    //Expire the session if user is inactive for 30
    // 1 minute for testing try 60 for an hour.
    $expireAfter = 360;
 
    //Check to see if our "last action" session
    //variable has been set.
    if(isset($_SESSION['last_action'])){
    
    //Figure out how many seconds have passed
    //since the user was last active.
    $secondsInactive = time() - $_SESSION['last_action'];
    
    //Convert our minutes into seconds.
    $expireAfterSeconds = $expireAfter * 60;
    
    //Check to see if they have been inactive for too long.
    if($secondsInactive >= $expireAfterSeconds){
        //User has been inactive for too long.
        //Kill their session.
        session_unset();
        session_destroy();
        echo "<script>window.open('idle.php','_self')</script>";
    }
    return true;
}
//Assign the current timestamp as the user's
//latest activity
$_SESSION['last_action'] = time();

}


                                                /*** End of user management functions ***/



/*** Start of product management functions ***/


//shows the latest # products in index
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



/*** end of product management functions **/

?>
