<?php
// Include config file
require_once "partials/config.php";
 
// Define variables and initialize with empty values
$username = $email = $password = $confirm_password = $address = "";
$username_err = $email_err = $password_err = $confirm_password_err = $address_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM accounts WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

	  // Validate email
	  if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";     
    } else{
        $email= trim($_POST["email"]);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate password
    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter a address.";     
    } else{
        $address= trim($_POST["address"]);
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($address_err) && empty($username_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO accounts (username, email, password, address) VALUES (:username, :email, :password, :address)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":address", $param_address, PDO::PARAM_STR);
            
            // Set parameters
			$param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_address= $address;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>
<!DOCTYPE HTML>
<html>
<?php
        include ("partials/head.php");
    ?>
<body>
<!-- header -->
<?php
        include ("partials/header.php");
	?>
<!-- header -->
<!-- registration -->
<div class="container">
	<div class="main-1">
		
			<div class="register">
		  	  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
				 <div class="register-top-grid">
					<h3>PERSONAL INFORMATION</h3>
					 <div class="wow fadeInLeft" data-wow-delay="0.4s">
						<span>UserName<label>*</label></span>
						<input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                		<span class="invalid-feedback"><?php echo $username_err; ?></span>
					 </div>
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						<span>EMAIL<label>*</label></span>
						<input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                		<span class="invalid-feedback"><?php echo $email_err; ?></span>
					 </div>
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <span>ADDRESS<label>*</label></span>
						 <input type="text" name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $address; ?>">
                		<span class="invalid-feedback"><?php echo $address_err; ?></span>
					 </div>
					 <div class="clearfix"> </div>
					   <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up for Newsletter</label>
					   </a>
					 </div>
				     <div class="register-bottom-grid">
						    <h3>LOGIN INFORMATION</h3>
							 <div class="wow fadeInLeft" data-wow-delay="0.4s">
								<span>Password<label>*</label></span>
								<input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
               					 <span class="invalid-feedback"><?php echo $password_err; ?></span>
							 </div>
							 <div class="wow fadeInRight" data-wow-delay="0.4s">
								<span>Confirm Password<label>*</label></span>
                				<input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                				<span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
							 </div>
							 <div class="form-group">						
               			 <input type="submit" class="btn btn-danger" value="Submit">
						 <input type="reset" class="btn btn-primary" value="Reset">
							
           			 </div>
					 </div>
				</form>
				<div class="clearfix"> </div>
				<div class="register-but">
			
				</div>
		   </div>
	</div>
<!-- registration -->

<?php
            include ("partials/footer.php");
            ?>
</body>
</html>