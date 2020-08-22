<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: course.php");
//     exit;
// }
 
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$password = "";
$password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, password FROM admin WHERE password = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_password);
            
            // Set parameters
            $param_password = $password;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if password exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $password);
                    if(mysqli_stmt_fetch($stmt)){

                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["password"] = $password;                            
                            
                            // Redirect user to welcome page
                            header("location: dashboard.php"); 
                      }
                    }
                     else{
                    // Display an error message if password doesn't exist
                    $password_err = "No account found.";
                }
                }
               

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" ref="fontawesome/css/fontawesome.min.css">
    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" ref="bootstrap/loginreg.css">
   <!--   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>
<body>

    
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-style fixed-top bg-primary">
    <div class="container">
      <a class="navbar-brand text-white" href="index.php">Vira Payment</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <!-- <li class="nav-item">
            <a class="nav-link text-white" href="register.php">Sign Up</a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link text-white" href="login.php">Log In</a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>  

<div class="container mt-5 pt-5 mb-5">

 <div class="card mx-auto" style="max-width: 600px; margin-top: 50px; background-color: #fafafa;">
    <article class="card-body mx-auto" style="max-width: 600px;">
    <h4 class="card-title mt-3 text-center">Log in</h4>
    <p class="text-center">Admin Login to VIRA</p>

            <p>Please provide password to login.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">   
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <span class="help-block danger"><?php echo $password_err; ?></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-baseline">
                        <input type="submit" class="btn btn-primary" value="Login">
                        <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                    
                    </div>
                </form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->

<!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../bootstrap/reveal.js"></script>

</body>
</html>