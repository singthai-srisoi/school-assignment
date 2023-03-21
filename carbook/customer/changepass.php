<?php 
//start the session if it's not started
if (session_id() == ''){
	session_start();
}
//check if login and correct authority
if (!isset($_SESSION['uid']) || $_SESSION['author'] != 1){
	header('location:../logout.php');
}else{
	include_once '../config.php';

if (isset($_POST['change'])){
	//check old password valid

	$uid = $_SESSION['uid'];
	$pwd = $_POST['oldpwd'];
	$pwd = hash("sha256", $pwd);

	$result = $con->query("SELECT * FROM user WHERE id = $uid;") or die($con->error);
	$row = $result->fetch_assoc();

	$pwd = substr($pwd, 0,30);
	$row['password'] = substr($row['password'], 0,30);
	$cmp = ($pwd == $row['password'])?true : false;
	//echo $cmp;
	if ($cmp){
		$newpwd = $_POST['newpwd'];
		$cpwd = $_POST['cpwd'];

		//compare
		if ($newpwd == $cpwd){
			$newpwd = hash("sha256", $newpwd);
			$con->query("UPDATE user SET password='$newpwd' WHERE id = $uid;") or die($con->error);
		}else{
			echo "<script>alert('Confirm your password');
		history.go(-1);</script>";
		}
	}else{
		//echo ' here running';
		echo "<script>alert('Incorrect password, please try again');
		history.go(-1);</script>";
	}
}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\style.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#cpwd').keyup(function(){
				//get value from input
				let pwd = $('#newpwd').val();
				let cpwd = $(this).val();

				if (pwd !== cpwd){
					$('#msg').text('password in identical!');
				}else{
					$('#msg').text('');
				}
			})
		});
	</script>
	<style>
		
	</style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container-fluid theme-color">
		<h2>User Profile</h2>
		<hr>

		<table class="table table-bordered">
		  <tbody>
		  	<form method="post" action="">
		    <tr>
		      <th scope="row">Old Password</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="password" name="oldpwd" >
		      	</div>
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">New Password</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="password" name="newpwd" id="newpwd">
		      	</div>

		      </td>
		    </tr>
		    <tr>
		      <th scope="row">Confirm Password</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="password" name="cpwd" id="cpwd">
		      	<p id="msg" style="color: red;"></p>
				</div>

		      </td>
		    </tr>
		    <tr>
		      <th scope="row"></th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "btn btn-primary" id="changebtn" type="submit" name="change" id="bttn">
				</div>
		      </td>
		    </tr>
			</form>
		    
		    
		  </tbody>
		</table>
	</div>


	<div class="ftr">
    	<footer><p>Singthai Srisoi Sdn Bhd</p></footer>
  	</div>
</body>
</html>
<?php } ?>