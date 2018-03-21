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
      <?php
  include_once("editProfileSection.php");
  ?>
      <div class="col-md-9">
        <div class="card card-default">
          <div class="card-header">What's Playing</div>

          <div class="card-body">
            <form action='make_reservation.php' method='post'>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Movie Title</th>
                    <th scope="col">Theatre Complex</th>
                    <th scope="col">Street</th>
                    <th scope="col">City</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                date_default_timezone_set('America/Toronto');
                $timezone = date_default_timezone_get();
                // echo "The current server timezone is: " . $timezone;
                $date = date('Y-m-d');

                $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                $rows = $dbh->query("select m.title, p.name, c.street, c.city, p.start_date, p.end_date, m.movie_id from playing p, theatre_complex c join movie m where p.movie_id = m.movie_id and p.name = c.name");
                foreach($rows as $row) {
                  if ($date >= $row["start_date"] && $date <= $row["end_date"]) { // only displaying showings that are active
                    echo "<tr>";
                    echo "<td><div class='radio'><label><input type='radio' id='regular' name='optradio' value='".$row['movie_id']."'></label></div></td>";
                    echo "<td>".$row["title"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["street"]."</td>";
                    echo "<td>".$row["city"]."</td>";
                    echo "</tr>";
                  }
                }
                $dbh = null;
              ?>
                </tbody>
              </table>
              <div class="btn-group">
                <button type="submit" name="ReserveButton" id="reservation" class="btn btn-primary">Make Reservation</button>
              </div>
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
