<?php
require_once('includes/Dbconnect.php'); // Include the required DBConnection information
require_once('includes/FormObjects.php'); //include the userclass
require_once('./paginate.php');

/*** Start of user management functions ***/

//function of verification if user login is correct
function verifylogin($username, $password)
{
    $mysqli = connectdb();
    $sql = "SELECT * from users WHERE userName='$username'";
    $result = $mysqli->query($sql);
    if ($result->num_rows === 1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($row['access'] == 4) {
            header('Refresh: 3; URL = index.php');
            disabledAccMsg();
        } else {
            $authcheck = password_verify($password, $row['passWord']);
            if ($authcheck) {
                session_start();
                $_SESSION['uname'] = $username;
                echo "<script>window.open('home.php','_self')</script>";
            } else { 
                header('Refresh: 5; URL = index.php'); ?>
                <div class="w3-container logisTixContainerAlpha">
                    <div class="w3-container w3-center logisTixBorderLineDGray">
                        <img class="w3-center" src="images/logistixlogotrue.png" width="50%"><br>
                        <b><?php echo 'Invalid Entry'; ?></b>
                    </div>
                </div><?php
            }
        }
    } else { 
        header('Refresh: 5; URL = index.php'); ?> 
        <div class="w3-container logisTixContainerAlpha">
            <div class="w3-container w3-center logisTixBorderLineDGray">
                <img class="w3-center" src="images/logistixlogotrue.png" width="50%"><br>
                <b><?php echo 'Invalid Entry'; ?></b>
            </div>
        </div><?php
                        
    }
}

//if account is disabled
function disabledAccMsg()
{ ?>
    <div class="w3-container logisTixContainerAlpha">
        <div class="w3-container w3-center logisTixBorderLineDGray">
            <img class="w3-center" src="images/logistixlogotrue.png" width="50%"><br>
            <b><?php echo 'Your account is disabled, contact the administrator'; ?></b>
        </div>
    </div><?php
}

//update password function
function updatePassword()
{
    // Connect to the database
    $mysqli = connectdb();
    $username = $_POST['uname'];
    //$username=$_SESSION['uname'];
    $initAccess = "1";
    //$password =  $user->getPassword();
    $password = password_hash($_POST["pword"], PASSWORD_DEFAULT);

    $mysqli->query("UPDATE users SET passWord = '$password', initAccess= '$initAccess' WHERE userName='$username'")
        or die($mysqli->error());
}

//count user before creating one to make sure no duplicates
function countUser($user)
{
    $mysqli = connectdb();

    $username = $user->getUsername();
    // Define the Query
    // For Windows MYSQL String is case insensitive
    $Myquery = "SELECT count(*) as count from users where userName='$username'";

    if ($result = $mysqli->query($Myquery)) {
        /* Fetch the results of the query */
        while ($row = $result->fetch_assoc()) {
            $count = $row["count"];
        }
        /* Destroy the result set and free the memory used for it */
        $result->close();
    }
    $mysqli->close();
    return $count;
}

//create new user. default is regular member
function createUser($user)
{
    // Connect to the database
    $mysqli = connectdb();
    $date = date('Y-m-d H:i:s');
    $access = 0;
    $failLog = 0;
    $initAccess = 1;
    $firstname = $user->getFirstname();
    $lastname = $user->getLastname();
    $username = $user->getUsername();
    $email = $user->getEmail();
    //$password =  $user->getPassword();
    $password = password_hash($_POST["pword"], PASSWORD_DEFAULT);
    // Add Prepared Statement
    $Query = "INSERT INTO users 
	     (firstName, lastName,userName,email,passWord,dateTime, access,failLog,initAccess) 
              VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($Query);
    $stmt->bind_param("sssssssss", $firstname, $lastname, $username, $email, $password, $date, $access, $failLog, $initAccess);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();
    return true;
}

//update profile pic
function updateProfilePic()
{
    $mysqli = connectdb();
    $username = $_SESSION['uname'];

    $image = 'images/' . $_FILES['image']['name'];
    $image = mysqli_real_escape_string($mysqli, $image);

    if (preg_match("!image!", $_FILES['image']['type'])) {
        if (copy($_FILES['image']['tmp_name'], $image)) {
            header("location: home.php");
            $mysqli->query("UPDATE users SET image = '$image' WHERE userName='$username'") or die($mysqli->error);
        }
    }
}

//shows profile pic
function showProfilePic()
{
    $mysqli = connectdb();
    $username = $_SESSION['uname'];

    // $mysqli->query("SELECT image from users WHERE userName='$username'");
    $sql = "SELECT * from users WHERE userName='$username'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $showPic = $row['image'];
    echo $showPic;
}

//to view all member in a list except the current user
function displayAllUsers() // selectAllMembers() 
{
    $mysqli = connectdb();
    $username = $_SESSION['uname'];
    $result = $mysqli->query("SELECT * from users where userName !='$username'"); ?>
    <table class="w3-table w3-striped w3-white">
        <thead class="logistixBlueBack">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Status</th>
                <th>Date of Status</th>
                <th colspan="2">Action</th>
            </tr>
        </thead> <?php
        while ($row = $result->fetch_assoc()) :
            if ($row['access'] == 4) {
                $access = "Disabled";
            } else {
                $access = "Active";
            } ?>
        <tr>
            <td><?php echo $row['userID']; ?></td>
            <td><?php echo $row['userName']; ?></td>
            <td><?php echo $access; ?></td>
            <td><?php echo $row['dateTime']; ?></td>
            <td><a href="process.php?disable=<?php echo $row['userID']; ?>" class="btn w3-button w3-black">Disable</a></td>
        </tr>
        <?php endwhile; ?>
    </table> <?php
}

//disables a user account
function disableAccount()
{
    // Connect to the database
    $mysqli = connectdb();
    $userid = $_GET['disable'];

    $disableAccess = "4";
    $disableDate = date('Y-m-d H:i:s');

    $mysqli->query("UPDATE users SET access = '$disableAccess', dateTime= '$disableDate' WHERE userID='$userid'")
        or die($mysqli->error());

    header("location: editMember.php");
}

//if admin has not changed the password
function initAdmin()
{
    $mysqli = connectdb();
    $initAdmin = "";
    $access = "";
    $user = $_SESSION['uname'];
    $sql = "SELECT initAccess, access from users WHERE userName='$user'";
    $result = $mysqli->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $initAdmin = $row['initAccess'];
        $access = $row['access'];

        if ($access == 1) {
            if ($initAdmin == 0) {
                echo "<script>window.open('changePassword.php','_self')</script>";
            }
        }
    }
}

//if user is admin
function isAdmin()
{
    $mysqli = connectdb();
    $access = "";
    $user = $_SESSION['uname'];
    $sql = "SELECT initAccess, access from users WHERE userName='$user'";
    $result = $mysqli->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $access = $row['access'];

        if ($access == 1) {
            return true;
        }
    }
}

//if user is admin or member
function displayAccessLevel() // isAdminMember()
{
    $mysqli = connectdb();
    $access = "";
    $user = $_SESSION['uname'];
    $sql = "SELECT initAccess, access from users WHERE userName='$user'";
    $result = $mysqli->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $access = $row['access'];

        if ($access == 1) {
            echo "Admin";
        }
        if ($access == 0) {
            echo "Member";
        }
        if ($access == 3) {
            echo "Guest";
        }
    }
}

//function to verify access level and call sidenav display function
function displaySidebar() // isAdminSide() 
{
    $mysqli = connectdb();
    $access = "";
    $user = $_SESSION['uname'];
    $sql = "SELECT initAccess, access from users WHERE userName='$user'";
    $result = $mysqli->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $access = $row['access'];

        if ($access == 1) {
            adminSidebar(); // isAdminSideDisplay(); 
        }
        if ($access == 0) {
            memberSidebar(); // isMemberSideDisplay(); 
        }
    }
}

//displays admin sidenav
function adminSidebar() // isAdminSideDisplay()
{ ?>
    <!-- Admin Sidebar -->
    <ul class="sidebar navbar" id="accordionSidebar">
        <!-- Divider -->
        <hr class="sidebar-divider sidebar-top">

        <!-- Dashboard -->
        <li class="nav-item active">
            
            <a class="nav-link" href="home.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span><?php displayAccessLevel();?></span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Menu
        </div>

        <!-- Nav Item 1 - Inventory Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>Inventory</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="collapse-inner rounded">
                <a class="collapse-item" href="inventory.php">Edit Inventory</a>
            </div>
            </div>
        </li>

        <!-- Nav Item 2 - Manage Accounts Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMA" aria-expanded="false" aria-controls="collapseMA">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Manage Accounts</span>
            </a>
            <div id="collapseMA" class="collapse" aria-labelledby="headingMA" data-parent="#accordionSidebar" style="">
            <div class="collapse-inner rounded">
                <a class="collapse-item" href="addStaff.php">Add new account</a>
                <a class="collapse-item" href="editMember.php">Edit acccount</a>
                <a class="collapse-item" href="#">Aduit System</a>
            </div>
            </div>
        </li>

        <!-- Nav Item 3 - Account Settings Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAS" aria-expanded="false" aria-controls="collapseAS">
            <i class="fas fa-fw fa-cog"></i>
            <span>Account Settings</span>
            </a>
            <div id="collapseAS" class="collapse" aria-labelledby="headingAS" data-parent="#accordionSidebar" style="">
            <div class="collapse-inner rounded">
                <a class="collapse-item" href="updateProfile.php">Profile</a>
                <a class="collapse-item" href="changePassword.php">Change password</a>
            </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="sidebar-toggler">
            <button class="rounded-circle" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar --> <?php
}

//display member sidenav
function memberSidebar() // isMemberSideDisplay()
{ ?>
    <!-- Member Sidebar -->
    <ul class="sidebar navbar" id="accordionSidebar">
        <!-- Divider -->
        <hr class="sidebar-divider sidebar-top">

        <!-- Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="home.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Menu
        </div>

        <!-- Nav Item 1 - Inventory Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>Inventory</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="collapse-inner rounded">
                <a class="collapse-item" href="inventory.php">Edit Inventory</a>
            </div>
            </div>
        </li>

        <!-- Nav Item 3 - Account Settings Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAS" aria-expanded="false" aria-controls="collapseAS">
            <i class="fas fa-fw fa-cog"></i>
            <span>Account Settings</span>
            </a>
            <div id="collapseAS" class="collapse" aria-labelledby="headingAS" data-parent="#accordionSidebar" style="">
            <div class="collapse-inner rounded">
                <a class="collapse-item" href="updateProfile.php">Profile</a>
                <a class="collapse-item" href="changePassword.php">Change password</a>
            </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="sidebar-toggler">
            <button class="rounded-circle" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar --> <?php
}
    //member display is paginated
    function paginateMemberDisplay(){
         $mysqli = connectdb();
         $username = $_SESSION['uname'];
         $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
         $limit = 4;
         $startpoint = ($page * $limit) - $limit;       
         $statement ="";        
         $result =$mysqli->query("SELECT * from users  where userName !='$username' LIMIT $limit OFFSET $startpoint");?>                                                     
           
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
           <?php echo pagination($statement, $limit, $page); ?>
<?php
}

function idleKick()
{
    $expireAfterSeconds = "";
    echo $expireAfterSeconds;

    //Expire the session if user is inactive for 30
    // 1 minute for testing try 60 for an hour.
    $expireAfter = 30;

    //Check to see if our "last action" session
    //variable has been set.
    if (isset($_SESSION['last_action'])) {

        //Figure out how many seconds have passed
        //since the user was last active.
        $secondsInactive = time() - $_SESSION['last_action'];

        //Convert our minutes into seconds.
        $expireAfterSeconds = $expireAfter * 60;

        //Check to see if they have been inactive for too long.
        if ($secondsInactive >= $expireAfterSeconds) {
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

function selectUserId(){
        // Connect to the database
    $mysqli = connectdb();
    $user= $_SESSION['uname'];
    // Define the Query
    // For Windows MYSQL String is case insensitive
    $result = $mysqli->query("SELECT userID from users where userName='$user'");
    
            /* Fetch the results of the query */         
            while( $row = $result->fetch_assoc()){
                $user_id = $row['userID'];                
            }  
           return $user_id;        
}

/*** End of user management functions ***/

/*** Start of product management functions ***/

//shows the latest # products in index
function indexShowProducts()
{
    $mysqli = connectdb();
    $sql = "SELECT *, Timestamp(dateup) from products ORDER BY dateup DESC limit 8";
    $result = $mysqli->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
    } ?>
    <br>
    <div class="w3-row-padding"><?php
        /* Fetch the results of the query */
        while ($row = $result->fetch_assoc()) {
            $image = $row["PImage"];
            $name = $row["PName"]; ?>

        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-display-container">
                <div class="w3-display-topleft logistixBlueBack w3-padding"><?php echo $name; ?></div>
                <img src="<?php echo $image; ?>" class="w3-margin w3-padding" alt="<?php echo $name; ?>" style="object-fit: cover" width="300px" height="300px"">
            </div>
        </div><?php
        } ?> </div> <?php
}

function selectAllProduct() {
    $mysqli = connectdb();    
    $result =$mysqli->query("SELECT * from products"); ?>

    <div class ="w3-container">
    <table class="w3-table w3-striped w3-white">
        <thead class= "logistixBlueBack">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th colspan="2">Action</th>
            </tr> 
        </thead> <?php 
    while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['PName'];?></td>
            <td><?php echo $row['PDesc'];?></td>
            <td><?php echo $row['qty'];?></td>
            <td><a href="editProduct.php?edit=<?php echo $row['ID'];?>"
                    class="w3-button logistixBlueBack">Edit</a>
            <?php 
            if (isAdmin()){ ?>                        
                <a href="process.php?delete=<?php echo $row['ID'];?>"
                class="w3-button" style="background-color: maroon; color: white">Delete</a>
                </td><?php 
            } ?>
        </tr>
        <?php endwhile; ?>                          
    </table>
    </div><?php 
}

function showAllProduct() {
    $mysqli = connectdb();    
    $result =$mysqli->query("SELECT * from products");?>
        <div class ="w3-container">
            <table class="w3-table w3-striped w3-white">
                <thead class= "logistixBlueBack">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity</th>                        
                    </tr> 
                </thead> <?php 
            while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['PName'];?></td>
                    <td><?php echo $row['PDesc'];?></td>
                    <td><?php echo $row['qty'];?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div><?php
}

function updateProducts() {
    $mysqli = connectdb();
    $id =$_POST['id'];
    $name =$_POST['name'];
    $desc =$_POST['desc'];
    $qty = $_POST['qty'];

    $mysqli->query("UPDATE products SET PName='$name', PDesc='$desc', qty='$qty' WHERE ID=$id")or die($mysqli->error());

    $_SESSION['updatemessage'] = "Success! a record has been updated";
    $_SESSION['msg_type'] = "warning";

    header("location: inventory.php");        
}

//count item out of stock
function outOfStock() {     
    $mysqli = connectdb();

    $Myquery = "SELECT count(*) as count from products where qty='0'";

    if ($result = $mysqli->query($Myquery)) {
        /* Fetch the results of the query */         
        while( $row = $result->fetch_assoc()) {
            $count=$row["count"];                                             
        }    
        /* Destroy the result set and free the memory used for it */
        $result->close();         
    }   
    $mysqli->close();   
    return $count;             
}

function totalManufacturer() {     
    $mysqli = connectdb();
    $Myquery = "SELECT count(*) as count from manufacturer";

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
 function limitShow() {
    $mysqli = connectdb();
    
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $limit = 10;
    $startpoint = ($page * $limit) - $limit;       
    $statement ="table1 order by name asc";        
    $result =$mysqli->query("SELECT * from products  LIMIT $limit OFFSET $startpoint"); ?>                

    <table class="w3-table w3-striped w3-white">
        <thead class= "logistixBlueBack">
            <tr>
                <th>ID</th>
                <th>Name</th>                     
                <th>Description</th>
                <th>Quantity</th>                        
            </tr> 
        </thead><?php 
        while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['ID'];?></td>
                <td><?php echo $row['PName'];?></td>                
                <td><?php echo $row['PDesc'];?></td>
                <td><?php echo $row['qty'];?></td>
            </tr>
        <?php endwhile; ?>                          
    </table> 
    <div id='paging'>
         <?php echo pagination($statement, $limit, $page); ?>
    </div><?php
}

function totalStocks(){     
    $mysqli = connectdb();

    $Myquery = "SELECT sum(qty) as count from products";

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

function deleteProduct(){
    $mysqli = connectdb();
    $id = $_GET['delete'];
    
    $mysqli->query("DELETE FROM products WHERE ID=$id") or die($mysqli->error());

    $_SESSION['deletemessage'] = "Success! a record has been deleted";
    $_SESSION['msg_type'] = "danger";

    header("location: inventory.php");
}

function insertProduct(){
   
    $mysqli = connectdb();
    $name = $_POST['name'];
    $manufacturer= $_POST['manufacturer'];
    $desc = $_POST['desc'];
    $qty = $_POST['qty'];
    $datum = new DateTime();
    $startTime = $datum->format('Y-m-d H:i:s');
    $userId= selectUserId();
    $result="";
    $image='images/' .$_FILES['image']['name'];
    $image= mysqli_real_escape_string($mysqli, $image);
    
    if(countManu()==0){
        $mysqli->query("INSERT INTO manufacturer (name) VALUES ('$manufacturer')");

        if(preg_match("!image!", $_FILES['image']['type'])){
            if(copy($_FILES['image']['tmp_name'], $image)){

                $mysqli->query("INSERT INTO products (user_id, manu_id, PName, PManu,PDesc, qty, PImage, dateup) 
                                VALUES('selectUserId()','".mysqli_insert_id($mysqli)."','$name','$manufacturer','$desc','$qty','$image','$startTime')") or die($mysqli->error);

                header("location: inventory.php");
            }
        }
    } else {
        $result = $mysqli->query("SELECT id from manufacturer WHERE name='$manufacturer'");

        while($row = $result->fetch_assoc()){
            $manu_id = $row['id'];
                
            $mysqli->query("INSERT INTO products (user_id, manu_id, PName, PManu,PDesc, qty, PImage, dateup) 
                            VALUES('$userId','$manu_id','$name','$manufacturer','$desc','$qty','$image','$startTime')") or die($mysqli->error);
                            
                    $_SESSION['addmessage'] = "Success! A Record has been added";
                    $_SESSION['msg_type'] = "danger";
            header("location: inventory.php");
        }
    }
}
    
function countManu (){        
    // Connect to the database
    $mysqli = connectdb();

    $manufacturer= $_POST['manufacturer'];
    // Define the Query
    // For Windows MYSQL String is case insensitive
    $Myquery = "SELECT count(*) as count from manufacturer where name='$manufacturer'";

    if ($result = $mysqli->query($Myquery)) 
    {
        /* Fetch the results of the query */         
        while( $row = $result->fetch_assoc() )
        {
            $count = $row["count"]; 
            echo $count;                                            
        }    
        /* Destroy the result set and free the memory used for it */
        $result->close();         
    }   
        $mysqli->close();   
        // return $count;
        return $count;          
}

//count item out of stock
function numberOfMember(){     
    $mysqli = connectdb();

    $Myquery = "SELECT count(*) as count from users";

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


function alarmCall(){
    ?>
                 <div class="w3-container">
      <?php if(isset($_SESSION['addmessage'])): ?>
    <div class="w3-alert w3-green w3-padding alert-<?=$_SESSION['msg_type']?>">   
    <?php
    echo $_SESSION['addmessage'];
    unset($_SESSION['addmessage']);
    ?>      
            <?php    endif ?>
   <?php if(isset($_SESSION['updatemessage'])): ?>
    <div class="w3-alert logistixOrangeBack w3-padding alert-<?=$_SESSION['msg_type']?>">
    
    <?php
    echo $_SESSION['updatemessage'];
    unset($_SESSION['updatemessage']);
    ?>
          <?php    endif ?>
    <?php if(isset($_SESSION['deletemessage'])): ?>
    <div class="w3-alert w3-red w3-padding alert-<?=$_SESSION['msg_type']?>">
    
    <?php
    echo $_SESSION['deletemessage'];
    unset($_SESSION['deletemessage']);
    ?>
        <?php    endif ?>
        
    </div></div>
    
    
    <?php
}
/*** end of product management functions **/
?>