<?php session_start();
include_once('includes/config.php');
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{

  }
    
?>

<?php
$sql1 = "SELECT COUNT(*) FROM quotation WHERE status = 'Approved'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_array($result1);

$sql2 = "SELECT COUNT(*) FROM quotation WHERE status = 'Pending'";
$result2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_array($result2);

$sql3 = "SELECT COUNT(*) FROM quotation WHERE status = 'rejected'";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_array($result3);

$dataPoints = array( 
    array("label"=>"Approved", "y"=>$row1[0]),
	  array("label"=>"Pending", "y"=>$row2[0]),
    array("label"=>"Rejected", "y"=>$row3[0]),
)

?>

<!DOCTYPE html>
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
        <script>
            window.onload = function() {
             
             
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Quotation Status"
                },
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
             
            }
        </script>
    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/e_sidebar.php');?>
            <div id="layoutSidenav_content">

                <div class="container-fluid px-4">
                    <h1 class="mt-4">Manage Report</h1>

                <?php
                $query=mysqli_query($con,"select qid from quotation");
                $totalquotation=mysqli_num_rows($query);
                ?>

                <?php
                $query2=mysqli_query($con,"select f_id from feedback");
                $totalfeedback=mysqli_num_rows($query2);
                ?>
                
            <div class="row mb-3">
                <div class="col-xl-4 col-md-6 mb-4">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-uppercase mb-1">Total Quotation</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalquotation;?></div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-calendar fa-2x text-primary"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>      

                <div class="col-xl-4 col-md-6 mb-4">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-uppercase mb-1">Total Feedback</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalfeedback;?></div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-comments fa-2x text-warning"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                <script src="js/canvasjs.min.js"></script>

                <div style="position: absolute;top: 395px;width: 63px;background-color:  white;">
                    <span style="color: white;">.</span>
                </div>

                <div style="position: absolute;top: 395px; right: 0px; width: 63px;background-color: white;">
                    <span style="color: white;">.</span>
                </div>

                <div class="container-fluid">
                	<div class="row">
                        <div class="col-md-12">
                            
                            <div class="col-lg-3 col-md-4">
                            <a href="manage-report1.php">
                              <div class="dash3 white-box analytics-info">
                                <h3 class="box-title">Approved</h3>
                                <ul class="list-inline two-part d-flex align-items-center mb-0">
                                  <li class="ms-auto">
                                    <span class="counter text"><?php echo $row1[0];?></span>
                                  </li>
                                </ul>
                              </div>
                            </a>
                            </div>
                            
                            <div class="col-lg-3 col-md-4">
                            <a href="manage-report2.php">
                              <div class="dash1 white-box analytics-info">
                                <h3 class="box-title">Pending </h3>
                                <ul class="list-inline two-part d-flex align-items-center mb-0">
                                  <li class="ms-auto">
                                    <span class="counter text"><?php echo $row2[0];?></span>
                                  </li>
                                </ul>
                              </div>
                            </a>
                            </div>

                            <div class="col-lg-3 col-md-4">
                            <a href="manage-report3.php">
                              <div class="dash2 white-box analytics-info">
                                <h3 class="box-title">Rejected </h3>
                                <ul class="list-inline two-part d-flex align-items-center mb-0">
                                  <li class="ms-auto">
                                    <span class="counter text"><?php echo $row3[0];?></span>
                                  </li>
                                </ul>
                              </div>
                              </a>
                            </div>
                        </div>
                </div>


<?php include 'footer.php';?>