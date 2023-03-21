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
	$uid = $_SESSION['uid'];
	$b_id = $_GET['b_id'];
if (isset($_GET['status'])){
	//change status to taken
	$con->query("UPDATE booking SET status=4 WHERE id=$b_id;") or die($con->error);
	$_SESSION['msg'] = "Car has benn taken, enjoy your journey.";
	$_SESSION['type'] = "success";
	header('location:viewbooking.php');
}
if (isset($_GET['return'])){
	//change status to taken
	$con->query("UPDATE booking SET status=5 WHERE id=$b_id;") or die($con->error);
	$_SESSION['msg'] = "Car has returned, thank you";
	$_SESSION['type'] = "success";
	header('location:viewbooking.php');
}

	$reg_no = $_GET['car'];
	$result = $con->query("SELECT * FROM booking b WHERE id = $b_id") or die($con->error);
	$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Modify Booking</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\style.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			let date = new Date();

          	let currDate = date.toISOString().substring(0,10);

          	//console.log(currDate+' '+currTime);
          	
          	$("#currDate, #r-date").attr('min',currDate);
          	
          	let days = 1;
          	let price = <?php echo $row['total']; ?>;
          	let vehicle = $.parseJSON($('#select-car').val());

          	//update date and price
			let b_date = new Date($('#currDate').val());
          	let r_date = new Date($('#r-date').val());
          	let diff = new Date(r_date - b_date);
			days = diff/1000/60/60/24 + 1;
			$('#days').text(days);
			$('#t_price').text(price);

          	$('#select-car').change(function() {
          		vehicle = $.parseJSON($(this).val());
          		//console.log(vehicle.price);
          		price = vehicle.price*days;
          		$('#t_price').text(price);
          	});

          	$('#currDate, #r-date').change(function() {
          		//update number of booking date
          		//get date from input field
          		let b_date = new Date($('#currDate').val());
          		$("#r-date").attr('min',$('#currDate').val());
          		let r_date = new Date($('#r-date').val());

				//returns difference in milliseconds 
				let diff = new Date(r_date - b_date);

				// get days
				days = diff/1000/60/60/24 + 1;

				//if day < 0, set return date to current date
				if(days < 0){
					$("#r-date").val($('#currDate').val());
          			$("#r-date").attr('min',$('#currDate').val());
          			days = 1;
				}
				$('#days').text(days);
				price = vehicle.price*days;
          		$('#t_price').text(price);
          		//console.log("Booking Date : " + b_date + "; Return Date : " + r_date + "; Days : " +days);
          		
          	});

          	$("#update").click(function(){
          		//get data from input field
          		let update = $('#update').val();
          		let b_id = <?php echo $_GET['b_id'];?>;
          		let reg_no = vehicle.reg_no;
          		let b_date = $('#currDate').val();
          		let r_date = $('#r-date').val();
          		$("#msg").load("sendbook.php",{
          			update : update,
          			b_id : b_id,
          			reg_no : reg_no,
          			b_date : b_date,
          			r_date : r_date,
          			price : price
          		});
          	});

          	$("#delete").click(function(){
          		//get data from input field
          		let del = $('#delete').val();
          		let b_id = <?php echo $_GET['b_id'];?>;
          		$("#msg").load("sendbook.php",{
          			delete : del,
          			b_id : b_id
          		});
          	});

		});
	</script>
	<style type="text/css">
		
	</style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container-fluid px-4">
		<!--show the latest booking-->

		 <div class="card">
		  <div class="card-body">
		  	<p id="msg"></p>
		    <h5 class="card-title">Booking details</h5>
		    <hr>
		    	<form method="">
		    		<div class="form-group">
		    			<label>Booking ID</label>
		    			<input class="form-control" type="text" name="id" value="<?php echo $row['id']; ?>" disabled>
		    		</div>

		    		<div class="form-group">
		    		<p>booking date</p>
					<input class="form-control" type="date" name="b_date" id="currDate" value="<?php echo $row['b_date']; ?>">
					</div>

					<div class="form-group">
					<p>return date</p>
					<input class="form-control" type="date" name="r_date" id="r-date" value="<?php echo $row['r_date']; ?>">
					</div>

					<div class="form-group">
					<p>vehicle</p>
					<select class="form-control" id="select-car">
						<option value='{"reg_no":"-","price":"0"}'>-- choose a car --</option>
						<?php 
							//get car info
							$result = $con->query("SELECT * FROM vehicle;") or die($con->error);
							while ($row = $result->fetch_assoc()){
						 ?>
						<option value='{"reg_no":"<?php echo $row['reg_no']; ?>",
							"price":"<?php echo $row['price']; ?>"}' 
							<?php if ($row['reg_no'] == $reg_no){ echo 'selected'; } ?>>
							<?php echo $row['reg_no'].' '.$row['model']; ?>
						</option>
						<?php } ?>
					</select>
					</div>

					<div class="form-group">
					<p>Days : <b id="days">1</b></p>
					<p>Total price : RM<b id="t_price">-</b></p>
					</div>
					<div class="form-group">
					<button type="button" id="update" value="update" class="btn btn-primary">Update</button>
					<button type="button" id="delete" value="delete" class="btn btn-danger">Delete</button>
					</div>
		    	</form>
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