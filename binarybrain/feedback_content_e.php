<?php session_start();

include_once('includes/config.php');
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{
    $q_id = 0;
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
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
            
            $(document).ready(function(){
                $("#feedback").load("feedback_edit.php");
            });
        </script>
        <style type="text/css">
            .parent {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: repeat(3, 1fr);
                grid-column-gap: 0px;
                grid-row-gap: 0px;
                padding: 10px;
                width: 75%;
                }

            .div1 { grid-area: 1 / 1 / 2 / 2; padding: 0; margin: 0;}
            .div2 { grid-area: 1 / 2 / 2 / 3; text-align: center;padding: 0; margin: 0;}
            .div3 { grid-area: 2 / 1 / 3 / 3; padding: 0; margin: 0;}
            .div4 { grid-area: 3 / 1 / 4 / 3; padding: 0; margin: 0;}

        </style>
    </head>
    <body class="sb-nav-fixed">
       
    	 <?php include_once('includes/navbar.php');?>
    	 <div id="layoutSidenav">
          <?php include_once('includes/e_sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php 
                        if (isset($_POST['q_name'])){
                            $_SESSION['q_name'] = $_POST['q_name'];
                        }
                        

                        echo $_SESSION['q_name']; ?></h1>
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
                        
                        <?php 
                            //if (isset($_POST['feedback'])){
                                //echo $_POST['q_id'].' --> post q_id\n';
                                if (isset($_POST['q_id'])){
                                    $_SESSION['q_id'] = $_POST['q_id'];
                                }
                                
                                $q_id = $_SESSION['q_id'];
                                //echo 'quotation id'.$q_id.'<br>';
                                $result = $con->query("SELECT * FROM feedback f, users u, quotation q 
                                                        WHERE f.q_id=$q_id 
                                                        AND f.u_id=u.id
                                                        AND f.q_id=q.qid;") OR die($con->error);

                                
                                //
                            //}

                            function pre_r( $array ){
                                echo '<pre>';
                                print_r($array);
                                echo '</pre>';
                                }
                            //pre_r($result->fetch_assoc());
                         ?>


                        

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Content</th>
                                        <th>Aprovement</th>
                                        <th>Date</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>

                                <?php 
                                    while ($row = $result->fetch_assoc()){
                                        // echo '<pre>';
                                        // print_r($row);
                                        //echo '</pre>';
                                        // echo $row['fname'];
                                  ?>
                                 <tr>
                                    <td><?php echo $row['fname'].' '.$row['lname']; ?></td>
                                    <td><div class="card card-body"><?php echo $row['text']; ?></div></td>
                                    <td><div class="div2 alert alert-<?php if ($row['curr_status'] == 'rejected'){ echo 'danger'; }else{ echo 'success';}?>">
                                    <?php echo $row['curr_status']; ?></div></td>
                                    <td><?php echo $row['posting_date']; ?></td>
                                    <td>
                                        <?php if ($row['u_id'] == $_SESSION['id']){ ?>
                                        <a href="feedback_edit_e.php?edit=<?php echo $row['f_id']?>" 
                                            class="btn btn-info">Edit</a>
                                        <a href="feedback_process_e.php?delete=<?php echo $row['f_id']?>" 
                                            class="btn btn-danger">Delete</a>
                                        <?php }else{ ?>
                                            <h4>--</h4>
                                        <?php } ?>
                                    </td>
                                 </tr>
                                 
                            


                          <?php 
                            }if ($result->num_rows == 0){
                           ?>
                                <h4>No record found.</h4>
                           <?php 
                            }
                            ?>
                            </table>

                            <form method="post" action="feedback_edit_e.php" style="position: absolute;bottom: 10px; right: 10px;">
                                <input type="hidden" name="f_id" value="<?php echo $row['f_id']?>">
                                <input type="hidden" name="q_name" value="<?php echo $_SESSION['q_name'];; ?>">
                                <button type="submit" name="edit" class="btn btn-primary">Add Feedback</button>

                            </form>
                            <div id="feedback"></div>


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