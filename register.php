<?php require_once('includes/functions.php');

if (isset($_POST["submit"])) {
    header('Refresh: 2; URL = addStaff.php');
    validate_form();
} else {
    echo "<script>window.open('index.php','_self')</script>";
}

// Check whether account already exists
function validate_form() 
{
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $username = $_POST["uname"];
    $email = $_POST["email"];
    $password = $_POST["pword"];

    $user = new userClass($firstname, $lastname, $username, $email, $password);
    $count = countUser($user);
    include 'header.php'; ?>

    <body>
        <div class="w3-container logisTixContainerAlpha">
            <div class="w3-container w3-center logisTixBorderLineDGray">
                <img class="w3-center" src="images/logistixlogotrue.png" width="50%"><br><?php
                if ($count == 0) {
                    $res = createUser($user); 
                    if ($res) { ?>
                        <span><strong><?php echo $username; ?></strong> has been added successfully</span><?php 
                    } else { ?>
                        <span><strong><?php echo $username; ?></strong> was not added. There was an error please try again.</span><?php 
                    }
                } else { ?>
                    <span>User already exists.</span><?php 
                } ?>
            </div>
        </div><?php
}?>
