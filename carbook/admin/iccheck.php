<?php 
include_once '../config.php';

//echo $_POST['ic'];
//check if user ic exist in database

$ic = $_POST['ic'];
if ($ic != ""){
$result = $con->query("SELECT * FROM user WHERE ic = $ic;") or die($con->error);
//echo 'loading';
if ($result->num_rows > 0){
	echo 'IC number exist';
}
}

 ?>