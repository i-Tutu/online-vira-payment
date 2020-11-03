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
require_once "sms.php";

$alerter = '';

function getReferenceCode(){
    global $userID;

    $code = DB::query("SELECT `payment_code` from `payment` where `id_user` = '$userID'");
    if(DB::count("SELECT `payment_code` from `payment` where `id_user` = '$userID'") > 0){
        return $code[0][0];
    } else{
      $code = ref_generate();
      DB::query("INSERT INTO `payment`(`id_user`, `payment_code`) VALUES ('$userID', '$code')");
      getReferenceCode();
    }
}

function ref_generate(){
    global $con;
    $generated_ref = rand(1000,9999);
    $ref_pin_query = DB::query("SELECT * from `payment` where `payment_code` = '$generated_ref'");
    if(DB::count("SELECT * from `payment` where `payment_code` = '$generated_ref'") > 0){
        ref_generate();
    } else{
        return $generated_ref;
    }
}

// Inserting courses into in db
if (isset($_POST['receipient'])){

  $receipient = $_POST['receipient'];
  $code = ref_generate();
  $message = "Your Vira Registration Code is: ".$code." Use this Code To Activate Course Registration";
  $query = DB::query("INSERT INTO `payment`(`receipient`, `payment_code`) VALUES ('$receipient', '$code')");
  SMS::send($receipient, $message);

  if ($query) {

    $alerter = 'success';

  } else{
    $alerter = 'error';
  }

}

if (isset($_POST['delete'])){

  $code_id = $_POST['code_id'];

  $code_del = "UPDATE `payment` SET `Status` = 'cancelled' WHERE id = (:code_id)";
  $deleted = DB::query($code_del, array(':code_id' => $code_id));

  if ($deleted) {

    $alerter = 'success';

  } else{
    $alerter = 'error';
  }

}

// Select from db
$code_sql = "SELECT `id`, `payment_code`, `receipient` FROM `payment` WHERE `status` = 'issued'";
$codes = DB::query($code_sql);




?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Registration & Payment</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS -->
<!-- <link href="../assets/dist/css/bootstrap.css" rel="stylesheet"> -->
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../fontawesome/css/all.min.css" rel="stylesheet">

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
        <h1 class="h2">Registraion Area</h1>
      </div>

        <!-- Alert -->
       <?php
         if ($alerter == "success") {

            ?>
        <div class="alert alert-success mt-1 mr-5 ml-5">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong>
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
            <input type="text" name="receipient" class="form-control" placeholder="Receipient Number" required>
          </div>
          <div class="col-sm-4">
            <input type="submit" class="col-sm-6 btn btn-primary" name="submit" value="Send Code">
          </div>
        </div>
      </form>

      <h3 class="text-center">Added Codes</h3>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Code</th>
              <th>Receipient</th>
              <th></th>
            </tr>
          </thead>
          <tbody>

           <?php
            foreach ($codes as $code) {
             ?>

              <tr>
                <td> #<?= $code['payment_code']?> </td>
                <td> <?= $code['receipient']?> </td>

                  <form action="" method="POST">
                    <td>
                      <input type="hidden" name="code_id" value="<?=$code['id']?>">
                      <input type="submit" name="delete" class="btn btn-primary btn-lx" value="x">
                    </td>
                  </form>
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
