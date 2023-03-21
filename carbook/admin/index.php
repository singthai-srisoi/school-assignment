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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			
		});
	</script>
	<style type="text/css">
		.info{
			background-color: #c180ff;
			height: 350px;
			width: 100%;
  			border-radius: 5px;
  			margin-top: 20px;

  			display: flex;
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
		p {
			padding: 0;
			margin: 0;
		}
	</style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container-fluid px-4">
		<div class="d-flex flex-row info">
			<div class="card alert alert-success">
			  <h4 class="alert-heading">Today's Booking</h4>
			  <?php 
			  		$today = date("Y-m-d");
			  		$month = substr($today,5,2);

			  		//find total booking this month
			  		$booking = $con->query("SELECT * FROM booking WHERE month(b_date)='$month' ;") or die($con->error);
			  		$totalbooking = $booking->num_rows;

			  		//find today's booking
			  		$booking = $con->query("SELECT * FROM booking WHERE b_date = '$today' ;") or die($con->error);
			  		$todaybooking = $booking->num_rows;

			  		//find today's booking that recieved
			  		$booking = $con->query("SELECT * FROM booking WHERE b_date = '$today' AND status = 1;") or die($con->error);
			  		$recieved = $booking->num_rows;

			  		//find today approved booking
			  		$booking = $con->query("SELECT * FROM booking WHERE b_date = '$today' AND status = 2;") or die($con->error);
			  		$approved = $booking->num_rows;

			  		//find today rejected booking
			  		$booking = $con->query("SELECT * FROM booking WHERE b_date = '$today' AND status = 3;") or die($con->error);
			  		$rejected = $booking->num_rows;

			   ?>
			  <p>Today's Booking : <a href="bookinglist.php?filter=<?php echo $today; ?>" class="badge badge-success">
			  	<?php echo $todaybooking; ?>
			  </a></p>
			  <p>Recieved's Booking : <a href="bookinglist.php?filter=<?php echo 'recieved'; ?>" class="badge badge-success">
			  	<?php echo $recieved; ?>
			  </a></p>
			  <p>Approved's Booking : <a href="bookinglist.php?filter=<?php echo 'approved'; ?>" class="badge badge-success">
			  	<?php echo $approved; ?>
			  </a></p>
			  <p>Rejected's Booking : <a href="bookinglist.php?filter=<?php echo 'rejected'; ?>" class="badge badge-success">
			  	<?php echo $rejected; ?>
			  </a></p>
			  <hr>
			  <p class="mb-0">Total Booking this month : <a href="bookinglist.php?filter=<?php echo '-'.$month.'-'; ?>" class="badge badge-success">
			  	<?php echo $totalbooking; ?>
			  </a></p>
			</div>

			<div class="card alert alert-primary">
			  <h4 class="alert-heading">Customer</h4>
			  <?php 
			  	//customer that booking for today
			  	$customer = $con->query("SELECT DISTINCT(s.id) FROM user s, booking b WHERE s.id = b.u_id AND b_date = '$today'; ") or die($con->error);
			  	$usertoday = $customer->num_rows;

			  	//customer that register today
			  	$customer = $con->query("SELECT * FROM user WHERE reg_date = '$today'; ") or die($con->error);
			  	$regtoday = $customer->num_rows;

			  	//total user
			  	$customer = $con->query("SELECT * FROM user;");
			  	$totaluser = $customer->num_rows;
			   ?>
			  <p>Today booking Customer : <a href="bookinglist.php?filter=<?php echo $today; ?>" class="badge badge-primary">
			  	<?php echo $usertoday; ?>
			  </a></p>
			  <p>New User : <a href="userlist.php?filter=<?php echo $today; ?>" class="badge badge-primary">
			  	<?php echo $regtoday; ?>
			  </a></p>
			  <hr>
			  <p class="mb-0">Total Customer : <a href="userlist.php" class="badge badge-primary">
			  	<?php echo $totaluser; ?>
			  </a></p>
			</div>

			<div class="card alert alert-warning">
			  <h4 class="alert-heading">Car</h4>
			  <?php 
			  	//find car that buy today
			  	$car = $con->query("SELECT * FROM vehicle WHERE reg_date = '$today' ;");
			  	$newcar = $car->num_rows;

			  	//find car that lent out
			  	$car = $con->query("SELECT * FROM vehicle WHERE reg_no IN 
									(SELECT DISTINCT(reg_no) FROM booking WHERE status IN (1,2,4,6));") 
			  						or die($con->error);
			  	$lentcar = $car->num_rows;

			  	//find car that available
			  	$car = $con->query("SELECT * FROM vehicle WHERE reg_no NOT IN 
									(SELECT DISTINCT(reg_no) FROM booking WHERE status IN (1,2,4,6));") or die($con->error);
			  	$availablecar = $car->num_rows;

			  	//find total car
			  	$car = $con->query("SELECT * FROM vehicle;");
			  	$totalcar = $car->num_rows;
			   ?>
			   <p>New car : <a href="carlist.php?filter=<?php echo $today; ?>" class="badge badge-warning">
			   	<?php echo $newcar; ?>
			   </a></p>
			  <p>Car that booked : <a href="bookinglist.php?filter=<?php echo 'taken'; ?>" class="badge badge-warning">
			  	<?php echo $lentcar; ?>
			  </a></p>
			  <p>Available car : <a href="carlist.php" class="badge badge-warning">
			  	<?php echo $availablecar; ?>
			  </a></p>
			  <hr>
			  <p class="mb-0">Total car : <a href="carlist.php" class="badge badge-warning">
			  	<?php echo $totalcar; ?>
			  </a></p>
			</div>

		</div>
	</div>
	</div>
	<div class="ftr">
    	<footer><p>Singthai Srisoi Sdn Bhd</p></footer>
  	</div>
</body>
</html>
<?php } ?>