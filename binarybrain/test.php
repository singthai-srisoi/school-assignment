<?php session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
//Code for Updation 
if(isset($_POST['update']))
{
	$num=$_GET['num'];
    $uid=$_GET['uid']; 
    $service=$_POST['service'];
	$quantity=$_POST['quantity'];
    $price=$_POST['price'];
	$amount=$_POST['amount'];
    $msg=mysqli_query($con,"update quotation set service='$service', quantity='$quantity', price='$price', amount='$amount' where uid='$uid'");
    
	for($a=0;$a<count($_POST["service"]);$a++)
	{
		$sql="INSERT INTO quotation(service,quantity,price,amount) VALUE ('".$_POST["service"][$a]."','".$_POST["quantity"][$a]."','".$_POST["price"][$a]."','".$_POST["amount"][$a]."')";
		$mysqli_query($conn,$sql);
	}


$sql = "SELECT * FROM quotation WHERE qid = $qid ";

$msg=mysqli_query($con,$sql);
if(mysqli_num_rows($msg) > 0)
{         
$row=mysqli_fetch_array($msg); 

$row_id=$row['num'];

}
else
{
$row_id="0000" ;
}



if($msg)
{
    echo "<script>alert('Quotation updated successfully');</script>";
       echo "<script type='text/javascript'> document.location = 'manage-quotation.php'; </script>";
}
}

if(isset($_GET['add_itemrow']))
{  
   $itemrow = $_GET['itemrow'];
   $add_itemrow = $_GET['add_itemrow'];
   $itemrow = $itemrow + $add_itemrow;
}
else if(isset($_GET['delete_itemrow']))
{  
   $itemrow = $_GET['itemrow'];
   $delete_itemrow = $_GET['delete_itemrow'];
   $itemrow = $itemrow - $delete_itemrow;
}
else{
   $itemrow ='1';
}
  }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit Profile </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-flid px-4">
                        
<?php 
$uid=$_GET['uid'];
$query=mysqli_query($con,"select * from quotation where uid='$uid'");
while($result=mysqli_fetch_array($query))
{?>
                        <h1 class="mt-4">User ID : <?php echo $result['uid'];?>'s Quotation</h1>
                        <div class="card mb-4">
                     <form method="post">
                            <div class="card-body">
                                <table class="table table-bordered">
									<tbody id="tbody"></tbody>
                                <thead>
								<tr>
								    <th class="text-center">No.</th>
									<th class="text-center">service</th>
									<th class="text-center">Quantity</th>
									<th class="text-center">Price</th>
									<th class="text-center">Amount</th>
									<th class="text-center"></th>
								</tr>
								<?php
								if(mysqli_num_rows($query) > 0)
                                {    
                                while ($result=mysqli_fetch_array($query))
                                { ?>
                                <tr>
								    <th><div name="num[]" id="num_1"></div></th>
                                    <th><input type="text" name="service[]" value="<?php echo $result['service'];?>" id="service_1" class="form-control" autocomplete="off"></th>
                                    <th><input type="number" name="quantity[]" value="<?php echo $result['quantity'];?>" id="quantity_1" class="form-control quantity" autocomplete="off"></th>
									<th><input type="number" name="price[]" value="<?php echo $result['price'];?>" id="price_1" class="form-control quantity" autocomplete="off"></th>
									<th><input type="number" name="amount[]" value="<?php echo $result['amount'];?>" id="amount_1" class="form-control quantity" autocomplete="off"></th>
								</tr>
							    </thead>
								<?php
								}
                     
						     	if($itemrow=='1')
							    {
								?>
								<tr>
								    <th><div name="num[]" id="num_1"></div></th>
                                    <th><input type="text" name="service[]" value="" id="service_1" class="form-control" autocomplete="off"></th>
                                    <th><input type="number" name="quantity[]" value="" id="quantity_1" class="form-control quantity" autocomplete="off"></th>
									<th><input type="number" name="price[]" value="" id="price_1" class="form-control quantity" autocomplete="off"></th>
									<th><input type="number" name="amount[]" value="" id="amount_1" class="form-control quantity" autocomplete="off"></th>
									<th><button class="btn btn-danger delete" id="removeRows" type="button"><a href="test.php?id=<?php echo $qid?>&itemrow=<?php echo $itemrow ?>&delete_itemrow=1">Delete</a></button></th>
								</tr>
								<?php 
								}
								else
                                {
                                for ($i = 0; $i < $itemrow; $i++) {
                                ?>
								<tr>
								    <th><input type="hidden" name="num[]" value="num[]" autocomplete="off"></th>
                                    <th><input type="text" name="service[]" value="" id="service_1" class="form-control" autocomplete="off"></th>
                                    <th><input type="number" name="quantity[]" value="" id="quantity_1" class="form-control quantity" autocomplete="off"></th>
									<th><input type="number" name="price[]" value="" id="price_1" class="form-control quantity" autocomplete="off"></th>
									<th><input type="number" name="amount[]" value="" id="amount_1" class="form-control quantity" autocomplete="off"></th>
									<th><button class="btn btn-danger delete" id="removeRows" type="button"><a href="test.php?id=<?php echo $qid?>&itemrow=<?php echo $itemrow ?>&delete_itemrow=1">Delete</a></button></th>
								</tr>
								<?php 
								}
							    }
								?>

                                <tbody>
							</tbody>
							<tfoot>
								<tr>
									<th class="text-right" colspan="4">Grand amount</th>
									<th class="text-right" id="t_amt">0</th>
									<th><input type="hidden" name="t_amt" value="0"></th>
								</tr>
							</tfoot>
                                
                                </table>
                            </div>
							<div style="text-align:right ;">
							 <button class="btn btn-success add" id="removeRows" type="button"><a href="test.php?id=<?php echo $qid?>&itemrow=<?php echo $itemrow ?>&add_itemrow=1">Add Row</a></button>

                            </div>
						</form>
                        <div class="card-footer" style="text-align:center ;">
                            <a class="btn btn-flat btn-sm btn-default" href="manage-quotation.php">Cancel</a>
				            <button class="btn btn-flat btn-sm btn-primary" form="invoice-form">Update</button>
		                </div>
                        </div>
<?php } ?>

                    </div>
                </main>
 
          <?php include('../includes/footer.php');?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php } ?>
