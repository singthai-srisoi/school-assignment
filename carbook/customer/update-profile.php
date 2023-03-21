<?php 
//start the session if it's not started
if (session_id() == ''){
	session_start();
}
//check if login and correct authority
if (!isset($_SESSION['uid']) && $_SESSION['author'] != 1){
	header('location:../logout.php');
}else{
	include_once '../config.php';

	$uid = $_SESSION['uid'];
	$name = $_POST['name'];
	$ic = $_POST['ic'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];

	$con->query("UPDATE user SET name = '$name', ic = '$ic', email = '$email', contact_no = '$contact' WHERE id = $uid; ") or die($con->error);


?>