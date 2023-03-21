<?php 
include_once 'config.php';

if (isset($_POST['submit'])){
	//get value from form
	$ic = $_POST['ic'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$authority = 1;
	$pwd = $_POST['pwd'];
	$pwd = hash("sha256", $pwd);
	//echo $name.$email.$contact.$authority.$pwd.$r_pwd;

	//insert into database
	$con->query("INSERT INTO user (id, ic, name, email, contact_no, authority, password) VALUES (NULL, '$ic' ,'$name', '$email', '$contact', '$authority', '$pwd');") or die($con->error);
	header('location:login.php');
}

?>