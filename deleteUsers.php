<?php
include "connection.php";
session_start();

if(count($_SESSION) == 0){
    header("location:adminLogin.php");
}

if(isset($_GET) AND count($_GET) > 0){
    $ID = $_GET["ID"];

    $sql="DELETE FROM user WHERE ID = $ID";

    if(mysqli_query($conn,$sql)){
        header("location:usersManagement.php?delete_success=1");
    }
    else{
        header("location:usersManagement.php?delete_success=0");
    }
}
?>