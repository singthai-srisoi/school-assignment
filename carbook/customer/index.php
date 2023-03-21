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
	<title>Main Page</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\style.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			let date = new Date();

          	let currDate = date.toISOString().substring(0,10);

          	//console.log(currDate+' '+currTime);
          	$("#currDate, #r-date").val(currDate);
          	$("#currDate, #r-date").attr('min',currDate);

          	let days = 1;
          	let price = 0;
          	let vehicle = {};
          	$('#select-car').change(function() {
          		vehicle = $.parseJSON($(this).val());
          		//console.log(vehicle.price);
          		price = vehicle.price*days;
          		$('#t_price').text(price);
          		let car = vehicle.reg_no;
          		$('#car-image').load("loadimage.php",{car : car});
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

          	$("#submit").click(function(){
          		//get data from input field
          		let submit = "submit";
          		let customer = <?php echo $_SESSION['uid'];?>;
          		let reg_no = vehicle.reg_no;
          		let b_date = $('#currDate').val();
          		let r_date = $('#r-date').val();
          		$("#msg").load("sendbook.php",{
          			submit : submit,
          			customer : customer,
          			reg_no : reg_no,
          			b_date : b_date,
          			r_date : r_date,
          			price : price
          		});
          	})

		});
	</script>
	<style>
		.picture{
			max-height: initial;
			display: flex;
			flex-direction: column;
			flex-wrap: nowrap;
			overflow: auto;
		}
		#car-image div{
			height: 280px;
			width: 280px;
			margin: 20px;
			display: flex;
			flex: 0 0 auto;
			overflow: auto;
		}
		#car-image img{
			height: 280px;
			width: 280px;
			margin: 0;
			padding: 0;
		}
	</style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container-fluid px-4">
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
	
	<div class="d-flex flex-row justify-content-around">
		<div class="picture card d-flex flex-column" id="car-image">

		</div>
		<div class="b-form card">
			<div class="card-body">
			<p id="msg"></p>
			<form class="form-group">
				<h3>Book a car</h3>
				<hr>

				<p>booking date</p>
				<input class="form-control" type="date" name="b_date" id="currDate">
				<p>return date</p>
				<input class="form-control" type="date" name="r_date" id="r-date">
				<p>vehicle</p>
				<select class="form-control" id="select-car">
					<option value='{"reg_no":"-","price":"0"}'>-- choose a car --</option>
					<?php 
						//get car info
						$result = $con->query("SELECT * FROM vehicle WHERE reg_no NOT IN 
												(SELECT DISTINCT(reg_no) FROM booking WHERE status IN (1,2,4,6));") or die($con->error); 
						while ($row = $result->fetch_assoc()){
					 ?>
					<option value='{"reg_no":"<?php echo $row['reg_no']; ?>",
						"price":"<?php echo $row['price']; ?>"}'>
						<!--<div class="s-price" style="display: hidden;"><?php echo $row['price']; ?></div>-->
						<?php echo $row['reg_no'].' '.$row['model']; ?>
					</option>
					<?php } ?>
				</select>
				<p>Days : <b id="days">1</b></p>
				<p>Total price : RM<b id="t_price">-</b></p>
				<button type="button" id="submit" value="submit" class="btn btn-primary">Book</button>
			</form>
		</div>
	</div>
	</div>
	<div class="ftr">
    	<footer><p>Singthai Srisoi Sdn Bhd</p></footer>
  	</div>
</body>
</html>
<?php } ?>