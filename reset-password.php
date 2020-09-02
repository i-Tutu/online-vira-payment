<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";

// Alert
$alerter = "";

// User id
$user_id = $_SESSION['id'];
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Hashed password
    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = :password WHERE id = :userId";

        $query = DB::query($sql, array(':password' => $password_hash, ':userId' => $user_id));

        if ($query) {

            $alerter = "success";
             
        } else{
            echo "Oops! Something went wrong. Please try again later.";  
        }
        
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" ref="bootstrap/site.css">
</head>
<body>

     <!-- Alert -->
       <?php 
         if ($alerter == "success") {
              
            ?>
        <div class="alert alert-success alert-dismissible mt-1 mr-5 ml-5">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Succesfully!</strong> updated <a href="welcome.php">Back to Home</a>
        </div>
          <?php
            }
        ?>

    <div class="card mx-auto" style="max-width: 600px; margin-top: 50px; background-color: #fafafa;">
    <article class="card-body mx-auto" style="max-width: 600px;">
    <h2 class="card-title mt-3 text-center">Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="d-flex justify-content-between align-items-baseline">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="welcome.php">Cancel</a>
            </div>
        </form>
    </article>
    </div>    


    <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/reveal.js"></script>
  
</body>
</html>