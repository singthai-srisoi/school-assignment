<?php session_start();

include_once('includes/config.php');
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{

//Code for Registration 
if(isset($_POST['submit']))
{
    $uid=$_SESSION['id'];
    $service=$_POST['request'];
    $addr=$_POST['addr'];
    $note=$_POST['note'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $datetime = $date.' '.$time.':00';
    //echo "<script>alert('$datetime');</script>";


    $msg=mysqli_query($con,"INSERT INTO quotation (uid, service, status, date, q_addr, note) VALUES ($uid, '$service', 'Pending', '$datetime', '$addr', '$note')");
//$msg = 0;
if($msg)
{
    echo "<script>alert('Thank you for booking our service, please wait for our employee quote for you after this');</script>";

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
        <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>

    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/c_sidebar.php');?>
            <div id="layoutSidenav_content">

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
                                        <h3 class="text-center font-weight-light my-4">Request for Services</h3></div>
                                    <div class="card-body">
<form method="post" onsubmit="return checkpass();">
    
<div class="form-group">
    <label for="exampleFormControlSelect2">Request A Service</label>
    <select class="form-control" id="exampleFormControlSelect2" name="request" required>
      <option value="Air Conditioning">Air Conditioning</option>
      <option value="Electrical & Electronic">Electrical & Electronic</option>
      <option value="Pest Control">Pest Control</option>
      <option value="Cleaning & Sanitary">Cleaning & Sanitary</option>
      <option value="Civil">Civil</option>
      <option value="Pump">Pump</option>
      <option value="Sewage">Sewage</option>
      <option value="Fire Fighting & Alarm System">Fire Fighting & Alarm System</option>
    </select>
  </div>

  <div class="form-group">
    <label>Booking Time</label>
    <br>
     <input type="date" name="date" pattern="\d{4}-\d{2}-\d{2}" id="currDate">
     <input type="time" name="time" min="08:00" max="18:00" id="currTime">
     <script>
       $(document).ready(function(){
          let date = new Date();
          //let curr = date.toISOString();
          //console.log(date);
          let currDate = date.toISOString().substring(0,10);
          let currTime = date.toString().substring(16,21);
          //console.log(currDate+' '+currTime);
          $("#currDate").val(currDate);
          $("#currDate").attr('min',currDate);
          $("#currTime").val(currTime);
       })
     </script>
   </div>
  <?php 
    //get user address
    $id = $_SESSION['id'];
    $result = $con->query("SELECT u_address FROM users WHERE id=$id;") or die($con->error);
    $row = $result->fetch_assoc();
    //echo $row['u_address'];
   ?>

  <div class="form-group">
    <label>Address</label><br>
    <textarea name="addr" placeholder="Please enter appopraite address" style="width: 500px; height: 100px;"><?php echo $row['u_address']; ?></textarea>
  </div>
  <div class="form-group">
    <label>Note</label><br>
    <textarea name="note" placeholder="Please enter note of your request" style="width: 500px; height: 100px;"></textarea>
  </div>
  <div class="form-group">
      <button type="submit" name="submit">Submit</button>
  </div>
                                        </form>
                                    </div>
                                    
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
