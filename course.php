<?php

// Initialize the session
session_start();

// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: welcome.php");
//     exit;
// }

$alerter = "";

// Include config file
require_once "config.php";

$course_sql = "SELECT `id`, `course` FROM `courses` WHERE `status` = 'active'";

$courses = DB::query($course_sql);

?>


<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Course Registration</title>
    <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    

    <link rel="stylesheet" ref="bootstrap/welcome.css">
    <link rel="stylesheet" ref="bootstrap/site.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
  </head>
  <body>

    <nav class="navbar static bg-primary">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand text-white" href="welcome.php">Payment for VIRA</a>
          </div>
          <!-- <ul class="nav navbar-nav navbar-right form-inline text-white">
            <li><a class="text-white" href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>  
            <li><a class="text-white" href="reset-password.php"><span class="glyphicon glyphicon-log-in text-white"></span> Reset Password</a></li>
            </ul> -->

            <form class="form-inline mt-2 mt-md-0">
                <a class="text-white mr-3" href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>  
                <a class="text-white" href="reset-password.php"><span class="glyphicon glyphicon-log-in text-white"></span> Reset Password</a></li>
          </form>
          </div>
        </nav>

        <!-- Alert -->
            <?php 
              if ($alerter == "success") {
              
            ?>
        <div class="alert alert-success mt-1 mr-5 ml-5">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Succesfully!</strong> Registered
        </div>
          <?php
            }
          ?>


<main role="main" class="container mt-5">
  <div class="jumbotron justify-content-between align-items-end">

    <div class="col-sm-6 mb-3">
        <select class="form-control" name="type" required>
          <option value="S" selected>Select Department</option>
          <option value="N">Computer Network Management</option>
          <option value="C">Computer Science</option>
        </select>
      </div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <ul class="list-group">
            <h4><li class="list-group-item active text-center">Courses Available</li></h4>
            <small><li class="list-group-item active text-center">Please register all courses</li></small>  

            <?php 
            foreach ($courses as $course) {
            ?>

            <li class="list-group-item d-flex justify-content-between align-items-center"><?= $course['course']?>
              <!-- <a href="#" id="add1" class="badge badge-primary">Add</a> -->
             <label><input type="checkbox" name="optradio" value="Graphic Design"></label>
            </li>

            <?php 
              }
            ?>

          </ul>
        <input type="submit" class="btn btn-primary text-center mt-5" name="submit" value="Confirm">
    </form>
  </div>
</main>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script> -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/reveal.js"></script>
      
  </body>
</html>
