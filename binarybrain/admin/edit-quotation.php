<?php session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
//Code for Updation 
if(isset($_POST['update']))
{
    $uid=$_GET['uid']; 
    $service=$_POST['service'];
    $price=$_POST['price'];
    $msg=mysqli_query($con,"update quotation set service='$service', price='$price' where uid='$uid'");

if($msg)
{
    echo "<script>alert('Quotation updated successfully');</script>";
       echo "<script type='text/javascript'> document.location = 'manage-quotation.php'; </script>";
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
                                   <tr>
                                   <tr>
                                       <th>Requested Services</th>
                                       <td colspan="3"><input class="form-control" service="service" <?php echo $result['service'];?>/></td>
                                   </tr>
                                   <tr>
                                       <th>Price (RM)</th>
                                       <td colspan="3"><input class="form-control" price="price" <?php echo $result['price'];?>   /></td>
                                   </tr>
                                   <tr>
                                       <th>Status</th>
                                       <td colspan="3"><input type="radio" id="Done" name="fav_language" value="Done" <?php echo $result['status'];?>  /> Done</td>
                                   </tr>
                                   <tr>
                                       <td colspan="4" style="text-align:center ;"><button type="submit" class="btn btn-primary btn-block" name="update">Update</button></td>

                                   </tr>
                                    </tbody>
                                </table>
                            </div>
                            </form>
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
