<?php session_start();
require_once('includes/config.php');

//Code for Registration 
if(isset($_POST['submit']))
{
    $uid=$_POST['uid'];
    $qid=$_POST['qid'];
    $respond=$_POST['respond'];
$sql=mysqli_query($con,"select uid from quotation where uid='$uid'");
$row=mysqli_num_rows($sql);
if($row>0)
{
    echo "<script>alert('There is a same quotation already exist.');</script>";
} else{
    $msg=mysqli_query($con,"insert into quotation(respond) values($respond)");

if($msg)
{
    echo "<script>alert('respond requested successfully, please wait for our employee to quote to you. ');</script>";
    echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
}
}
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title> Quotation </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/e_sidebar.php');?>
            <div id="layoutSidenav_content">

    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
<hr />
                                        <h3 class="text-center font-weight-light my-4" >RESPOND</h3></div>
                                    <div class="card-body">
<form method="post" name="request" onsubmit="return checkpass();">

<div class="row mb-3">
<div class="col-md-6">
<div class="form-floating mb-3 mb-md-0" >
    <td colspan="3"><input type="radio" id="Accepted" name="fav_language" value="Accepted" required /> Accepted</td>
    <td colspan="3"><input type="radio" id="Rejected" name="fav_language" value="Rejected" required /> Rejected</td>
</div>

<label for="Respond">Reason : </label>
<input class="form-control" uid="uid" placeholder="Enter your the status you want" required />

</div>
                                                

                                            

<div class="mt-4 mb-0">
<div class="d-grid"><button type="submit" class="btn btn-primary btn-block" name="submit">Send</button></div>
</div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
 <div class="small"><a href="manage-quotation.php">Cancel</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
         
<?php include 'footer.php'; ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
