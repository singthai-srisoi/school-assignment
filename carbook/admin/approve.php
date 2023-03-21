<?php 
include '../config.php';
if (session_id() == ''){
	session_start();
}

if (isset($_GET['approve'])){
	$b_id = $_GET['b_id'];

	$con->query("UPDATE booking SET status=2 WHERE id=$b_id;") or die($con->error);
	$_SESSION['msg'] = "Booking $b_id approved";
	$_SESSION['type'] = "success";
	header('location:bookinglist.php');
}
if (isset($_GET['reject'])){
	$b_id = $_GET['b_id'];

	$con->query("UPDATE booking SET status=3 WHERE id=$b_id;") or die($con->error);
	$_SESSION['msg'] = "Booking $b_id rejected";
	$_SESSION['type'] = "warning";
	header('location:bookinglist.php');
}
if (isset($_GET['taken'])){
	$b_id = $_GET['b_id'];

	$con->query("UPDATE booking SET status=4 WHERE id=$b_id;") or die($con->error);
	$_SESSION['msg'] = "Car in booking $b_id taken";
	$_SESSION['type'] = "warning";
	header('location:bookinglist.php');
}
if (isset($_GET['done'])){
	$b_id = $_GET['b_id'];

	$con->query("UPDATE booking SET status=5 WHERE id=$b_id;") or die($con->error);
	$_SESSION['msg'] = "Booking done";
	$_SESSION['type'] = "warning";
	header('location:bookinglist.php');
}

 ?>