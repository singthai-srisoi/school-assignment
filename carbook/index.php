<?php 
session_start();
session_destroy();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
	<style type="text/css">
		.info{
			background-color: #c180fa;
			height: 350px;
			width: 100%;
  			border-radius: 5px;
  			margin-top: 20px;

  			display: flex;
  			flex-direction: row;
		   flex-wrap: nowrap;
		   overflow-x: auto;
		   -ms-overflow-style: -ms-autohiding-scrollbar; 
		}
		.d-flex div{
			height: 280px;
			width: 280px;
			margin: 20px;
			display: flex;
			flex: 0 0 auto;
			overflow: auto;
		}
		.d-flex img{
			height: 280px;
			width: 280px;
			margin: 0;
			padding: 0;
		}
	</style>
</head>
<body>
	<!--Nav bar on top-->
	<div id="top-nav">
		<ul class="nav"> 
			<li class="nav-item">
				<a class="navbar-brand" href="#">Car Booking System</a>
			</li>
			<li class="nav-item">
		    	<a class="nav-link active" href="#">Active</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="#">Link</a>
		  	</li>
		  	<li class="nav-item">
		  	  	<a class="nav-link" href="signup.php">signup</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="login.php">login</a>
		  	</li>
		</ul>
	</div>

	<div class="container">
		<h2 style="padding:10px;">Ready to book a car?</h2>
		<div class="info d-flex flex-row">
			<?php 
			include_once 'config.php';
			$index = 0;
			while ($index < 5){
				//generate random number
				$random = rand(1,100);

				//check if the number has a picture
				$result = $con->query("SELECT * FROM image WHERE id=$random;");
				//if exist print image
				if ($result->num_rows > 0){
					$index = $index+1;
					$row = $result->fetch_assoc();
			 ?>
			 <div>
			 	<img src="img/<?php echo $row['file_name']; ?>">
			 </div>
			<?php }} ?>
		</div>
		<div class="container-fluid container px-4 d-flex justify-content-center" style="padding: 50px;">
			<a href="login.php" class="btn btn-outline-primary btn-lg" style="margin-right:50px;">login</a>
			<a href="signup.php" class="btn btn-outline-success btn-lg">signup</a>
		</div>
		<div class="container-fluid container px-4 d-flex flex-column justify-content-center" style="padding: 50px;">
			<p>Book your car and enjoy your journey</p>
			<hr>
			<p>We provide service that you can rely on. Just book your car and go anyway you want. We have tons of car to let you choose. Just pick one and go on your ride. We also have luxury car that can make you feel rich.</p>
			<p>Enjoy your journey</p>
		</div>

	</div>

	
	<div class="ftr">
    	<footer><p>Singthai Srisoi Sdn Bhd</p></footer>
  	</div>
</body>
</html>