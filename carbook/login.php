<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\style.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
	<style type="text/css">
		.card{
			box-shadow: 0px 8px 39px 1px rgba(0,0,0,0.73);
			-webkit-box-shadow: 0px 8px 39px 1px rgba(0,0,0,0.73);
			-moz-box-shadow: 0px 8px 39px 1px rgba(0,0,0,0.73);

		}
	</style>
</head>
<body>
	<!--Sign up form-->
	<div class="pform">

	<div class="card"> 
		<div class="card-body">
			<h5 class="card-title">Login</h5>
			<hr>
			<form method="post" action="login_process.php">
				
					
					<label>Enter ic : </label>
					<br>
					<input class="form-control" type="text" name="ic" id="ic" placeholder="Enter ic or email" required>
					<br>
					
					<label>Password : </label>
					<br>
					<input class="form-control" type="password" name="pwd" id="pwd" placeholder="Enter your password" required>
					<br>
					
					<p id="msg" style="color: red;"></p>
					<br>
					<button type="submit" name="submit" value="s" id="btn" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>

	</div>
	
	<div class="ftr">
    	<footer><p>Singthai Srisoi Sdn Bhd</p></footer>
  	</div>
</body>
</html>