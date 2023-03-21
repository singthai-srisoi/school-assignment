<?php 
//start the session if it's not started
if (session_id() == ''){
	session_start();
}
//check if login and correct authority
if (!isset($_SESSION['uid']) || $_SESSION['author'] != 2){
	header('location:../logout.php');
}else{
	include_once '../config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Car List</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
            	//console.log("Hello world!"); 
			  $("#search").keyup(function() {
			    let value = $(this).val().toLowerCase();
			    //console.log(value);
			    $("#myTable tr").filter(function() {
			      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			    });
			  });
			  $('#select').change(function() {
			    //$('table').show();
			    let value = $(this).val().toLowerCase();
			    $("#myTable tr").filter(function() {
			      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			    });

			  });
			});
	</script>
	<style type="text/css">
		
	</style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container container-fluid px-4">
		<?php 
            if (isset($_SESSION['msg'])):
        ?>
            <div class="alert alert-<?=$_SESSION['type']?>">
        <?php 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        ?>
        </div>
		<?php endif ?>
		<h2>Car list</h2>
		<hr>
		<div class="d-flex justify-content-end">
            <input type="text" id="search" placeholder="Search" style="margin-right: 5px;" class="form-control">
            <select id="select" class="form-control">
                <option value="">-- Filter --</option>
                <option value="<?php $today = date("Y-m-d");echo $today; ?>">today</option>
                <option value="-01-">January</option>
                <option value="-02-">Febuary</option>
                <option value="-03-">March</option>
                <option value="-04-">April</option>
                <option value="-05-">May</option>
                <option value="-06-">June</option>
                <option value="-07-">July</option>
                <option value="-08-">August</option>
                <option value="-09-">Septemper</option>
                <option value="-10-">October</option>
                <option value="-11-">November</option>
                <option value="-12-">December</option>
            </select>
        </div>
		<table class="table table-sm">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">reg_no</th>
		      <th scope="col">type</th>
		      <th scope="col">model</th>
		      <th scope="col">seat</th>
		      <th scope="col">register date</th>
		      <th scope="col">price</th>
		      <th scope="col">action</th>
		    </tr>
		  </thead>
		  <tbody id="myTable">
		  	<?php 
		  		//fetch user from db
		  		$result = $con->query("SELECT * FROM vehicle;") or die($con->error);
		  		if($result->num_rows > 0){
		  			$count = 1;
		  		while ($row = $result->fetch_assoc()) {
		  	 ?>
		    <tr>
		      <th scope="row"><?php echo $count++; ?></th>
		      <td><?php echo $row['reg_no']; ?></td>
		      <td><?php echo $row['type']; ?></td>
		      <td><?php echo $row['model']; ?></td>
		      <td><?php echo $row['seat']; ?></td>
		      <td><?php echo $row['reg_date']; ?></td>
		      <td><?php echo $row['price']; ?></td>
		      <td><a href="editcar.php?reg_no=<?php echo $row['reg_no']; ?>" class="btn btn-success">Manage</a></td>
		    </tr>
		<?php }}else{ ?>
			<h5>No record found</h5>
		<?php } ?>
		  </tbody>
		  <tfoot>
		  	<tr>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td><a href="addcar.php" class="btn btn-primary">Add Car</a></td>

		  	</tr>
		  </tfoot>
		</table>
		
	</div>
	<div class="ftr">
    	<footer><p>Singthai Srisoi Sdn Bhd</p></footer>
  	</div>
</body>
</html>
<?php } ?>