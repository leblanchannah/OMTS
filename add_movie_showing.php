<?php include 'adminnavbar.php'?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./../bootstrap-4.0.0favicon.ico">

    <title>Admin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha18/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha18/css/tempusdominus-bootstrap-4.min.css" />

    <link href="customer.css" rel="stylesheet">


  </head>
<body>
 <div class="container">
    <div class="row">
        <div class="col-md-12">
        <?php
            $complex = $_POST["tcomplex2"]; 
            $theatre = $_POST["theatres2"];
            $movie_id = $_POST["movies"];
            $date = $_POST["datepickeradd"];
            $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
            try {
              $stmt = $dbh->prepare("insert into showing values(:st, :movie, :theatrenum,:complex)");
            //     // insert a row    
              if ($stmt->execute(array(':st' => $date, ':movie' => $movie_id,':theatrenum'=> $theatre,':complex'=>$complex))) {
            //         // success
                    echo '<div class="alert alert-primary" role="alert">
                    Showing creation successful, please return to <a href="admin.php">admin homepage</a>!
                    </div>';
                    } else {
                    // failure
                    echo '<div class="alert alert-danger" role="alert">
                    Showing creation unsuccessful, please return to <a href="admin.php">admin homepage</a> and try again!
                    </div>';
                    }
                
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger" role="alert">
                    Showing creation unsuccessful, please return to <a href="admin.php">admin homepage</a> and try again!
                    </div>';
            }
            
                    $dbh = null;
        ?>
        </div>
    </div>
</div>

          <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <!--<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>