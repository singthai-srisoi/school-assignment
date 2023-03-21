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
$reg_no = $_GET['reg_no'];
if (isset($_POST['update'])){
	$reg_no_new = $_POST['reg_no'];
	$type = $_POST['type'];
	$model = $_POST['model'];
	$seat = $_POST['seat'];
	$price = $_POST['price'];

	//echo 'Name: '.$name.' ;ic: '.$ic.' ;author: '.$author.' ;email: '.$email.' ;contact: '.$contact;
	$con->query("UPDATE vehicle SET reg_no='$reg_no_new', type='$type', model='$model', seat='$seat', price='$price' WHERE reg_no='$reg_no';") or die($con->error);
	$_SESSION['msg'] = "Car $reg_no_new successfully updated.";
	$_SESSION['type'] = "success";
	header('location:carlist.php');
}

if (isset($_POST['delete'])){
	$con->query("DELETE FROM vehicle WHERE reg_no='$reg_no';") or die($con->error);
	$_SESSION['msg'] = "Car $reg_no successfully deleted.";
	$_SESSION['type'] = "danger";
	header('location:carlist.php');
}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Car Information</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\style.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.deleteimg').dblclick(function(){
				let imgid = $(this).find('.imageid').val();
				console.log(imgid);
				let go = confirm("Are you sure you want to delete this image?");

				if (go){
					window.location = 'deleteimg.php?imgid='+imgid+'&reg_no='+'<?php echo $reg_no; ?>';
				}
			});
		});
	</script>
	<style>
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
	<?php include 'navbar.php'; ?>
	<div class="container-fluid theme-color">
		<h2>Edit Car</h2>
		<hr>
		<div class="info d-flex flex-row">
			<?php 
				//load image from file
				$file = $con->query("SELECT * FROM image WHERE reg_no='$reg_no'; ");
				if ($file->num_rows > 0){
					while ($image = $file->fetch_assoc()){
			 ?>

			 <div class="deleteimg">
			 	<input type="hidden" class="imageid" value="<?php echo $image['id']; ?>">
			 	<img src="../img/<?php echo $image['file_name']; ?>">
			 </div>
			<?php }}else{ ?>
				<h5 class="card-title">No Image found</h5>
			<?php } ?>
		</div>
		<?php 
			//get info for table			
			$result = $con->query("SELECT * FROM vehicle WHERE reg_no = '$reg_no';");
			$row = $result->fetch_assoc();
			
		 ?>
		<table class="table table-bordered">
		  <tbody>
		  	<tr>
		  		<form action="photoUpdate.php?car=<?php echo $reg_no; ?>" method="post" enctype="multipart/form-data">
            	<th scope="row">Add Picture</th>
            	<td colspan="2">
            		*double click to delete picture*
                <input type="file"  multiple="true" name="picture" class="form-control">
            	<input type="submit" value="Submit" class="btn btn-light"/>
            	</td>
        </form>
		  	</tr>
		  	<form method="post" action="">
		    <tr>
		      <th scope="row">Registration Number</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="reg_no" value="<?php echo $row['reg_no']; ?>" autocomplete="off">
		      	</div>
		      	
		      </td> 
		    </tr>
		    <tr>
		      <th scope="row">Type</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="type" value="<?php echo $row['type']; ?>" autocomplete="off">
		      	</div>
		      	
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">Model</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="model" value="<?php echo $row['model']; ?>" autocomplete="off">
		      	</div>
		      	
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">price</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="number" name="price" value="<?php echo $row['price']; ?>" autocomplete="off">
				</div>
		
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">seat</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="text" name="seat" value="<?php echo $row['seat']; ?>" autocomplete="off">
		      	</div>
		      </td>
		    </tr>

		    <tr>
		      <th scope="row">Register Date</th>
		      <td>
		      	<div class="input-fld">
		      	<input class = "form-control" type="date" name="reg_date" value="<?php echo $row['reg_date']; ?>" disabled>
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

	</div>


	<div class="ftr">
    	<footer><p>Singthai Srisoi Sdn Bhd</p></footer>
  	</div>
</body>
</html>
<?php } ?>