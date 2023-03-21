<?php 
//start the session if it's not started
if (session_id() == ''){
	session_start();
}
//check if login and correct authority
if (!isset($_SESSION['uid']) || $_SESSION['author'] != 2){
	header('location:../logout.php');
}else{
	include_once '../config.php';
$uid = $_GET['uid'];
if (isset($_POST['update'])){
	$name = $_POST['name'];
	$ic = $_POST['ic'];
	$author = $_POST['author'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];

	//echo 'Name: '.$name.' ;ic: '.$ic.' ;author: '.$author.' ;email: '.$email.' ;contact: '.$contact;
	$con->query("UPDATE user SET name='$name', ic='$ic', authority='$author', email='$email', contact_no='$contact' WHERE id=$uid;") or die($con->error);
	$_SESSION['msg'] = "User id $uid successfully updated.";
	$_SESSION['type'] = "success";
	header('location:userlist.php');
}

if (isset($_POST['delete'])){
	$con->query("DELETE FROM user WHERE id=$uid;") or die($con->error);
	$_SESSION['msg'] = "User id $uid successfully deleted.";
	$_SESSION['type'] = "danger";
	header('location:userlist.php');
}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit User</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\style.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			
		});
	</script>
	
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container-fluid theme-color">
		<h2>User Profile</h2>
		<hr>
		<?php 
			//get info for table			
			$result = $con->query("SELECT * FROM user WHERE id = $uid;");
			$row = $result->fetch_assoc();
			
		 ?>
		<table class="table table-bordered">
		  <tbody>
		  	<form method="post" action="">
		    <tr>
		      <th scope="row">Name</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="name" value="<?php echo $row['name']; ?>" autocomplete="off">
		      	</div>
		      	
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">IC</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="ic" value="<?php echo $row['ic']; ?>" autocomplete="off">
		      	</div>
		      	
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">Authority</th>
		      <td>
		      	<div class="input-fld">
		      	<select class = "form-control" type="text" name="author">
		      		<option value="1" <?php if ($row['authority']==1) echo "selected"; ?>>cutomer</option>
		      		<option value="2" <?php if ($row['authority']==2) echo "selected"; ?>>admin</option>
		      	</select>
		      	</div>
		      	
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">Email</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="email" value="<?php echo $row['email']; ?>" autocomplete="off">
				</div>
		
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">Contact No</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="contact" value="<?php echo $row['contact_no']; ?>" autocomplete="off">
		      	</div>
		      </td>
		    </tr>
		    
		    
		  </tbody>
		  <tfoot>
		  	<tr>
		  		<td></td>
		  	<td>
		  	<div class="form-group">
		  		<button type="submit" name="update" value="update" class="btn btn-primary">Update</button>
		  		<button type="submit" name="delete" value="delete" class="btn btn-danger">Delete</button>
		  	</div>
		  	</td>
		  	</tr>
		  </tfoot>
		  </form>
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