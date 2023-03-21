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
	<title>User List</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
            	//console.log("Hello world!");
            	let value = $('#search').val().toLowerCase();
			    //console.log(value);
			    $("#myTable tr").filter(function() {
			      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			    });
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
		<h2>User list</h2>
		<hr>
		<div class="d-flex justify-content-end">
            <input type="text" id="search" placeholder="Search" style="margin-right: 5px;" class="form-control"
            value="<?php if(isset($_GET['filter'])) echo $_GET['filter']; ?>">
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
		      <th scope="col">id</th>
		      <th scope="col">Name</th>
		      <th scope="col">ic</th>
		      <th scope="col">email</th>
		      <th scope="col">contact</th>
		      <th scope="col">register date</th>
		      <th scope="col">action</th>
		    </tr>
		  </thead>
		  <tbody id="myTable">
		  	<?php 
		  		//fetch user from db
		  		$result = $con->query("SELECT * FROM user;") or die($con->error);
		  		if($result->num_rows > 0){
		  		while ($row = $result->fetch_assoc()) {
		  	 ?>
		    <tr>
		      <th scope="row"><?php echo $row['id']; ?></th>
		      <td><?php echo $row['name']; ?></td>
		      <td><?php echo $row['ic']; ?></td>
		      <td><?php echo $row['email']; ?></td>
		      <td><?php echo $row['contact_no']; ?></td>
		      <td><?php echo $row['reg_date']; ?></td>
		      <td><a href="edituser.php?uid=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a></td>
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
		  		<td><a href="adduser.php" class="btn btn-primary">Add User</a></td>
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