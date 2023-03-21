<?php 
include_once 'config.php';

if (isset($_POST['submit'])){
	$ic = $_POST['ic'];
	//echo $ic.$pwd;

	//check account exist
	$result = $con->query("SELECT * FROM user WHERE ic = '$ic' OR email = '$ic';") or die($con->error);
	if ($result->num_rows == 0){
		echo "<script>alert('Invalid email or ic, please try again');
			window.location.href = 'login.php';</script>";
	}else{
		/*
		echo "<script>alert('valid email or ic');
			window.location.href = 'login.php';</script>";*/
		//check password
		$pwd = $_POST['pwd'];
		$pwd = hash("sha256", $pwd);

		$result = $con->query("SELECT * FROM user WHERE ic = '$ic';") or die($con->error);
		$row = $result->fetch_assoc();
		/*
		echo '<pre>';
		print_r($row);
		echo 'Entered pwd : '.$pwd;
		echo '</pre>';
		*/
		//sub string
		$pwd = substr($pwd, 0,30);
		$row['password'] = substr($row['password'], 0,30);
		$cmp = ($pwd == $row['password'])?true : false;
		echo $cmp;
		if ($cmp){
			//if password compared correct, set session and redirect to it site
			session_start();
			$_SESSION['uid'] = $row['id'];
			$_SESSION['author'] = $row['authority'];
			echo 'running here';
			
			if ($_SESSION['author'] == 1){
				header('location: customer/');
			}else if ($_SESSION['author'] == 2){
				header('location: admin/');
			}

			//echo $_SESSION['uid'].$_SESSION['author'];
		}else{
			echo ' here running';
			echo "<script>alert('Incorrect password, please try again');
			window.location.href = 'login.php';</script>";
		}
	}
}
 ?>
