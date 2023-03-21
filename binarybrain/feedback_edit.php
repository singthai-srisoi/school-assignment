<?php session_start();

include_once('includes/config.php');
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{
    $q_id = 0;

?>
<?php 
$text = "";
$f_id = 0;
$modify = false;
if (isset($_POST['save'])){
    $text = $_POST['text'];
    $appr = $_POST['appr'];
    $u_id = $_SESSION['id'];
    $q_id = $_SESSION['q_id'];

    $con->query("INSERT INTO feedback (f_id, text, u_id, date, q_id, curr_status) VALUES (NULL, '$text', $u_id, current_timestamp(), $q_id, '$appr')") OR die($con->error);
    $con->query("UPDATE quotation SET status='$appr' WHERE qid=$q_id; ") OR die($con->error);
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: feedback_content.php");
}



if (isset($_GET['edit'])){
    $f_id = $_GET['edit'];
    $modify = true;
    $result = $con->query("SELECT * FROM feedback WHERE f_id=$f_id;") or die($mysqli->error);

    //check if data exist
    //if (count($result) == 1){
        $row = $result->fetch_array();
        $text = $row['text'];
        //$q_date = $row['q_date'];
    //}
}

if (isset($_POST['update'])){
    $f_id = $_POST['f_id'];
    $text = $_POST['text'];
    //$appr = $_POST['appr'];

    $con->query("UPDATE feedback SET text='$text' WHERE f_id=$f_id; ") or die($con->error);
    //$con->query("UPDATE quo")
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    header("location: feedback_content.php");

}
/*
if (isset($_POST['modify'])){
    $f_id = $_POST['f_id'];
    $result = $con->query("SELECT * FROM feedback WHERE f_id=$f_id;") OR die($con->error);

    $row = $result->fetch_assoc();
    $modify_text = $row['text'];
    $modify = true;
}
if (isset($_POST['update'])){
    $text = $_POST['text'];
    $appr = $_POST['appr'];
    $u_id = $_SESSION['id'];
    $q_id = $_SESSION['q_id'];
    //echo $f_id;

    $con->query("UPDATE feedback SET text='$text', curr_status='$appr' WHERE f_id=$f_id;") OR die($con->error);
    $con->query("UPDATE quotation SET q_status='$appr' WHERE q_id=$q_id; ") OR die($con->error);
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "success";
    header("location: feedback_view.php");
}else if (isset($_POST['delete'])){
    $con->query("DELETE FROM feedback WHERE f_id=$f_id;");
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "alert";
    header("location: feedback_view.php");
 
}*/
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
          <?php include_once('includes/c_sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $_SESSION['service']; ?></h1>
                        <hr />
                        

                        <form class="form-group" method="post">
                       <div class="card" style="padding: 10px;">
                            <input type="hidden" name="f_id" value="<?php echo $f_id; ?>">
                            <h4>Approvemnt</h4>
                            <?php if ($modify == false): ?>
                            <div class="form-group">
                                <input type="radio" name="appr" value="approved"><label>&nbsp;approve</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="appr" value="rejected"><label>&nbsp;reject</label>
                            </div>
                            <?php endif; ?>
                            <br>
                            <div class="form-group">
                                <textarea name="text" placeholder="Enter you feedback here..." class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $text; //echo $f_id; ?> </textarea>
                            </div>
                            <br>

                            <div class="form-group">
                                <?php if ($modify == false): ?>
                                <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                <?php else: ?>
                                    <!--<button class="btn btn-danger" type="submit" name="delete">Delete</button>-->
                                    <button class="btn btn-primary" type="submit" name="update">Update</button>
                                <?php endif; ?>

                            </div>
                       </div>
        
                     </form>




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