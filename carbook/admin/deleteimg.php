<?php 
include_once '../config.php';
$reg_no = $_GET['reg_no'];
$id = $_GET['imgid'];
$con->query("DELETE FROM image WHERE id=$id") or die($con->error);

header('location:editcar.php?reg_no='.$reg_no);

 ?>