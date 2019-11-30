<?php
session_start();
require_once('includes/functions.php');

$update = false;
$id = 0;
$name = "";
$manu = "";
$desc = "";
$qty = "";

if(isset($_GET['disable'])){
    disableAccount();
}

if(isset($_POST['updatepic'])){
    updateProfilePic();   
}

if(isset($_POST['save'])){
    insertProduct();    
}

if(isset($_GET['delete'])){
    deleteProduct();
}

if(isset($_POST['update'])){
    updateProducts();
}

if(isset($_GET['edit'])){
    $mysqli = connectdb();
    $id = $_GET['edit'];
    
    $update = true;
    $result= $mysqli->query("SELECT * FROM products WHERE ID=$id") or die($mysqli->error());
    
    if(mysqli_num_rows($result)==1){
        $row =$result->fetch_array();
        $name =$row['PName'];
        $manu =$row['PManu'];
        $desc =$row['PDesc'];
        $qty = $row['qty'];
        $image = $row["PImage"];
    }
}