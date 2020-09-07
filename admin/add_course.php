<?php
// Initialize the session
session_start();

if(!isset($_SESSION["loggedin"]) OR $_SESSION["loggedin"] === false){

    header("location: index.php");
    exit;
} elseif($_SESSION["status"] != 'admin'){
    header("location: ../login.php");
    exit;
}

// Include config file
require_once "../config.php";

$alerter = '';

if (isset($_POST['course'])){

  $course = $_POST['course'];

  $sql = "INSERT INTO `courses` (`course`) VALUES (:course);";

  $query = DB::query($sql, array(':course' => $course));

  if ($query) {
    
    $alerter = 'success';

  } else{
    $alerter = 'error';
  }

}

$course_sql = "SELECT `id`, `course` FROM `courses` WHERE `status` = 'active'";

$courses = DB::query($course_sql);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Add Course</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS -->
<!-- <link href="../assets/dist/css/bootstrap.css" rel="stylesheet"> -->
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">

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
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
   
   <?php 
      include("dash_side.php");
   ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Available Courses</h1>
      </div>

        <!-- Alert -->
       <?php 
         if ($alerter == "success") {
              
            ?>
        <div class="alert alert-success mt-1 mr-5 ml-5">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Succesfully!</strong> added
        </div>
          <?php
            } elseif($alerter == "error") {
                ?>
          <div class="alert alert-danger mt-1 mr-5 ml-5">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>ERROR:</strong> Occurred 
          </div>
            <?php
            }
        ?>
    
      <form action="" method="POST">
        <div class="form-group row">
          <div class="col-sm-6">
            <input type="text" name="course" class="form-control" placeholder="Add Course" required>
          </div>
          <div class="col-sm-4">
            <input type="submit" class="col-sm-6 btn btn-primary" name="submit" value="Add">
          </div>
        </div>
      </form>

      <h3 class="text-center">Added courses</h3>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Number</th>
              <th>Course</th>
            </tr>
          </thead>
          <tbody>
            
           <?php
            $course_count = 0;

            foreach ($courses as $course) {
             $course_count++;
             ?>
          
              <tr>
                <td><?= $course_count?></td>
                <td><?= $course['course']?></td>
              </tr>

             <?php

             } 
           ?>
          
          </tbody>
        </table>
      </div>
    </main>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
  <!-- <script src="dashboard.js"></script> -->

    <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../bootstrap/reveal.js"></script>
   </body>
</html>
