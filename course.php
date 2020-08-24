
<?php
  // Initialize the session
  session_start();

   $alerter = "";

  // Include config file
  require_once "config.php";


  //Insert into course table 
$checkbox1 = $_POST['optradio'] ;  
if ($_POST["Submit" ]=="Submit")  
{  
for ($i=0; $i<sizeof ($checkbox1);$i++) {  
$query="INSERT INTO courses VALUES ('".$checkbox1[$i]. "')";  
mysql_query($query) or die(mysql_error());  
}  
echo "Record is inserted";  
}  

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
    <!-- <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="#">Fixed navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline mt-2 mt-md-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav> -->

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
          <a href="display.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Succesfully!</strong> Saved 
        </div>
          <?php
            }
          ?>

<main role="main" class="container mt-5">
  <div class="jumbotron justify-content-between align-items-end">
    <!-- <h1>Courses Available</h1>
    <p class="lead">This example is a quick exercise to illustrate how fixed to top navbar works. As you scroll, it will remain fixed to the top of your browser’s viewport.</p>
    <a class="btn btn-lg btn-primary" href="../components/navbar/" role="button">View navbar docs &raquo;</a> -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <ul class="list-group">
            <h4><li class="list-group-item active text-center">Courses Available</li></h4>
            <small><li class="list-group-item active text-center">Please register all courses</li></small>  
            <li class="list-group-item d-flex justify-content-between align-items-center">Graphic Design
              <!-- <a href="#" id="add1" class="badge badge-primary">Add</a> -->
             <label><input type="checkbox" name="optradio" value="Graphic Design"></label>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Ethical Hacking
              <!-- <a href="#" class="badge badge-primary">Add</a> -->
              <label><input type="checkbox" name="optradio" value="Ethical Hacking"></label>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Web Development
              <!-- <a href="#" class="badge badge-primary">Add</a> -->
              <label><input type="checkbox" name="optradio" value="Web Development"></label>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Switching and Routing
              <!-- <a href="#" class="badge badge-primary">Add</a> -->
              <label><input type="checkbox" name="optradio" value="Switching and Routing"></label>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Hardware
              <!-- <a href="#" class="badge badge-primary">Add</a> -->
              <label><input type="checkbox" name="optradio" value="Hardware"></label>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Satellite Installation
              <!-- <a href="#" class="badge badge-primary">Add</a> -->
              <label><input type="checkbox" name="optradio" value="Satellite Installation"></label>
            </li>
          </ul>

        <button class="btn btn-primary text-center mt-5">Confirm</button>
    </form>
  </div>
</main>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script> -->
      <script>
        document.getElementById("add1").innerHTML = "Added";
      </script>
  </body>
</html>
