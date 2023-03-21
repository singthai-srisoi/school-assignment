<?php session_start();
include_once('includes/config.php');
if (strlen($_SESSION['id']==0)) {
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
        <title>Dashboard </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
    </head>
    <body class="sb-nav-fixed">
    	
    	 <?php include_once('includes/navbar.php');?>
    	 <div id="layoutSidenav">
          <?php include_once('includes/e_sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Quotation Available</h1>
                        <hr />
                        <?php 
                            if (isset($_SESSION['message'])):
                         ?>
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
					      <th scope="col">id</th>
					      <th scope="col">Quotation Name</th>
					      <th scope="col">Date</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 
					  		$id = $_SESSION['id'];
					  		$result = $con->query("SELECT * FROM quotation q, users u WHERE u.id = q.qid;") or die($con->error);
					  		//havent assign the quotation only shows to the one who incharge.
					  		//just adding ```sql AND q.c_id=$_SESSION['id']  ```


					  		function pre_r( $array ){
								echo '<pre>';
								print_r($array);
								echo '</pre>';
							}
							//pre_r($result->fetch_assoc());
					  		if ($result->num_rows > 0){
					  			while ($row = $result->fetch_assoc()){
					  				//pre_r($row);
					  				?>
					  	
					    <tr>
					      <th scope="row"><?php echo $row['qid']; ?></th>
					      <td><?php echo $row['service']; ?></td>
					      <td><?php echo $row['date']; ?></td>
					      <td>
					      		<form method="post" action="feedback_content_e.php">
					      			<input type="hidden" name="q_id" value="<?php echo $row['qid']; ?>">
					      			<input type="hidden" name="q_name" value="<?php echo $row['service']; ?>">
					      			<button type="submit" class="btn btn-primary" name="feedback">Feedback</button>
					      		</form>

					      	<!--<a type="button" class="btn btn-primary" href="feedback_content.php">Feedback</a>-->


					      </td>
					    </tr>

					    <?php }}else{ ?>
					    	<h3>No Quotation Available.</h3>
					    <?php } ?>
					  </tbody>
					</table>
				</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
    </html>

<?php } ?>