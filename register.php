<?php require_once('includes/functions.php'); ?>
<!-- Needed For SQLFunctions getFaculty call -->
<div class="w3-container logisTixContainerAlpha w3-padding-16">
    <div class="w3-container w3-center logisTixBorderLineDGray w3-padding-16">
        <img class="w3-center" src="images/logistixlogotrue.png" width="50%"><br>

        <?php
        if (isset($_POST["submit"])) {
            validate_form();
        } else {
            echo "<script>window.open('index.php','_self')</script>";
        }

        function validate_form()
        {
            // $messages = array();
            // $redisplay = false;
            // Assign values
            $firstname = $_POST["fname"];
            $lastname = $_POST["lname"];
            $username = $_POST["uname"];
            $email = $_POST["email"];
            $password = $_POST["pword"];

            $user = new userClass($firstname, $lastname, $username, $email, $password);
            $count = countUser($user);

            // Check for accounts that already exist and Do insert
            if ($count == 0) {
                $res = createUser($user);

                if ($res) {
                    echo "<h3>Congratulations!!!</h3>";
                    echo "<h3>$firstname $lastname has been added!</h3> ";
                    header('Refresh: 2; URL = home.php');
                } else {
                    echo "<h3>There's been a mistake!!!</h3>";
                    echo "<h3>$firstname $lastname was not added. There was an error please try again!</h3> ";
                    echo "<a href='includes/registerModal.php'> Return to Student App.</a>";
                }
            } else {
                echo "<h3>A user account with that username already exist.</h3> ";
                echo "<a href='index.php'> Return to registration.</a>";
            }
        } ?>
    </div>
</div>