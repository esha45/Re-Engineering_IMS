<?php
include "connection.php";
session_start();

if(count($_SESSION) == 0){
    header("location:adminLogin.php");
}

if(isset($_GET) AND count($_GET) > 0){
    $Product_ID = $_GET["Product_ID"];

    $sql="DELETE FROM products WHERE Product_ID = $Product_ID";

    if(mysqli_query($conn,$sql)){
        header("location:productManagement.php?delete_success=1");
    }
    else{
        header("location:productManagement.php?delete_success=0");
    }
}
?>

