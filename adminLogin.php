<?php
include "connection.php";
session_start();
$error = "";
if(isset($_POST) AND count($_POST) > 0){
	$emailll = $_POST['emailll'];
	$passwordd = $_POST['passwordd'];

	$sql ="SELECT * FROM user WHERE emailll = '".$emailll."' AND passwordd = '".$passwordd."'";
	$result = mysqli_query($conn,$sql);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_assoc($result);
		if(isset($row) AND count($row)){
			$_SESSION["ID"] = $row['ID'];
			$_SESSION["firstnamee"] = $row['firstnamee']." " . $row['lastnamee'];
			$_SESSION["emailll"] = $row['emailll'];

			header("location:adminDashboard.php");
			//echo "Login Done!";
		}
	}
	else {
		$error = "Login Failed!";
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>

	
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!------ Include the above in your HEAD tag ---------->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
</head>

<body>
<div class="container">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <!-- <span> <img src="https://amar.vote/assets/img/amarVotebd.png" class="w-75" alt="Logo"> </span><br /> -->
            <span class="logo_title mt-5"> Admin Login</span>
            

        </div>
        <div class="card-body">

            <?php if(!empty($error)) {?>
            <div class="alert alert-danger">
                <strong>Error!</strong> <?php echo $error;?>
            </div>
            <?php } ?>

            <form id="login-form" action="adminLogin.php" method="POST" role="form" style="display: block;">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="email" required name="emailll" id="username" tabindex="1" class="form-control"
                        placeholder="Username" value="">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" required name="passwordd" id="password" tabindex="2" class="form-control"
                        placeholder="Password">
                </div>

                <div class="form-group">
                    <input type="submit" name="login-submit" id="login-submit" value="Log In"
                        class="btn btn-outline-danger float-right login_btn">
                </div>

            </form>
        </div>
    </div>
</div>
</body>

<style>
body {
    background: #000 !important;
}

.card {
    border: 1px solid #28a745;
}

.card-login {
    margin-top: 130px;
    padding: 18px;
    max-width: 30rem;
}

.card-header {
    color: #fff;
    /*background: #ff0000;*/
    font-family: sans-serif;
    font-size: 20px;
    font-weight: 600 !important;
    margin-top: 10px;
    border-bottom: 0;
}

.input-group-prepend span {
    width: 50px;
    background-color: #ff0000;
    color: #fff;
    border: 0 !important;
}

input:focus {
    outline: 0 0 0 0 !important;
    box-shadow: 0 0 0 0 !important;
}

.login_btn {
    width: 130px;
}

.login_btn:hover {
    color: #fff;
    background-color: #ff0000;
}

.btn-outline-danger {
    color: #fff;
    font-size: 18px;
    background-color: #28a745;
    background-image: none;
    border-color: #28a745;
}

.form-control {
    display: block;
    width: 100%;
    height: calc(2.25rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1.2rem;
    line-height: 1.6;
    color: #28a745;
    background-color: transparent;
    background-clip: padding-box;
    border: 1px solid #28a745;
    border-radius: 0;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.input-group-text {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding: 0.375rem 0.75rem;
    margin-bottom: 0;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1.6;
    color: #495057;
    text-align: center;
    white-space: nowrap;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: 0;
}
</style>