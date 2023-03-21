<?php 
include_once('includes/config.php');

session_start();
$q_id = $_GET['qid'];

//if add is set, update table
if(isset($_POST['i_add'])){
$i_name = $_POST['i_name'];
$i_price = $_POST['i_price'];
$i_quantity = $_POST['i_quantity'];
$i_add = $_POST['i_add'];
$con->query("INSERT INTO item (i_id, i_name, i_price, i_quantity, q_id) VALUES (NULL, '$i_name', '$i_price', '$i_quantity', $q_id);") or die($con->error);
//echo "<script>alert('Adding');</script>";
//tetsing if get the variable
//echo $i_name.$i_price.$i_quantity.$i_add.$q_id;
$_SESSION['message'] = "Record has been added";
        $_SESSION['msg_type'] = "success";
}

if (isset($_POST['delete'])){
$id = $_POST['i_id'];
$con->query("DELETE FROM item WHERE i_id=$id") or die($mysqli->error);
$_SESSION['message'] = "Record has been deleted!";
      $_SESSION['msg_type'] = "danger";
}
if (isset($_POST['save'])){
$id = $_POST['i_id'];
$i_name = $_POST['i_name'];
$i_price = $_POST['i_price'];
$i_quantity = $_POST['i_quantity'];
$con->query("UPDATE item SET i_name='$i_name', i_price=$i_price, i_quantity=$i_quantity WHERE i_id=$id;") or die($con->error);
$_SESSION['message'] = "Record has been modified!";
      $_SESSION['msg_type'] = "warning";
}
//print item from table
$result = $con->query("SELECT * FROM item WHERE q_id=$q_id;") or die($con->error);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
        <script>
        	      $('form button').on("click",function(e){
				    e.preventDefault();
				});
        	$(document).ready(function(){
        		//enable input field when update clicked
        		$(".edit").click(function(){
        			let input_field = $(this).closest('tr').find('input').prop('disabled',false);
        			$(this).closest('tr').find('.save').show();
        			$(this).hide();
        		});
        		//change property of button
        		//href to manage-item-process when update click again
        	});
        </script>
    </head>
    <body>
<div class="container">
	<?php if (isset($_SESSION['message'])):?>
                <div class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php 
                  echo $_SESSION['message'];
                  unset($_SESSION['message']);
                 ?>
                </div>
              <?php endif ?>
    	<table class="table">
<thead>
    <tr>
    <th>#</th>
	<th>Item</th>
	<th>Price(RM)</th>
	<th>Quantity</th>
	<th>Amount</th>
	<th colspan="2">Action</th>
	</tr>
</thead>

<?php 
$i = 1;
$total = 0.0;
//floor($row['i_price']*1000)/1000
//number_format((float) $row['i_price'], 2, '.', '');
while ($row = $result->fetch_assoc()){
?>

<tr>
	<form method="post" action="">
	<input type="hidden" name="i_id" value="<?php echo $row['i_id']; ?>" class="i_id" required>
	<td><?php echo $i; ?></td>
	<td><input type="text" name="i_name" value="<?php echo $row['i_name']; ?>" disabled></td>
	<td>
		<input type="number" step="0.01" name="i_price" value="<?php echo number_format((float) $row['i_price'], 2, '.', ''); ?>" disabled required>
	</td>
	<td><input type="number" name="i_quantity" value="<?php echo $row['i_quantity']; ?>" disabled required></td>
	<td><?php 
	$amt = $row['i_quantity']*$row['i_price'];
	$total += $amt;
	echo number_format((float) $amt, 2, '.', '');
	?></td>
	<td>
		<button class="save" name="save" style="display: none;" value="save" type="submit">Save</button>
		<input class="edit" type="button" value="Edit">
		<button name="delete" value="delete">Delete</button>
	</td>
	</form>
</tr>

<?php 
$i = $i +1;}if ($result->num_rows == 0){
?>
<h4>No record found.</h4>
<?php } ?>
<tfoot>
	<tr>
		<th id="total" colspan="4">Total :</th>
		<td><?php echo number_format((float) $total, 2, '.', ''); ?></td>
	</tr>
</tfoot>
<table>
	<tfoot>
     <form method="post" action="">
    <tr>Item : <input type="text" name="i_name" placeholder="Enter item name" required="true" autocomplete="off"></tr>
    <tr>Price : <input type="number" step="0.01" name="i_price" required="true" placeholder="RM" autocomplete="off"></tr>
    <tr>Quantity : <input type="number" name="i_quantity" value="1" required="true" autocomplete="off"></tr>
    <input type="hidden" name="q_id" value="<?php echo $qid; ?>">
    <tfoot>
    <tr>
    <button name="i_add" value="add">Add</button>
    </tr>
    </form>
    </tfoot>
   </table>
</table>
<a href="add-item.php?qid=<?php echo $q_id; ?>" class="btn btn-primary">Done</a>
</div>
</body>