<?php 

session_start();
include('includes/config.php');
$id = 0;

if (isset($_GET['delete'])){
	$id = $_GET['delete'];
	$con->query("DELETE FROM feedback WHERE f_id=$id") or die($mysqli->error);

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";
	header("location: feedback_content_e.php");
} 

 ?>