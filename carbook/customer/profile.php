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

if (isset($_POST['update_name'])){
	$uid = $_SESSION['uid'];
	$name = $_POST['name'];

	$con->query("UPDATE user SET name = '$name' WHERE id = $uid; ") or die($con->error);
}
if (isset($_POST['update_ic'])){
	$uid = $_SESSION['uid'];
	$ic = $_POST['ic'];

	$con->query("UPDATE user SET ic = '$ic' WHERE id = $uid; ") or die($con->error);
}
if (isset($_POST['update_email'])){
	$uid = $_SESSION['uid'];
	$email = $_POST['email'];

	$con->query("UPDATE user SET email = '$email' WHERE id = $uid; ") or die($con->error);
}
if (isset($_POST['update_contact'])){
	$uid = $_SESSION['uid'];
	$contact = $_POST['contact'];

	$con->query("UPDATE user SET contact_no = '$contact' WHERE id = $uid; ") or die($con->error);
}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\style.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.input-fld').dblclick(function(){
				//enable input field when double click
				let editing = $(this).closest('td').find('input').prop('disabled',false);		
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
		<?php 
			//get info for table
			$uid = $_SESSION['uid'];
			$result = $con->query("SELECT * FROM user WHERE id = $uid;");
			$row = $result->fetch_assoc();
			
		 ?>
		<table class="table table-bordered">
		  <tbody>
		  	
		    <tr>
		      <th scope="row">Name</th>
		      <td><form method="post" action="">
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="name" value="<?php echo $row['name']; ?>" disabled>
		      	</div>
		      	<input type="submit" name="update_name" value="update" hidden />
		      </td></form>
		    </tr>
		    <tr>
		      <th scope="row">IC</th>
		      <td><form method="post" action="">
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="ic" value="<?php echo $row['ic']; ?>" disabled>
		      	</div>
		      	<input type="submit" name="update_ic" value="update" hidden />
		      </td></form>
		    </tr>
		    <tr>
		      <th scope="row">Email</th>
		      <td><form method="post" action="">
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="email" value="<?php echo $row['email']; ?>" disabled>
				</div>
				<input type="submit" name="update_email" value="update" hidden />
		      </td></form>
		    </tr>
		    <tr>
		      <th scope="row">Contact No</th>
		      <td><form method="post" action="">
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="contact" value="<?php echo $row['contact_no']; ?>" disabled>
		      	</div>
		      <input type="submit" name="update_contact" value="update" hidden /></form>
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">Contact No</th>
		      <td>
		      	<div>
		      	<input class = "form-control" type="date" name="contact" value="<?php echo $row['reg_date']; ?>" disabled>
		      	</div>
		      </td>
		    </tr>
		    
		    
		  </tbody>
		</table>
		<p>*double click to edit</p>
		<a href="changepass.php?uid=<?php echo $uid; ?>" class="btn btn-info">Change Password</a>
	</div>


	<div class="ftr">
    	<footer><p>Singthai Srisoi Sdn Bhd</p></footer>
  	</div>
</body>
</html>
<?php } ?>