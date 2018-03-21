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



  <div class="container">

    <div class="row">
      <div class="col-md-3">
        <div class="card card-default">
          <div class="card-header">Customer Profile</div>
          <div class="card-body">
            <h4 id="user-name">Test Name</h4>
            <small>
              <cite title="San Francisco, USA" id="user-city">San Francisco, USA
                <i class="glyphicon glyphicon-map-marker">
                </i>
              </cite>
            </small>
            <p>
              <i class="glyphicon glyphicon-envelope" id="user-email"></i>email@example.com
            </p>
            <form action= "editProfile.php" method="post">
            <div class="btn-group">
              <!-- load user info -->
              <!-- edit profile button-->
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
              <button type="submit" class="btn btn-danger">Edit Profile</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card card-default">
        <?php
            if (isset($_POST['ReserveButton'])) {
              if(isset($_POST['optradio']))
              {
              // echo "You have selected:" .$_POST['optradio'];
              $movie_id = $_POST['optradio'];
              }
          }
          $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
          $rows = $dbh->query("select m.title, m.length, m.rating, m.plot_synopsis, m.actors, m.director, m.production_company from movie m where m.movie_id = $movie_id");
          foreach($rows as $row) {
            // print_r($row);
            echo '<div class="card-header">'.$row['title'].' ('.$row['length'].' mins) - '.$row['rating'].'</div>';
              echo '<div class="card-body">';
              echo $row['plot_synopsis'].'<br>';
              echo $row['production_company'].'<br>';
              echo $row['director'].'<br>';
              echo $row['actors'].'<br>';
        }
        ?>
            <form action='make_reservation.php' method='post'>
              <table class="table table-hover">
                <thead>
                  <tr>
                  <th scope="col"></th>
                        <th scope="col">Movie</th>
                        <th scope="col">Theatre Complex</th>
                        <th scope="col">Theatre</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">Seats Available</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                    if (isset($_POST['ReserveButton'])) {
                      if(isset($_POST['optradio']))
                      {
                      // echo "You have selected:" .$_POST['optradio'];
                      $movie_id = $_POST['optradio'];
                      }
                  }
                    date_default_timezone_set('America/Toronto');
                    $timezone = date_default_timezone_get();
                    // echo "The current server timezone is: " . $timezone;
                    $date = date('Y-m-d');

                    $rows = $dbh->query("SELECT title, name, num, start_time, avail,movie.movie_id FROM (SELECT all_seats.start_time, all_seats.movie_id, all_seats.num, all_seats.name, (all_seats.max_seats-IFNULL(available_seats.booked,0)) avail FROM (SELECT start_time,movie_id,showing.num,showing.name,theatre.max_seats FROM showing INNER JOIN theatre ON showing.num = theatre.num AND showing.name = theatre.name) all_seats LEFT OUTER JOIN (SELECT name, num, start_time, movie_id, SUM(seats_reserved) as booked FROM reserves GROUP BY name, num, start_time, movie_id) available_seats ON all_seats.start_time = available_seats.start_time AND all_seats.num = available_seats.num AND all_seats.name=available_seats.name GROUP BY all_seats.start_time, all_seats.num, all_seats.name) seats LEFT JOIN movie ON seats.movie_id = movie.movie_id WHERE movie.movie_id = $movie_id");
                foreach($rows as $row) {
                  if ($date <= $row["start_time"]) { // only displaying showings that are active

                  echo '<tr><td><div class="radio"><label><input type="radio"" id="movie" name="moviename" value="'.$row[5].'"></label></div></td><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].
                  '</td><td>'.$row[3].'</td><td>'.$row[4].'</td>'.'<input type="hidden" name="oldcomplex" value="'.$row[1].'"/>'.
                  '<input type="hidden" name="oldnum" value="'.$row[2].'"/>'.
                  '<input type="hidden" name="oldtime" value="'.$row[3].'"/>'.
                  '<input type="hidden" name="movie_id" value="'.$row[5].'"/>'.
                  '</tr>';
                  }
                }
                // }
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
