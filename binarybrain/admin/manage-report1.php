<?php session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{

    
?>

<?php
$sql = "SELECT * FROM quotation 
        LEFT JOIN users ON quotation.uid = users.id
        WHERE status = 'Approved'
        ORDER BY date DESC" ;


$result = mysqli_query($con, $sql);
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
                    <h1 class="mt-4">Approved Quotation</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="manage-report.php">Back</a></li>
                        </ol>

                <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Quotation Details
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                           <th class="border-top-0">No.</th>
                                            <th class="border-top-0">Quotation ID</th>
                                            <th class="border-top-0">Service</th>
                                            <th class="border-top-0">Customer Name</th>
                                            <th class="border-top-0">Date </th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                            <?php
                                                $i = 1;
                                                $start = 11;
                                                $end = 20;
                                                if(mysqli_num_rows($result)>0){
                                                while ($row = mysqli_fetch_array($result)){
                                                    /*if($i < $start || $i > $end ){
                                                        $i++;
                                                        continue;
                                                    }*/

                                                    echo "<tr>";
                                                    echo "<td> ".$i++."</td>";
                                                    echo "<td> ".$row['qid']."</td>";
                                                    echo "<td> ".$row['service']."</td>";
                                                    echo "<td> ".$row['u_name']."</td>";
                                                    echo "<td> ".$row['date']."</td>";
                                                    echo "</tr>";
                                                }
                                                }
                                                else{
                                                    echo "<tr>";
                                                    echo "<td>No Quotation found...</td>";
                                                    echo "</tr>";
                                                }
                                            ?>    
                                                                               
                                        </tbody>
                                </table>
                            </div>
                </div>

            </main>

 <?php include('../includes/footer.php');?>
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php } ?>