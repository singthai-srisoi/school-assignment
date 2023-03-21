<?php 
include_once '../config.php';
if (session_id() == ''){
	session_start();
}

if (isset($_POST['update'])){
	$b_id = $_POST['b_id'];
	$b_date = $_POST['b_date'];
	$r_date = $_POST['r_date'];
	$price = $_POST['price'];
	$reg_no = $_POST['reg_no'];
	$con->query("UPDATE booking SET reg_no = '$reg_no', b_date = '$b_date', r_date = '$r_date', total = $price WHERE id = $b_id; ") or die($con->error);

	//set session
	$_SESSION['msg'] = "Booking id $b_id successfully updated.";
	$_SESSION['type'] = "success";
	echo 'successfully update!';
	echo '<script>location.href = "bookinglist.php";</script>';
}

if (isset($_POST['delete'])){
	$b_id = $_POST['b_id'];
	$con->query("DELETE FROM booking WHERE id = $b_id;") or die($con->error);
	$_SESSION['msg'] = "Booking id $b_id successfully deleted.";
	$_SESSION['type'] = "danger";
	echo 'successfully deleted!';
	echo '<script>location.href = "bookinglist.php";</script>';
}

if (isset($_POST['submit'])){
if (!isset($_POST['reg_no'])){
	echo 'please choose a car from the list.';
}else{
	$b_date = $_POST['b_date'];
	$r_date = $_POST['r_date'];
	$price = $_POST['price'];
	$customer = $_POST['customer'];
	$reg_no = $_POST['reg_no'];
	$con->query("INSERT INTO `booking` (`id`, `u_id`, `reg_no`, `b_date`, `r_date`, `total`, `status`) 
						VALUES (NULL, $customer, '$reg_no', '$b_date', '$r_date', '$price', '1')") or die($con->error);
	echo 'Booking has sent. PLease check on your list.';
	$_SESSION['msg'] = "Booking successfully sent.";
	$_SESSION['type'] = "success";
	echo 'successfully update!';
	echo '<script>location.href = "index.php";</script>';
}
}

 ?>
