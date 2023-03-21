<?php  
include_once '../config.php';
  //sleep(5);// 让服务器休息一会
  echo '<pre>';
  print_r($_FILES);
  echo '</pre>';
  // 第一个参数是 规定要移动的文件
  // 第二个参数是 规定文件的新位置

  $reg_no = $_GET['car'];
  //add new image to db
  $con->query("INSERT INTO `image` (`id`, `reg_no`) VALUES (NULL, '$reg_no')");

  //make file name combining reg_no and image id
  $result = $con->query("SELECT * FROM image WHERE reg_no='$reg_no' ORDER BY id DESC LIMIT 1; ") or die($con->error);
  $row = $result->fetch_assoc();
  $id = $row['id'];
  $car = $row['reg_no'];

  echo '<pre>';
  print_r($row);
  echo '</pre>';

  $filetype = substr($_FILES['picture']['name'], -4);
  $filename = $id.$car.$filetype;
  $_FILES['picture']['name'] = $filename;
  //update file name 
  $con->query("UPDATE image SET file_name='$filename' WHERE id=$id; ");
  move_uploaded_file($_FILES['picture']['tmp_name'], '../img/'.$_FILES['picture']['name']);
  header('location:editcar.php?reg_no='.$reg_no);
?>