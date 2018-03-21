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
          <div class="card-header"><?php echo $_POST['selected_theatre_complex'] ?></div>
          <div class="card-body">
          <?php
            $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
            $rows = $dbh->query('SELECT * FROM theatre_complex c WHERE c.name ='.'"'.$_POST['selected_theatre_complex'].'"');
            foreach($rows as $row) {
              echo $row['street'].'<br>';
              echo $row['city'].'<br>';
              echo $row['postal_code'].'<br>';
              echo $row['phone_number'].'<br>';
            }

            $dbh = null;
          ?>

            <form action='make_reservation.php' method='post'>
              <table class="table table-hover">
                <thead>
                  <tr>
                  <th scope="col"></th>
                        <th scope="col">Movie</th>
                        <th scope="col">Theatre</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">Seats Available</th>

                  </tr>
                </thead>
                <tbody>
                <?php
                date_default_timezone_set('America/Toronto');
                $timezone = date_default_timezone_get();
                $date = date('Y-m-d');

                $theatre_complex = $_POST['selected_theatre_complex'];

                $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                $rows = $dbh->query('select s.start_time, s.num, m.title, m.movie_id from showing s join movie m on s.movie_id = m.movie_id where s.name ='.'"'.$theatre_complex.'"');
                foreach($rows as $row) {
                  if ($date <= $row["start_time"]) { // only displaying showings that are active
                    echo "<tr>";
                    echo "<td><div class='radio'><label><input type='radio' id='regular' name='optradio' value='".$row['movie_id']."'></label></div></td>";
                    echo "<td>".$row["title"]."</td>";
                    echo "<td>".$row["num"]."</td>";
                    echo "<td>".$row["start_time"]."</td>";
                    echo "</tr>";
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
