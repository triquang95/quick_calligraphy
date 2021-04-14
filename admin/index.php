<?php
 session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
if(isset($_POST['login']))
  {
 
    // Getting username/ email and password
     $uname=$_POST['username'];
    $password=$_POST['password'];
    // Fetch data from database on the basis of username/email and password
$sql =mysqli_query($conn,"SELECT username,email,password FROM accounts WHERE (username='$uname' || email='$uname')");
 $num=mysqli_fetch_array($sql);
if($num>0)
{
$hashpassword=$num['password']; // Hashed password fething from database
//verifying Password
if (password_verify($password, $hashpassword)) {
$_SESSION['login']=$_POST['username'];
    echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
  } else {
echo "<script>alert('Wrong Password');</script>";
 
  }
}
//if username or email not found in database
else{
echo "<script>alert('User not registered with us');</script>";
  }
 
}
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="assets/css/admin.css">
<!------ Include the above in your HEAD tag ---------->
  <div class="tile">
  <div class="tile-header">
    <h2 style="color: white; opacity: .75; font-size: 4rem; display: flex; justify-content: center; align-items: center; height: 100%;">SIGN IN</h2>
  </div>
  
  <div class="tile-body">
    <form id="form" method="post">
      <label class="form-input">
        <i class="material-icons">person</i>
        <input type="text" name="username" autofocus="true" required />
        <span class="label">Username</span>
        <span class="underline"></span>
      </label>
      
      <label class="form-input">
        <i class="material-icons">lock</i>
        <input type="password" name="password" required />
        <span class="label">Password</span>
        <div class="underline"></div>
      </label>
      <div class="form-group account-btn text-center m-t-10">
             <div class="col-xs-12">
                    <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="login">Log In</button>
                    </div>
               </div>
    
        </div>
      </div>
    </form>
  </div>
</div>

  
 
