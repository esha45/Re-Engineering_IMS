<?php
include "connection.php";
session_start();

if(count($_SESSION) == 0){
    header("location:adminLogin.php");
}

if(isset($_GET) AND count($_GET) > 0){
    $Category_ID = $_GET["Category_ID"];

    $sql="DELETE FROM categories WHERE Category_ID = $Category_ID";

    if(mysqli_query($conn,$sql)){
        header("location:categoriesManagement.php?delete_success=1");
    }
    else{
        header("location:categoriesManagement.php?delete_success=0");
    }
}
?>