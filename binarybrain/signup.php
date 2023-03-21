<?php session_start();
    require_once('includes/config.php');

    //Code for Registration 
    if(isset($_POST['submit']))
    {
        $name=$_POST['u_name'];
        $email=$_POST['u_email'];
        $password=$_POST['u_password'];
        $contact=$_POST['u_contactno'];
        $address=$_POST['u_address'];

    $sql=mysqli_query($con,"select id from users where u_email='$email'");
    $row=mysqli_num_rows($sql);
    if($row>0)
    {
        echo "<script>alert('Email is already exist with another account. Please try with other email ');</script>";
    } 
    
    else
    {
        $msg=mysqli_query($con,"insert into users(u_name,u_email,u_password,u_contactno,u_address) values('$name','$email','$password','$contact','$address')");

        if($msg)
        {
            echo "<script>alert('Registered successfully'); </script>";
            echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
        }

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
        <title> Registration </title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
  
  <script type="text/javascript">
    //to check the password 
    function checkpass()
    {
        if(document.signup.password.value!=document.signup.confirmpassword.value)
    {
        alert(' Password and Confirm Password field does not match');
        document.signup.confirmpassword.focus();
        return false;
    }
        return true;
    } 
    </script>

    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
<h2 align="center">Registration </h2>
<hr />
                                        <h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
<!-- onsubmit for trigger function of checkpass() -->
<form method="post" name="signup" onsubmit="return checkpass();">

<div class="form-floating mb-3">
<div class="form-floating mb-3 mb-md-0">
<input class="form-control" id="u_name" name="u_name" type="text" placeholder="Enter your first name" required />
<label for="Name">Name</label>
</div>
</div>
                                                
<div class="form-floating mb-3">
<input class="form-control" id="u_email" name="u_email" type="email" placeholder="name@gmail.com" required />
<label for="Email">Email address</label>
</div>
 

<div class="form-floating mb-3">
<input class="form-control" id="u_contactno" name="u_contactno" type="text" placeholder="01118767163" required pattern="[0-9]{10}" title="10 or 11 numeric characters only"  maxlength="11" required />
<label for="Contact">Contact Number</label>
</div>
        
<div class="form-floating mb-3">
<input class="form-control" id="u_address" name="u_address" type="text" placeholder="Enter your address" required />
<label for="Address">Address</label>
</div>

<div class="row mb-3">
<div class="col-md-6">
 <div class="form-floating mb-3 mb-md-0">
<input class="form-control" id="u_password" name="u_password" type="u_password" placeholder="Create a password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required/>
<label for="Password">Password</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating mb-3 mb-md-0">
<input class="form-control" id="confirmpassword" name="confirmpassword" type="password" placeholder="Confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required />
<label for="PasswordConfirm">Confirm Password</label>
</div>
</div>
</div>
                                            
<div class="mt-4 mb-0">
<div class="d-grid"><button type="submit" class="btn btn-primary btn-block" name="submit">Create Account</button></div>
</div>
</form>
                                    </div>
                                    <div class="card-footer text-center py-3">
 <div class="small"><a href="login.php">Have an account? Go to login</a></div>
  <div class="small"><a href="index.php">Back to Home</a></div>
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
