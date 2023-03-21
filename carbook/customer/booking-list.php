<?php 
//start the session if it's not started
if (session_id() == ''){
	session_start();
}
//check if login and correct authority
if (!isset($_SESSION['uid']) || $_SESSION['author'] != 1){
	header('location:../logout.php');
}else{
	include_once '../config.php';

	$uid = $_SESSION['uid'];
	$date = date("Y-m-d");
	$result = $con->query("SELECT * FROM booking b, status s WHERE b.status = s.id AND u_id = $uid;") or die($con->error);
	

}
?>
<div class="card">
	<div class="card-body">
	<h5 class="card-title">Booking List</h5>
	
	<table class="booking-details">
		<tr>
			<th>id</th>
			<th>car</th>
			<th>booking date</th>
			<th>return date</th>
			<th>total price</th>
			<th>status</th>
			<th>action</th>
		</tr>
		<?php 
			if ($result->num_rows > 0){
			while ($row = $result->fetch_array()){ 
		?>

		<tr>
			<th><?php echo $row['0']; ?></th>
			<td><?php echo $row['reg_no']; ?></td>
			<td><?php echo $row['b_date']; ?></td>
			<td><?php echo $row['r_date']; ?></td>
			<td><?php echo $row['total'] ?></td>
			<td><?php echo $row['desc_']; ?></td>
			<td>
				<?php if ($row['status'] == 1) { ?>
					<a href="modifybooking.php?b_id=<?php echo $row['0']; ?>&car=<?php echo $row['reg_no']; ?>" class="card-link">Modify</a>
				<?php }else{ ?>
					--
				<?php } ?>
			</td>
		</tr>

		<?php }}else{ ?>
			<h5>No record found</h5>
		<?php } ?>

	</table>

	</div>
</div>