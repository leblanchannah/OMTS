<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="./../bootstrap-4.0.0favicon.ico">

  <title>Customer</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">

  <!--https://bootsnipp.com/snippets/featured/login-and-register-tabbed-form -->
  <!-- Custom styles for this template -->
  <link href="customer.css" rel="stylesheet">
  <?php
  include_once("navbar.php");
  ?>
</head>

<body>

<?php session_start(); ?>

<div class="container">
  <div class="row">
    <!-- Include the account info banner -->
    <?php include_once("editProfileSection.php") ?>

      <div class="col-md-9 mb-3">
        <div class="card card-default">
          <div class="card-header">Booking:
          <?php
            $num_tickets=$_POST['num_tickets'];
            list($num, $complexName, $start_time, $movie_id) = explode("|", $_POST['optradio']);
            $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
            $rows = $dbh->query("SELECT * FROM movie m where m.movie_id = $movie_id");
            $row = $rows ->fetch(); 
                echo $row['title']
                ." at "
                .$complexName;
          
            $dbh = null;
            ?>
            </div>
          <div class="card-body">
            <form action='make_reservation.php' method='post'>
              <table class="table table-hover">
                <thead>
                  <tr>
                        <th scope="col">Movie</th>
                        <th scope="col">Theatre Complex</th>
                        <th scope="col">Theatre</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">Seats Reserved</th>

                  </tr>
                </thead>
                <tbody>
                <?php
                date_default_timezone_set('America/Toronto');
                $timezone = date_default_timezone_get();
                $time = date('Y-m-d G:i');
                $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                echo "<tr>";
                echo "<td>".$row["title"]."</td>";
                echo "<td>".$complexName."</td>";
                echo "<td>".$num."</td>";
                echo "<td>".$start_time."</td>";
                echo "<td>".$num_tickets."</td>";
                echo "</tr>";
                $account_number = $_SESSION['user_id'];

                $check = $dbh->query("SELECT count(*) c FROM reserves r where( r.account_number = $account_number and r.num = $num and r.name =".$dbh->quote($complexName)." and r.start_time = ".$dbh->quote($start_time)." and movie_id = $movie_id)");
                $checker = $check ->fetch();

                if ($checker['c']==0){
                  $query = " INSERT INTO reserves (account_number, num, name, start_time, movie_id, seats_reserved, booking_time, cancel_flag)
                  VALUES (:account_number, :num, :name, :start_time, :movie_id, :seats_reserved, :booking_time, 0)";
              
                  $add = $dbh->prepare($query);
                  
                  $add->bindParam(':movie_id', $movie_id,PDO::PARAM_STR);
                  $add->bindParam(':num', $num,PDO::PARAM_STR);
                  $add->bindParam(':name', $complexName,PDO::PARAM_STR);
                  $add->bindParam(':start_time', $start_time,PDO::PARAM_STR);
                  $add->bindParam(':seats_reserved', $num_tickets,PDO::PARAM_STR);
                  $add->bindParam(':booking_time', $time,PDO::PARAM_STR);
                  $add->bindParam(':account_number',  $account_number,PDO::PARAM_STR);
                  if($add -> execute()){
                      echo "Confirmed Booking!";
                  }
                  else{
                    echo "It didnt work";
                  }
              }
              else{
                $query = "UPDATE reserves r SET 
                r.seats_reserved = :seats_reserved,
                r.booking_time = :booking_time,
                r.cancel_flag = 0
                 WHERE (r.account_number = :account_number 
                  and r.num = :num and r.name = :name 
                  and r.start_time = :start_time
                  and  movie_id = :movie_id)";

                $update = $dbh->prepare($query);
                
                $update->bindParam(':movie_id', $movie_id,PDO::PARAM_STR);
                $update->bindParam(':num', $num,PDO::PARAM_STR);
                $update->bindParam(':name', $complexName,PDO::PARAM_STR);
                $update->bindParam(':start_time', $start_time,PDO::PARAM_STR);
                $update->bindParam(':seats_reserved', $num_tickets,PDO::PARAM_STR);
                $update->bindParam(':booking_time', $time,PDO::PARAM_STR);
                $update->bindParam(':account_number',  $account_number,PDO::PARAM_STR);
                if($update -> execute()){
                    echo "Updated Booking on: ".$time. "with starting time: ".$start_time;
                }
                else{
                  echo "It didnt work";
                }
              }

                $dbh = null;
                
              ?>
                </tbody>
              </table>
            </form>
          </div>
          </div>

        </div>


      <!-- Bootstrap core JavaScript
    ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</body>

</html>
