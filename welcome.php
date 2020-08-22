
<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: course.php");
//     exit;
// }
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$payment_code = "";
$payment_code_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if payment_code is empty
    if(empty(trim($_POST["payment_code"]))){
        $payment_code_err = "Please enter Code.";
    } else{
        $payment_code = trim($_POST["payment_code"]);
    }
    
    // Validate credentials
    if(empty($payment_code_err)){
        // Prepare a select statement
        $sql = "SELECT id, payment_code FROM payment WHERE payment_code = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_payment_code);
            
            // Set parameters
            $param_payment_code = $payment_code;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if payment_code exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $payment_code);
                    if(mysqli_stmt_fetch($stmt)){

                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["payment_code"] = $payment_code;                            
                            
                            // Redirect user to welcome page
                            header("location: course.php"); 
                      }
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
    <title>Welcome</title>


  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
  <!--   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    

    <link rel="stylesheet" ref="bootstrap/welcome.css">
    <link rel="stylesheet" ref="bootstrap/site.css">
</head>
<body>
    <header>
        <nav class="navbar static bg-primary">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand text-white" href="welcome.php">Payment for VIRA</a>
          </div>
          <!-- <ul class="nav navbar-nav navbar-right text-white">
            <li><a class="text-white" href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>  
            <li><a class="text-white" href="reset-password.php"><span class="glyphicon glyphicon-log-in text-white"></span> Reset Password</a></li>
            </ul> -->
            
            <form class="form-inline mt-2 mt-md-0">
                <a class="text-white mr-3" href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>  
                <a class="text-white" href="reset-password.php"><span class="glyphicon glyphicon-log-in text-white"></span> Reset Password</a></li>
          </form>
          </div>
        </nav>
    </header>

    <section>
        <div class="container">
        <div class="text-center mt-3">
            <h3>Welcome, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h3>
        </div>

            <!-- <div class="row">
              <div class="column" class="img-rounded">
                <img src="img/mtn.png" alt="Snow" style="width:100%">
              </div>
              <div class="column" class="img-rounded">
                <img src="img/vodafone.jpg" alt="Forest" style="width:100%">
              </div>
              <div class="column" class="img-rounded">
                <img src="img/at.jpg" alt="Mountains" style="width:100%">
              </div>
            </div> -->

            <div class="row mt-5">
              <div class="col-md-4">
                <div class="thumbnail">
                    <img src="img/mtn.png" alt="MTN Ghana" style="width:100%">
                    <div class="caption">
                      <p class="text-center mt-2">MTN</p>
                    </div>
                </div>
              </div>

               <div class="col-md-4">
                <div class="thumbnail">
                    <img src="img/tigo.jpg" alt="AirtelTigo" style="width:100%">
                    <div class="caption">
                      <p class="text-center mt-2">AirtelTigo</p>
                    </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="thumbnail">
                    <img src="img/voda.jpg" alt="Vodafone Ghana" style="width:100%">
                    <div class="caption">
                      <p class="text-center mt-2">Vodafone</p>
                    </div>
                </div>
              </div>
             
            </div>

            <div class="row mt-5 mb-5"> <!-- style="margin-right: : 0px; margin-left: 300px;" -->

              <div class="col-md-4">
              <p>
                <a class="btn btn-primary justify-content-between" data-toggle="collapse" href="#collapsemtn" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Click here to check the procedures on how to make payment with MTN
                </a>
              </p>
              <div class="collapse" id="collapsemtn">
                <div class="card card-body">
                  <div>
                    <span class="fa fa-hand-o-right"> Dial *170# </span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Choose Option 2 "Pay Bill"</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Choose General Payments (Option 6)</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Enter deposit amount (GH¢150.00).</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Enter VIRA reference</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Enter PIN to confirm payment</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> You will receive a message to code, and then enter code below to procede</span>
                  </div>
                </div>
              </div>
            </div>

              <div class="col-md-4">
              <p>
                <a class="btn btn-primary justify-content-between" data-toggle="collapse" href="#collapseairtel" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Click here to check the procedures on how to make payment with AirtelTigo
                </a>
              </p>
              <div class="collapse" id="collapseairtel">
                <div class="card card-body">
                  <div>
                    <span class="fa fa-hand-o-right"> Dial *170# </span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Choose Option 2 "Pay Bill"</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Choose General Payments (Option 6)</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Enter deposit amount (GH¢150.00).</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Enter VIRA reference</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Enter PIN to confirm payment</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> You will receive a message to code, and then enter code below to procede</span>
                  </div>
                </div>
              </div>
            </div>

              <div class="col-md-4">
              <p>
                <a class="btn btn-primary justify-content-between" data-toggle="collapse" href="#collapsevodane" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Click here to check the procedures on how to make payment with Vodafone
                </a>
              </p>
              <div class="collapse" id="collapsevodane">
                <div class="card card-body">
                  <div>
                    <span class="fa fa-hand-o-right"> Dial *170# </span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Choose Option 2 "Pay Bill"</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Choose General Payments (Option 6)</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Enter deposit amount (GH¢150.00).</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Enter VIRA reference</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> Enter PIN to confirm payment</span>
                  </div>
                  <div>
                    <span class="fa fa-hand-o-right"> You will receive a message to code, and then enter code below to procede</span>
                  </div>
                </div>
              </div>
            </div>
             
            </div>

        
        <div class="row mb-5">

          <div class="col-md-6">
                <div class="text-center" style="max-width: 600px; margin-top: 100px; margin-right: 50px; ">
                    <h2>Enter Code to continue your registration</h2>
                </div>
            </div>
            
        <div class="col-md-6">
         <div class="card mx-auto" style="max-width: 600px; margin-top: 50px; background-color: #fafafa;">
            <div class="card-body mx-auto" style="max-width: 600px;">
            <h4 class="card-title mt-3 text-center">Please Enter Code</h4>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($payment_code_err)) ? 'has-error' : ''; ?>">
                                <input type="text" name="payment_code" class="form-control" value="<?php echo $payment_code; ?>">
                                <span class="help-block danger"><?php echo $payment_code_err; ?></span>
                            </div>  
                            <div class="input">
                                <input type="submit" class="btn btn-primary" value="Send">
                            </div>
                        </form>
                </div>
            </div> <!-- card.// -->
        </div>

          

        </div>
        </div> 
        <!--container end.//-->
    </section>

    <?php 
      include("resource/footer.php");
    ?>

    <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>