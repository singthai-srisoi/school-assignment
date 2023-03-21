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

if (isset($_POST['add'])){
	$ic = $_POST['ic'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$author = $_POST['author'];
	$pwd = $_POST['password'];
	$cpwd = $_POST['c_password'];

	if ($pwd == $cpwd){
		//hash password
		$pwd = hash("sha256", $pwd);
	
	$con->query("INSERT INTO `user` (`id`, `ic`, `name`, `email`, `contact_no`, `reg_date`, `authority`, `password`) 
		VALUES (NULL, '$ic', '$name', '$email', '$contact', current_timestamp(), '$author', '$pwd');") or die($con->error);
	$_SESSION['msg'] = "User $name successfully added.";
	$_SESSION['type'] = "success";
	header('location:userlist.php');
	}else{
		$_SESSION['msg'] = "Password in identocal";
		$_SESSION['type'] = "warning";
	}
}

	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\style.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#cpwd').keyup(function(){
				let pwd = $('#pwd').val();
				let cpwd = $(this).val();

				if(pwd !== cpwd){
					$('#msg').text("password not identical!");
				}else{
					$('#msg').text("");
				}
			});

			$('#ic').keyup(function(){
				let ic = $(this).val();
				$('#ic-msg').load("iccheck.php",{ic : ic});
			});
		});
	</script>
	
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container-fluid theme-color">
		<?php 
            if (isset($_SESSION['msg'])):
        ?>
            <div class="alert alert-<?=$_SESSION['type']?>">
        <?php 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        ?>
        </div>
		<?php endif ?>
		<h2>Add User</h2>
		<hr>
		<table class="table table-bordered">
		  <tbody>
		  	<form method="post" action="">
		    <tr>
		      <th scope="row">ic</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="ic" id="ic">
		      	<p id="ic-msg" style="color: red;"></p>
		      	</div>
		      	
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">name</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="name" >
		      	</div>
		      	
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">email</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="email" >
		      	</div>
		      	
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">contact</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="number" name="contact" >
				</div>
		
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">Authority</th>
		      <td>
		      	<div class="input-fld">
		      	<select class="form-control" name="author">
		      		<option value="">--</option>
		      		<option value="1">customer</option>
		      		<option value="2">admin</option>
		      	</select>
		      	</div>
		      </td>
		    </tr>

		    <tr>
		      <th scope="row">password</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="password" name="password" id="pwd">
				</div>
		
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">confirm password</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="password" name="c_password" id="cpwd">
		      	<p id="msg" style="color: red;"></p>
				</div>
				
		      </td>
		    </tr>
		    	    
		  </tbody>
		  <tfoot>
		  	<tr>
		  		<td></td>
		  	<td>
		  	<div class="form-group">
		  		<button type="submit" name="add" value="add" class="btn btn-primary">Add</button>
		  	</div>
		  	</td>
		  	</tr>
		  </tfoot>
		  </form>
		</table>

	</div>


	<div class="ftr">
    	<footer><p>Singthai Srisoi Sdn Bhd</p></footer>
  	</div>
</body>
</html>
<?php } ?>