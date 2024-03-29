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
          <div class="card-header">Showing for:
          <?php
            list($num, $name, $start_time, $movie_id) = explode("|", $_POST['selected_showing']);
            $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
            $rows = $dbh->query("SELECT * FROM movie m where m.movie_id = $movie_id");
            foreach($rows as $row) {
                echo $row['title']
                ." at "
                .$name;
            }
            $dbh = null;
            ?>
            </div>
          <div class="card-body">
            <form action='reservation_confirmation.php' method='post'>
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
                date_default_timezone_set('America/Toronto');
                $timezone = date_default_timezone_get();
                $date = date('Y-m-d G:i');

                $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                // $rows = $dbh->query('select s.start_time, s.num, m.title, m.movie_id from showing s join movie m on s.movie_id = m.movie_id where s.name ='.'"'.$theatre_complex.'"');
                $rows = $dbh->query("SELECT title, num, name, start_time, avail, movie.movie_id FROM (SELECT all_seats.start_time, all_seats.movie_id, all_seats.num, all_seats.name, (all_seats.max_seats-IFNULL(available_seats.booked,0)) avail FROM (SELECT start_time,movie_id,showing.num,showing.name,theatre.max_seats FROM showing INNER JOIN theatre ON showing.num = theatre.num AND showing.name = theatre.name) all_seats LEFT OUTER JOIN (SELECT name, num, start_time, movie_id, SUM(seats_reserved) as booked FROM reserves GROUP BY name, num, start_time, movie_id) available_seats ON all_seats.start_time = available_seats.start_time AND all_seats.num = available_seats.num AND all_seats.name=available_seats.name GROUP BY all_seats.start_time, all_seats.num, all_seats.name) seats LEFT JOIN movie ON seats.movie_id = $movie_id WHERE name =".$dbh->quote($name)."AND num=$num AND movie.movie_id=$movie_id");
                foreach($rows as $row) {
                  // num, name, start_time, movie_id
                  $multi_key = implode("|", array($row['num'], $name, $row['start_time'], $row['movie_id']));
                  if ($date <= $row["start_time"]) { // only displaying showings that are active
                    echo "<tr>";
                    echo "<td><div class='radio'><label><input type='radio' id='regular' name='optradio' value='".$multi_key."' checked></label></div></td>";
                    echo "<td>".$row["title"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["num"]."</td>";
                    echo "<td>".$row["start_time"]."</td>";
                    echo "<td>".$row["avail"]."</td>";
                    echo "</tr>";
                  }
                }
                $dbh = null;
              ?>
                </tbody>
              </table>
              <div class="form-group">
              <label for="num_tickets"># of Tickets</label>
              <select class="form-control" id="num_tickets" name="num_tickets">
                <?php
              for( $i = 1; $i<$row["avail"]+1; $i++ ) {
                          echo"  <option class='dropdown-item' name=$i value=$i>$i</option>";
              }
              ?>
                            </select>

            </div>

              <!-- <label for="num_tickets"># of Tickets</label>
              <input class="form-control col-md-3 mb-3" id="num_tickets" name="num_tickets" type="text" value="1">
               -->
              <input class="btn btn-primary" type="submit" value="Reserve Seats">
            </form>
          </div>
          </div>

        </div>


    <div class="col-md-6">
        <div class="card card-default mb-3">
          <div class="card-header">Contact Details</div>
          <div class="card-body">
          <?php
            $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
            $rows = $dbh->query('SELECT * FROM theatre_complex c where c.name='.$dbh->quote($name));
            foreach($rows as $row) {
                echo $row['name']."<br>";
                echo $row['city']."<br>";
                echo $row['street']."<br>";
                echo $row['postal_code']."<br>";
                echo $row['phone_number']."<br>";
            }
            $dbh = null;
            ?>
          </div>
          </div>
          </div>


    <div class="col-md-6">
        <div class="card card-default">
          <div class="card-header">Movie:
          <?php
            $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
            $rows = $dbh->query("SELECT * FROM movie m where m.movie_id = $movie_id");
            foreach($rows as $row) {
                echo $row['title'];
            }
            $dbh = null;
            ?>
            </div>
          <div class="card-body">
          <?php
            $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
            $rows = $dbh->query("SELECT * FROM movie m where m.movie_id = $movie_id");
            foreach($rows as $row) {
                echo "Director: ".$row['director']."<br>";
                echo "Length: ".$row['length']." mins<br>";
                echo "Rating: ".$row['rating']."<br>";
                echo "Actors: ".$row['actors']."<br>";
                echo "Synopsis: ".$row['plot_synopsis']."<br>";
                echo "Production Company: ".$row['production_company']."<br>";
            }
            $dbh = null;
            ?>
          </div>
          </div>
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
