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

$students_sql = "SELECT `id`, `username`, `index_number`, `department`, `level` FROM `users` WHERE 1";

$students = DB::query($students_sql);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Students Registered</title>

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
        <h1 class="h2">Dashboard</h1>
        <!-- <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div> -->
      </div>

      <h3 class="text-center">Students enrolled</h3>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Number</th>
              <th>Name</th>
              <th>Index Number</th>
              <th>Programme</th>
              <th>Level</th>
            </tr>
          </thead>
          <tbody>

            <?php 
              $student_count = 0;

              foreach ($students as $student) {
                $student_count++; 
            ?>

            <tr>
              <td><?= $student_count?></td>
              <td><?= $student['username']?></td>
              <td><?= $student['index_number']?></td>
              <td><?= $student['department']?></td>
              <td><?= $student['level']?></td> 
            </tr>

            <?php

               }

            ?>
            



            <!-- <tr>
              <td>2</td>
              <td>Full name</td>
              <td>04/2018/1778D</td>
              <td>Computer Networking Management</td>
              <td>100</td>
            </tr> -->

          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script>

 <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../bootstrap/reveal.js"></script>

      </body>
</html>
