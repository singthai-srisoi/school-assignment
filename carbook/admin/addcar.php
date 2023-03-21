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
	$reg_no_new = $_POST['reg_no'];
	$type = $_POST['type'];
	$model = $_POST['model'];
	$seat = $_POST['seat'];
	$price = $_POST['price'];

	//echo 'Name: '.$name.' ;ic: '.$ic.' ;author: '.$author.' ;email: '.$email.' ;contact: '.$contact;
	
	$con->query("INSERT INTO vehicle (reg_no, type, model, seat, price, reg_date) VALUES ('$reg_no_new', '$type', '$model', $seat, $price, current_timestamp());") or die($con->error);
	$_SESSION['msg'] = "Car $reg_no_new successfully added.";
	$_SESSION['type'] = "success";
	header('location:carlist.php');
}

	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Car</title>
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
		<h2>Add car</h2>
		<hr>
		<table class="table table-bordered">
		  <tbody>
		  	<form method="post" action="">
		    <tr>
		      <th scope="row">Registration Number</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="reg_no" >
		      	</div>
		      	
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">Type</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="type" >
		      	</div>
		      	
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">Model</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="model" >
		      	</div>
		      	
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">price</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="number" name="price" >
				</div>
		
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">seat</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="seat" >
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