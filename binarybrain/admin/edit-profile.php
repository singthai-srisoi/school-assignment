<?php session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
//Code for Updation 
if(isset($_POST['update']))
{
    $fname=$_POST['u_name'];
    $user_type= $_POST['user_type'];
    $contact=$_POST['u_contactno'];
    $address=$_POST['u_address'];
    $userid=$_GET['uid'];
    $msg=mysqli_query($con,"update users set u_name='$fname',user_type='$user_type', u_contactno='$contact', u_address='$address' where id='$userid'");

if($msg)
{
    echo "<script>alert('Profile updated successfully');</script>";
       echo "<script type='text/javascript'> document.location = 'manage-users.php'; </script>";
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
                    <div class="container-fluid px-4">
                        
<?php 
$userid=$_GET['uid'];
$query=mysqli_query($con,"select * from users where id='$userid'");
while($result=mysqli_fetch_array($query))
{?>
                        <h1 class="mt-4"><?php echo $result['u_name'];?>'s Profile</h1>
                        <div class="card mb-4">
                     <form method="post">
                            <div class="card-body">
                                <table class="table table-bordered">
                                   <tr>
                                    <th> Name</th>
                                       <td><input class="form-control" id="u_name" name="u_name" type="text" value="<?php echo $result['u_name'];?>" required /></td>
                                   </tr>

                                   <tr>
                                       <th>User Type</th>
                                       <td colspan="3">
                                        <select name="user_type" id="user_type"  value="<?php echo $result['user_type'];?>">
                                        <option value="2"> Employee </option>
                                        <option value="1"> Customer</option>
                                        </select>
                                       </td>
                                   </tr>

                                   <tr>
                                       <th>Email</th>
                                       <td colspan="3"><?php echo $result['u_email'];?></td>
                                   </tr>

                                    <tr>
                                       <th>Contact No.</th>
                                       <td colspan="3"><input class="form-control" id="u_contactno" name="u_contactno" type="text" value="<?php echo $result['u_contactno'];?>"  pattern="[0-9]{10}" title="11 numeric characters only"  maxlength="10" required /></td>
                                   </tr>

                                   <tr> 
                                       <th> Address</th>
                                       <td><input class="form-control" id="u_address" name="u_address" type="text" value="<?php echo $result['u_address'];?>" required /></td>
                                   </tr>

                                    <tr>
                                       <th>Reg. Date</th>
                                       <td colspan="3"><?php echo $result['u_posting_date'];?></td>
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
