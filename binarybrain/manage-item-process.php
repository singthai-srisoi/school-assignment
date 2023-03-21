<?php 
include_once('includes/config.php');

session_start();
$q_id = $_SESSION['q_id'];

if (isset($_GET['delete'])){
	$id = $_GET['delete'];
	$con->query("DELETE FROM item WHERE i_id=$id") or die($mysqli->error);

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";
	header("location: add-item.php");
}
?>
