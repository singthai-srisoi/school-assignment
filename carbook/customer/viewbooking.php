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
?>

<!DOCTYPE html>
<html>
<head>
	<title>View Booking</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\style.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#show-booking-list').click(function(){
				console.log("loading booking list");
				$('#booking-list').load("booking-list.php");
			});
		});
	</script>
	<style type="text/css">
		.booking-details{
			border: none;
			background-color: transparent;
			padding: 20px;
			width: 100%;
		}
		.card{
			box-shadow: 0px 8px 39px 1px rgba(0,0,0,0.73);
			-webkit-box-shadow: 0px 8px 39px 1px rgba(0,0,0,0.73);
			-moz-box-shadow: 0px 8px 39px 1px rgba(0,0,0,0.73);
			width: 80%; margin-top: 30px;
			margin-bottom: 30px;
		}
	</style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container-fluid px-4">
		<!--show the latest booking-->
		
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

		 <div class="card">
		  <div class="card-body">
		  	<?php 
			$uid = $_SESSION['uid'];
			$date = date("Y-m-d");
			$result = $con->query("SELECT * FROM booking b, status s WHERE b.b_date >= '$date' AND b.status = s.id AND u_id = $uid ORDER BY b.b_date ASC LIMIT 1 ;") or die($con->error);
			if($result->num_rows > 0){
			$row = $result->fetch_array();
			/*
			echo '<pre>';
			print_r($row);
			echo '</pre>';
			*/
		 ?>
		    <h5 class="card-title">Booking details</h5>
		    <table class="booking-details">
		    	<tr>
		    		<th><label class="card-subtitle mb-2">Booking Car</label></th>
		    		<td><label class="card-subtitle mb-2"><?php echo $row['reg_no']; ?></label></td>
		    	</tr>
		    	<tr>
		    		<th><label class="card-subtitle mb-2">Booking Date</label></th>
		    		<td><label class="card-subtitle mb-2"><?php echo $row['b_date']; ?></label></td>
		    	</tr>
		    	<tr>
		    		<th><label class="card-subtitle mb-2">Return Date</label></th>
		    		<td><label class="card-subtitle mb-2"><?php echo $row['r_date']; ?></label></td>
		    	</tr>
		    	<tr>
		    		<th><label class="card-subtitle mb-2">Total Price</label></th>
		    		<td><label class="card-subtitle mb-2"><?php echo $row['total']; ?></label></td>
		    	</tr>
		    	<tr>
		    		<th><label class="card-subtitle mb-2">Request Status</label></th>
		    		<td><label class="card-subtitle mb-2"><?php echo $row['desc_']; ?></label></td>
		    	</tr>
		    </table>
		    <hr>
		    <?php 
		    	$reg_no = $row['reg_no'];
				$vehicle = $con->query("SELECT * FROM vehicle WHERE reg_no = '$reg_no';") or die($con->error);
				$car = $vehicle->fetch_assoc();
		     ?>
		    <h5 class="card-title">Car Details</h5>
		    <table class="booking-details">
		    	<tr>
		    		<th><label class="card-subtitle mb-2">Registration No</label></th>
		    		<td><label class="card-subtitle mb-2"><?php echo $car['reg_no']; ?></label></td>
		    	</tr>
		    	<tr>
		    		<th><label class="card-subtitle mb-2">Type</label></th>
		    		<td><label class="card-subtitle mb-2"><?php echo $car['type']; ?></label></td>
		    	</tr>
		    	<tr>
		    		<th><label class="card-subtitle mb-2">Model</label></th>
		    		<td><label class="card-subtitle mb-2"><?php echo $car['model']; ?></label></td>
		    	</tr>
		    	<tr>
		    		<th><label class="card-subtitle mb-2">No of seat</label></th>
		    		<td><label class="card-subtitle mb-2"><?php echo $car['seat']; ?></label></td>
		    	</tr>
		    </table>

		    <?php if ($row['status'] == 1){ ?>
		  <a href="modifybooking.php?b_id=<?php echo $row['0']; ?>&car=<?php echo $row['reg_no']; ?>" class="card-link">Modify Booking</a>
		<?php }else if ($row['status'] == 2){ ?>
			<a href="modifybooking.php?b_id=<?php echo $row['0']; ?>&status=taken" class="card-link">Taken Car</a>
		<?php }else if ($row['status'] == 4){ ?>
			<a href="modifybooking.php?b_id=<?php echo $row['0']; ?>&return=return" class="card-link">Return Car</a>
		<?php }}else{ ?>
			<h5 class="card-title">No booking found</h5>
		<?php } ?>
    		<a id="show-booking-list" href="#" class="card-link">Show others booking</a>
		  </div>
		  
		</div>

		
		    <div id="booking-list">
			
			</div>

		


	</div>

	<div class="ftr">
    	<footer><p>Singthai Srisoi Sdn Bhd</p></footer>
  	</div>
</body>
</html>
<?php } ?>