<!DOCTYPE html>
<html>
<head>
	<title>sign up</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			//get value from pwd
			$('#r_pwd').keyup(function(){
				let pwd = $('#pwd').val();
				let r_pwd = $('#r_pwd').val();
				if (pwd !== r_pwd && r_pwd !== ""){
					$('#btn').attr('disabled',true);
					$('#msg').text("Password are not the same");
				}else{
					$('#btn').attr('disabled',false);
					$('#msg').text("");
				}
			})

			$('#ic').keyup(function(){
				let ic = $(this).val();
				//console.log(ic);
				$('#ic-msg').load('usernamecheck.php',{ic : ic});

			})
			
		})
	</script>
	<style type="text/css">
		.card{
			box-shadow: 0px 8px 39px 1px rgba(0,0,0,0.73);
			-webkit-box-shadow: 0px 8px 39px 1px rgba(0,0,0,0.73);
			-moz-box-shadow: 0px 8px 39px 1px rgba(0,0,0,0.73);
			width: 80%; margin-top: 30px;
			margin-bottom: 100px;

		}
	</style>
</head>
<body>
	<!--Sign up form-->
	<div class="pform">

	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Sign Up</h5>
			<hr>
			<form method="post" action="signup_process.php">
				
					<label>Name : </label>
					<br>
					<input class="form-control" type="text" name="name" id="name" placeholder="Enter your full name" required>
					<br>
					<label>IC : </label>
					<br>
					<input class="form-control" type="text" name="ic" id="ic" placeholder="Enter IC number without - " required autocomplete="off">
					<p id="ic-msg" style="color: red;"></p>
					<br>
					<label>Email : </label>
					<br>
					<input class="form-control" type="text" name="email" placeholder="example@email.com" required>
					<br>
					<label>Contact No : </label>
					<br>
					<input class="form-control" type="text" name="contact" required>
					<br>
					<label>Password : </label>
					<br>
					<input class="form-control" type="password" name="pwd" id="pwd" placeholder="Enter your password" required>
					<br>
					<label>Confirm Password : </label>
					<br>
					<input class="form-control" type="password" name="r_pwd" id="r_pwd" placeholder="Enter your password" required>
					<br>
					<p id="msg" style="color: red;"></p>
					<br>
					<button type="submit" name="submit" value="s" id="btn" class="btn btn-primary" disabled>Submit</button>
			</form>
		</div>
	</div>

	</div>
	
	<div class="ftr">
    	<footer><p>Singthai Srisoi Sdn Bhd</p></footer>
  	</div>
</body>
</html>