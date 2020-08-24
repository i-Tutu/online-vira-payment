<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$index_number = $password = "";
$index_number_err = $password_err = "";
 
// Processing form data when form is submitted
if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if index_number is empty
    if(empty(trim($_POST["index_number"]))){
        $index_number_err = "Please enter Index Number.";
    } else
        $index_number = trim($_POST["index_number"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($index_number_err) && empty($password_err)){

        $sql = "SELECT id, username, index_number, password FROM users WHERE index_number = :index_number";

        if (DB::query($sql, array(':index_number' => $index_number))) {
        
        // Prepare a select statement
        $userInfo = DB::query($sql, array(':index_number' => $index_number));

        $hashed_password = $userInfo[0]['password'];
        $username = $userInfo[0]['username'];

        if(password_verify($password, $hashed_password)){
            
            session_start();

            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["index_number"] = $index_number;
            $_SESSION["username"] = $username;                            
            
            // Redirect user to welcome page
            header("location: welcome.php");
        } else{

            // Display an error message if password doesn't exist
            $index_number_err = "No account found with that Password.";
        }

    } else{
            // Display an error message if username doesn't exist
            $index_number_err = "No account found with that Index Number.";
    }

        
        
        
    }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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

    <?php 
        include("resource/header.php");
    ?> 

    <!-- <div class="card">
        <div class="card-header"><h2>Login</h2></div>
            <div class="card-body">

                <div class="wrapper">
                
                <p>Please fill in your credentials to login.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($index_number_err)) ? 'has-error' : ''; ?>">
                        <label>index_number</label>
                        <input type="text" name="index_number" class="form-control" value="<?php echo $index_number; ?>">
                        <span class="help-block"><?php echo $index_number_err; ?></span>
                    </div>    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                    <p><a href="reset-password.php">Reset Password</a>.</p>
                    <p><a href="register.php">Sign Up</a>.</p>
                </form>
                </div>
                
            </div>
        
    </div> -->  

<div class="container mt-5 pt-5 mb-5">

 <div class="card mx-auto" style="max-width: 600px; margin-top: 50px; background-color: #fafafa;">
    <article class="card-body mx-auto" style="max-width: 600px;">
    <h4 class="card-title mt-3 text-center">Log in</h4>
    <p class="text-center">Login to start VIRA</p>

            <p>Please fill in your credentials to login.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($index_number_err)) ? 'has-error' : ''; ?>">
                        <label>Index Number</label>
                        <input type="text" name="index_number" class="form-control" value="<?php echo $index_number; ?>">
                        <span class="help-block danger"><?php echo $index_number_err; ?></span>
                    </div>    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <!-- <div class="input-group">
                          <input type="password" class="form-control pwd" value="">
                          <span class="input-group-btn">
                            <button class="btn btn-dark reveal" type="button"><i class="fa fa-eye"></i></button>
                          </span>          
                        </div> -->
                        <span class="help-block danger"><?php echo $password_err; ?></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-baseline">
                        <input type="submit" class="btn btn-primary" value="Login">
                        <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                    
                    <!-- <p><a href="reset-password.php">Reset Password</a>.</p> -->
                   <!--  <p><a href="register.php">Sign Up</a></p> -->
                    </div>
                </form>
</article>
</div> <!-- card.// -->

    <div class="text-center mt-5"><a href="admin/index.php">Admin</a></div>

</div> 
<!--container end.//-->

<!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/reveal.js"></script>

</body>
</html>