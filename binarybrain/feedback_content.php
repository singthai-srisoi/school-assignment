<?php session_start();

include_once('includes/config.php');
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{
    $q_id = $_GET['qid'];
    $u_id = $_SESSION['id'];

    if (isset($_POST['reject'])){
        //set the status os the quotation to reject
        //$q_id = $_POST['qid'];
        
        $f_text = $_POST['f_text'];
        $con->query("INSERT INTO feedback (text, u_id, date, q_id, curr_status) VALUES ('$f_text', $u_id, current_timestamp(), $q_id, 'rejected')") or die($con->error);
        $con->query("UPDATE quotation SET status='rejected' WHERE qid=$q_id;") or die($con->error);
        $_SESSION['message'] = "Feedback has been sent";
        $_SESSION['msg_type'] = "success";
    }
    if (isset($_POST['approve'])){
        //set the status os the quotation to reject
        //$q_id = $_POST['qid'];
        //$u_id = $_SESSION['id'];
        $f_text = $_POST['f_text'];
        $con->query("INSERT INTO feedback (text, u_id, date, q_id, curr_status) VALUES ('$f_text', $u_id, current_timestamp(), $q_id, 'approved')") or die($con->error);
        $con->query("UPDATE quotation SET status='approved' WHERE qid=$q_id;") or die($con->error);
        $_SESSION['message'] = "Feedback has been sent";
        $_SESSION['msg_type'] = "success";
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
        <title>Dashboard </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
        <script>
        function printDiv(){
            var printContents = document.getElementById("quotation-detail").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = "<!DOCTYPE html><html><head><title>Quotation</title><style>body{padding: 0;margin: 0;width: 1240px;height: 874px;}</style></head><body>"+printContents+"</body></html>";
            window.print();
            document.body.innerHTML = originalContents;
        }
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }

             $(document).ready(function(){
                $('#fb-detail').hide();

                $('#q-').click(function(){
                    $('#quotation-detail').fadeIn();
                    $('#fb-detail').hide();
                });
                $('#f-').click(function(){
                    $('#quotation-detail').hide();
                    $('#fb-detail').fadeIn();
                });
            });
        </script>
        <style>
            .chat-box{
                padding: 5px;
                background-color: lightgrey;
                margin: 5px;
                display: flex;
                flex-direction: column;
                width: 500px;
                border: 1px solid grey;
                border-radius: 3px;
                color: #000033;
            }
            .chat-detail{
                padding: 5px;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
            .chat-content{
                padding: 5px;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
            .chat-status{

                display: flex;
                flex-direction: row;
                justify-content: flex-end;
                align-items: center;
            }
            .chat-approved{
                background-color: #ccffd9;
                border: 1px solid #99ffb3;
                color: #0a290a;
            }
            .chat-rejected{
                background-color: #ffe6e6;
                border: 1px solid #ffb3b3;
                color: #330000;
            }
            .chat-reply{
                background-color: #e6e6ff;
                border: 1px solid #b3b3ff;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
       
    	 <?php include_once('includes/navbar.php');?>
    	 <div id="layoutSidenav">
          <?php include_once('includes/c_sidebar.php');?>
            <div id="layoutSidenav_content">
                
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php 
                        
                        echo $_GET['service']; ?></h1>
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


                        <!--Button to toggle item and feedback-->
                        <div style="display: flex;">
                            <button id="q-" class="btn btn-primary btn-lg" style="margin-right: 5px;">Quotation</button>
                            <button id="f-" class="btn btn-info btn-lg">Feedback</button>
                        </div>
                        <div class="item toggle" id="quotation-detail">
                        <div class="chat-reply" style="padding: 5px; margin: 5px;">
                            <?php 
                                $result = $con->query("SELECT * FROM quotation q, users u WHERE qid=$q_id AND q.uid=u.id;");
                                $row = $result->fetch_assoc();
                                /*echo '<pre>'; 
                                print_r($row);
                                echo '</pre>';  */
                            ?>
                            
                                <b>ID : </b>
                                <?php echo $row['qid']; ?>
                                <br>

                                <b>DATE : </b>
                                <?php echo $row['date']; ?>
                                <br>

                                <b>CUSTOMER NAME : </b>
                                <?php echo $row['u_name']; ?>
                                <br>

                                <b>ADDRESS : </b>
                                <?php echo $row['q_addr']; ?>
                                <br>

                                <b>EMAIL : </b>
                                <?php echo $row['u_email']; ?>
                                <br>

                                <b>CONTACT NO : </b>
                                <?php echo $row['u_contactno']; ?>
                                <br>
                            
                        </div>
                        <?php if (!empty($row['note'])){ ?>
                        <div class="chat-approved" style="padding: 5px; margin: 5px;">
                            <b>NOTE : </b>
                            <p><?php echo $row['note']; ?></p>
                        </div>
                    <?php } ?>
                        <?php 
                                $result = $con->query("SELECT * FROM item WHERE q_id=$q_id;");

                                function pre_r( $array ){
                                echo '<pre>';
                                print_r($array);
                                echo '</pre>';
                                }
                                //pre_r($result->fetch_assoc());    
                         ?>

                         <!--div that wrap item-->
                            <h3>Item</h3>
                            
                         <table class="table">
                                
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Price(RM)</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>

                                <?php 
                                $i = 1;
                                $total = 0.0;
                                //floor($row['i_price']*1000)/1000
                                //number_format((float) $row['i_price'], 2, '.', '');
                                    while ($row = $result->fetch_assoc()){
                                        
                                        // echo '<pre>';
                                        // print_r($row);
                                        //echo '</pre>';
                                        // echo $row['fname'];
                                  ?>
                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['i_name']; ?></td>
                                    <td><?php echo number_format((float) $row['i_price'], 2, '.', ''); ?></td>
                                    <td><?php echo $row['i_quantity']; ?></td>
                                    <td><?php 
                                        $amt = $row['i_quantity']*$row['i_price'];
                                        $total += $amt;
                                        echo number_format((float) $amt, 2, '.', '');
                                     ?></td>
                                 </tr>
                                 
                            


                          <?php 
                            $i = $i +1;}if ($result->num_rows == 0){
                           ?>
                                <h4>No record found.</h4>
                           <?php 
                            }
                            ?>
                            <tfoot>
                                <tr>
                                  <th id="total" colspan="4">Total :</th>
                                  <td><?php echo number_format((float) $total, 2, '.', ''); ?></td>
                                </tr>

                               </tfoot>
                               
                            </table>
                        

                        
                        <button class="btn btn-light" onclick="printDiv()">Print</button>
                        </div>
                        
                        <?php 
                            //print out feed back
                                $result = $con->query("SELECT * FROM feedback f, users u 
                                                        WHERE f.q_id=$q_id 
                                                        AND f.u_id=u.id;") OR die($con->error);

                                
                                //
                            //}

                            
                         ?>


                        
                         <div class="fb toggle" id="fb-detail"><!--div that wrap item-->
                             <h3>Feedback</h3>
                            <div class="toggle-item">
                            <table class="table">
                               
                                <!--<thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Content</th>
                                        <th>Aprovement</th>
                                        <th>Date</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>-->

                                <?php 
                                    while ($row = $result->fetch_assoc()){
                                         //echo '<pre>';
                                         //print_r($row);
                                        //echo '</pre>';
                                        //echo $row['fname'];
                                  ?>

                                 
                                 <tr>
                                    <div class="chat-box chat-<?php if($row['curr_status'] != "Reply From Employee"){
                                                                        echo $row['curr_status'];
                                                                    }else{
                                                                        echo "reply";
                                                                    }
                                                                    ?>">
                                    <div class="chat-detail">
                                        <h4><?php echo $row['u_name']; ?></h4>
                                        <?php echo $row['date']; ?>
                                    </div>
                                    <div class="chat-content">
                                        <h5><?php echo $row['text']; ?></h5>
                                    </div>
                                    <div class="chat-status">
                                        <?php echo $row['curr_status']; ?>
                                    </div>
                                      
                                  </div>
                                  <!--
                                    <td><?php echo $row['u_name']; ?></td>
                                    <td><div class="card card-body"><?php echo $row['text']; ?></div></td>
                                    <td><div class="div2 alert alert-<?php if ($row['curr_status'] == 'rejected'){ echo 'danger'; }else{ echo 'success';}?>">
                                    <?php echo $row['curr_status']; ?></div></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td><!--
                                        <?php if ($row['u_id'] == $_SESSION['id']){ ?>
                                        <a href="feedback_edit.php?edit=<?php echo $row['f_id']?>" 
                                            class="btn btn-info">Edit</a>
                                        <a href="feedback_process.php?delete=<?php echo $row['f_id']?>" 
                                            class="btn btn-danger">Delete</a>
                                        <?php }else{ ?>
                                            <h4>--</h4>
                                        <?php } ?>-->
                                    <!--</td>-->
                                 </tr>
                                 
                            


                          <?php 
                            }if ($result->num_rows == 0){
                           ?>
                                <h4>No record found.</h4>
                           <?php 
                            }
                            ?>

                            </table>
                        </div>
                            
                            <form method="post" action="">

                                   <input type="hidden" name="qid" value="<?php echo $q_id;?>">
                                   <input type="hidden" name="f_id" value="<?php echo $row['f_id']?>">

                                   <textarea style="display: block; width: 500px; height: 150px; margin: 10px;" placeholder="Enter your feedback and choose reject or approve" name="f_text"></textarea>
                                   <button name="reject" class="btn btn-outline-danger">Reject</button>
                                   <button name="approve" class="btn btn-outline-success">Approve</button>
                               </form>
                            </div>
                            


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