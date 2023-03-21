<?php session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
    $qid = $_GET['qid'];
//Code for Updation 


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>View Quotation</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
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
        <link rel="stylesheet" type="text/css" href="print.css" media="print">
    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
              <div id="print">
                <main>
                  <!--Show quotation details-->
                  <div class="container-fluid">
                  <h1 class="mt-4">View Quotation</h1>
              <hr />
                <?php if (isset($_SESSION['message'])):?>
                <div class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php 
                  echo $_SESSION['message'];
                  unset($_SESSION['message']);
                 ?>
                </div>
              <?php endif ?>
               <div style="display: flex;">
                            <button id="q-" class="btn btn-primary btn-lg" style="margin-right: 5px;">Quotation</button>
                            <button id="f-" class="btn btn-info btn-lg">Feedback</button>
                        </div>
              <div id="quotation-detail">
                    <div class="chat-reply" style="padding: 5px; margin: 5px;">
                            <?php 
                                $result = $con->query("SELECT * FROM quotation q, users u WHERE qid=$qid AND q.uid=u.id;");
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

          <!--Show item details-->
          <?php $result = $con->query("SELECT * FROM item WHERE q_id=$qid;") or die($con->error); ?>
          <!--Add item-->
          <div id="manage-item">
            <h3>Items</h3>
            <!--this div load table with ajax using jquery-->
            <table class="table">
            <thead>
                <tr>
                <th>#</th>
              <th>Item</th>
              <th>Price(RM)</th>
              <th>Quantity</th>
              <th>Amount</th>
              <!--<th colspan="2">Action</th>-->
              </tr>
            </thead>

            <?php 
            $i = 1;
            $total = 0.0;
            //floor($row['i_price']*1000)/1000
            //number_format((float) $row['i_price'], 2, '.', '');
            while ($row = $result->fetch_assoc()){
            ?>

            <tr>
              <form method="post" action="">
              <input type="hidden" name="i_id" value="<?php echo $row['i_id']; ?>" class="i_id" required>
              <td><?php echo $i; ?></td>
              <td><input type="text" name="i_name" value="<?php echo $row['i_name']; ?>" disabled></td>
              <td>
                <input type="number" step="0.01" name="i_price" value="<?php echo number_format((float) $row['i_price'], 2, '.', ''); ?>" disabled required>
              </td>
              <td><input type="number" name="i_quantity" value="<?php echo $row['i_quantity']; ?>" disabled required></td>
              <td><?php 
              $amt = $row['i_quantity']*$row['i_price'];
              $total += $amt;
              echo number_format((float) $amt, 2, '.', '');
              ?></td>
              <td><!--
                <button class="save" name="save" style="display: none;" value="save" type="submit">Save</button>
                <input class="edit" type="button" value="Edit">
                <button name="delete" value="delete">Delete</button>-->
              </td>
              </form>
            </tr>

            <?php 
            $i = $i +1;}if ($result->num_rows == 0){
            ?>
            <h4>No record found.</h4>
            <?php } ?>
            <tfoot>
                                <tr>
                                  <th id="total" colspan="4">Total :</th>
                                  <td><?php echo number_format((float) $total, 2, '.', ''); ?></td>
                                </tr>

                               </tfoot>
                               
                            </table>
          </div>
          <button class="btn btn-light" onclick="printDiv()">Print</button>
          </div>
          <hr>
                
        </div>
        <!--Show feedback details-->
        <div id="fb-detail">
        <?php 
           //print out feed back
          $result = $con->query("SELECT * FROM feedback f, users u WHERE f.q_id=$qid AND f.u_id=u.id;") OR die($con->error);  
        ?>


                        
        <div class="fb toggle"><!--div that wrap item-->
          <div class="container-fluid">
           <div class="toggle-item">
           <table class="table">
                      <h3>Feedback</h3>         
        <?php 
          while ($row = $result->fetch_assoc()){
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
        </tr>

      <?php }if ($result->num_rows == 0){?>
        <h4>No record found.</h4>
      <?php }?>
      </table>     
      
         </div>
       </div>
     </div>
     </div>
                </main>
                </div> 
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
