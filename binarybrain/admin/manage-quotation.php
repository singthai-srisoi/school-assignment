<?php session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title> Manage Quotation </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
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
    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main>
              <div class="container-fluid">
              <h1>Quotation Available</h1>
              <hr />
                        <div style="display: flex; justify-content: flex-end;">
                          <input type="text" id="search" placeholder="Search" style="margin-right: 5px;">
                          <select id="select">
                            <option value="">Selector</option>
                            <option value="pending">pending</option>
                            <option value="approved">approved</option>
                            <option value="rejected">rejected</option>
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
               <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Customer</th>
                <th scope="col">Quotation Name</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Address</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody id="myTable">
              <?php 
                  $result = $con->query("SELECT * FROM quotation q, users u WHERE q.uid=u.id;") or die($con->error());
                  if ($result->num_rows > 0){
                  while ($row = $result->fetch_assoc()){
               ?>
               <tr>
                <th scope="row"><?php echo $row['qid']; ?></th>
                <td><?php echo $row['u_name']; ?></td>
                <td><?php echo $row['service']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['q_addr']; ?></td>
                <td>
                    <!--<form method="post" action="view-quotation.php">
                      <input type="hidden" name="qid" value="<?php echo $row['qid']; ?>">
                      <input type="hidden" name="service" value="<?php echo $row['service']; ?>">
                      <button type="submit" class="btn btn-primary" name="feedback">Manage</button>
                    </form>-->
                    <a href="view-quotation.php?qid=<?php echo $row['qid']; ?>" class="btn btn-primary">Manage</a>
                </td>
              </tr>
              <?php }}else{ ?>
                <h3>No Quotation Available.</h3>
              <?php } ?>
              </tbody>
              </table>


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
