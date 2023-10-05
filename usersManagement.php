<?php
include "connection.php";
session_start();

if(count($_SESSION) == 0){
	header("location:adminLogin.php");	
}

//echo "<pre>";print_r($_SESSION);die;
if(isset($_POST) AND count($_POST) > 0){
	$firstnamee = $_POST['firstnamee'];
	$emailll = $_POST['emailll'];
	$passwordd = ($_POST['passwordd']);
	$statuss = $_POST['statuss'];
	

	$sql = "INSERT INTO user (firstnamee,emailll,passwordd,statuss) VALUES ('".$firstnamee."','".$emailll."','".$passwordd."','".$statuss."')";
	
	if(mysqli_query($conn,$sql)){
		$status = true;
		$msg = "User Inserted";
	}
	else {
		$status = false;
		$msg = "Error Found";
	}
}


$product_sql ="SELECT * FROM user";
$product_result = mysqli_query($conn,$product_sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Pignose Calender -->
    <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

<style>
    [data-nav-headerbg="color_1"] .nav-header {
  background-color: #fff !important;
}

[data-headerbg="color_1"] .header {
    background-color: #36404B !important;
}

.hamburger .toggle-icon {
    font-size: 1.4rem;
    line-height: 2rem;
    color: #fff !important;
}

</style>

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
        <div class="brand-logo">
                <a href="index.html">
                <h3><i>Inventory System</i></h3>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <!-- <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div> -->
                <div class="header-right">
                    <ul class="clearfix">
                        
                        
                                
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                
                                <div class="dropdown-content-body">
                                    <ul>
                                        
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Ended Successfully</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span> 
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                        
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="images/user/form-user.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <hr class="my-2">
                                        <li><a href="#">Hi! &emsp;<?php echo $_SESSION['firstnamee'];?></a></li>
                                        <li><a href="adminLogin.php"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                <li><a href="adminDashboard.php">Dashboard</a></li>
                <li><a href="usersManagement.php">Users</a></li>
                <li><a href="categoriesManagement.php">Categories</a></li>
                <li><a href="productManagement.php">Products</a></li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
                <div class="row">
                <div class="container" style="margin-top: 2%">
  		<div class="row">
  			<div class="col-md-6">

  				<?php 
  				if(isset($status)) {
	  				if($status == TRUE){?>
						<div class="alert alert-success">
							<strong>Success!</strong> <?php echo $msg;?>
						</div>
					<?php  
					}
					else {?>
						<div class="alert alert-danger">
							<strong>Error!</strong> <?php echo $msg;?>
						</div>
					<?php 
					}
				}
				?>


	  			<form action="usersManagement.php" method="POST">
				  
				  	<div class="form-group">
				    	<label for="email">Name:</label>
				    	<input type="text" name="firstnamee" required class="form-control" placeholder="Name">
				  	</div>

				  	<div class="form-group">
				    	<label for="email">Email:</label>
				    	<input type="text" name="emailll" required class="form-control" placeholder="Email">
				  	</div>

				  	<div class="form-group">
				    	<label for="email">Password:</label>
				    	<input type="password" name="passwordd" required class="form-control" placeholder="Password">
				  	</div>

				  	<div class="form-group">
                      <label for="examplestatus">Status</label><br>
                                        <select class="form-control" name="statuss" value="<?php echo $data['statuss'] ?>">
                                            <?php if($data['statuss']=='1'){ ?>
                                                <option value="1">Active</option>
                                                <option value="0">In-Active</option>
                                            <?php } 

                                            else{ ?>
                                                <option value="0">In-Active</option>
                                                <option value="1">Active</option>
                                            <?php } ?>
                                        </select><br>
				  	</div>


				  <button type="submit" class="btn btn-primary">Add User</button>
                  
				</form>
			</div>

			<div class="col-md-6">
				<?php
				if(isset($GET['delete_success'])){
					if($GET['delete_success'] == 1){
					?>
						<div class="alert alert-danger">
							<strong> User Deleted Successfully</strong>
					    </div>
					<?php
					}
					else{
					?>
					   <div class="alert alert-warning">
							<strong>Error Found</strong>
						</div>
					<?php
					}
					
				}
				?>

				<table class="table table-bordered">
				    <thead>
				      <tr>
				        <th>ID</th>
				        <th>Name</th>
				        <th>email</th>
						
				        <th>Action</th>
				      </tr>
				    </thead>
				    <tbody>
				    	<?php
					    if(mysqli_num_rows($product_result) > 0)
					    {
					    	while($row = mysqli_fetch_array($product_result))
					        {
					        ?>
						      <tr>
						        <td><?php echo $row['ID'];?></td>
						        <td><?php echo $row['firstnamee'];?></td>
						        <td><?php echo $row['emailll'];?></td>
								<td>
						        	<a href="#" data-href="deleteUsers.php?ID=<?php echo $row["ID"];?>" class="btn btn-danger delete_this_item">Delete</a>
						        </td>
						        
						      </tr>
						    <?php 
							}
						}
						?>

				      
				    </tbody>
				  </table>
			</div>
		</div>
	</div>
 </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

    <!-- Chartjs -->
    <script src="./plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="./plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="./plugins/d3v3/index.js"></script>
    <script src="./plugins/topojson/topojson.min.js"></script>
    <script src="./plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="./plugins/raphael/raphael.min.js"></script>
    <script src="./plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="./plugins/moment/moment.min.js"></script>
    <script src="./plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="./plugins/chartist/js/chartist.min.js"></script>
    <script src="./plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>



    <script src="./js/dashboard/dashboard-1.js"></script>

    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

  <script type="text/javascript">
	$(".delete_this_item").click(function(){
		if(confirm("Are you sure you want to delete this?")){
			// $(this).data('href');
			// $(this).attr("data-href");
			window.location = $(this).data('href');
		}
	});
</script>

</body>

</html>