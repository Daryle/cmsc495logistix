<?php
session_start();
require_once('includes/functions.php');

$update=false;
$id =0;
$name ="";
$desc = "";
$qty = "";


if(isset($_GET['disable'])){
    disableAccount();
}



