<?php 
session_start(); 
include('includes/config.php');

// Code for login 
if(isset($_POST['login']))
{
    $password=$_POST['password'];
    $dec_password=$password;
    $useremail=$_POST['uemail'];
    $ret= mysqli_query($con, "SELECT * FROM users WHERE u_email = '{$useremail}' AND u_password = '{$dec_password}' ");
    $num=mysqli_fetch_assoc($ret);
    $count = mysqli_num_rows($ret);

    $ret = mysqli_query($con, "SELECT * FROM users WHERE u_email = '{$useremail}' LIMIT 1");

    // if ($ret) {
    //     if ($ret && mysqli_num_rows($ret) > 0) {
    //         $fetch_assoc_data = mysqli_fetch_assoc($ret);
    //         if ($useremail == $fetch_assoc_data['u_email'] && $dec_password == $fetch_assoc_data['password']) {
    //             // your code...
    //         } else {
    //             echo '<script>alert("Invalid email address or password ! ");</script>';
    //         }
    //     } else {
    //         echo '<script>alert("Invalid email address or password ! ");</script>';
    //     }
    // }
    
    if($count > 0)
    {
        $_SESSION['id'] = $num['id'];
       if($num['user_type'] == 2)
       {
           header ('location: employee.php');
       }
       else 
       {
           header ('location: customer.php');
       }
    }
    else
    {
        echo "<script>alert('Invalid username or password');</script>";
    }
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
        <title>User Login </title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">

<div class="card-header">
<h2 align="center">Login </h2>
<hr />
    <h3 class="text-center font-weight-light my-4">User Login</h3></div>
                                    <div class="card-body">
                                        
                                        
<form method="post">
                                            
<div class="form-floating mb-3">
<input class="form-control" name="uemail" type="email" placeholder="name@example.com" required/>
<label for="inputEmail">Email address</label>
</div>
                                            

<div class="form-floating mb-3">
<input class="form-control" name="password" type="password" placeholder="Password" required />
<label for="inputPassword">Password</label>
</div>


<div class="d-flex align-items-center justify-content-between mt-4 mb-0">
<a class="small" href="password-recovery.php">Forgot Password?</a>

    <button class="btn btn-primary" name="login" type="submit">Login</button>
</div>
</form>
</div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="signup.php">Need an account? Sign up!</a></div>
                                          <div class="small"><a href="index.php">Back to Home</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

        <?php include 'footer.php'; ?>
    </body>
</html>
