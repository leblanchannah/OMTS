<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="./../bootstrap-4.0.0favicon.ico">

  <title>Old Rentals</title>

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
<?php session_start(); ?>
  <div class="container">

<div class="row">
  <?php 
  include_once("editProfileSection.php");
  ?>
      <div class="col-md-9">
        <div class="card card-default">
          <div class="card-header">Past Rentals</div>
          <div class="card-body">

          <form action='setCancelPurchaseFlag.php' method='post'>

            <table class="table table-hover">
              <thead>
                <tr>
                <th scope="col"></th>
                  <th scope="col">Title</th>
                  <th scope="col">Theatre Complex</th>
                  <th scope="col">Booking Time</th>
                  <th scope="col">Quantity</th>
                </tr>
              </thead>
              <?php 
              echo '<tbody>';
              // connect to database
              $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
              // run query
              $oldRentals = $dbh->query("select * from reserves  
              rev JOIN movie  mov ON mov.movie_id =  rev.movie_id 
              where ".$_SESSION['user_id']." = account_number");
              //Create my table 
              foreach($oldRentals as $temp){
                 $multi_key = implode("|", array($temp['num'], $temp['name'], $temp['start_time'], $temp['movie_id']));
                 // if ($date <= $row["start_time"]) { // only displaying showings that are active
                    echo "<tr>";
                    echo "<td><div class='radio'><label><input type='radio' id='regular' name='cancel_purchase' checked value='".$multi_key."'></label></div></td>";
              echo '<td>'.$temp['title'].'</td><td>'.$temp['name'].'</td><td>'.$temp['booking_time'].'</td><td>'.$temp['seats_reserved'].'</td></tr>';
              }
              echo '</body>';
              
              
              $dbh = null;
              $oldRentals = null;
              
              ?>
            
              <!--THIS IS A TEMPLATE
                   <tbody>
                <tr>
                  <td>
                    <div class="radiotext">
                      <label for='movie1'>Movie 1</label></div>
                  </td>

                  <td>Otto</td>
                  <td>@mdo</td>

                </tr>
                <tr>
                  <td>
                    <div class="radiotext">
                      <label for='movie2'>Movie 2</label>
                  </td>

                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <td>Larry the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody> -->
            </table>
            <input class="btn btn-primary" type="submit" value="Cancel Purchase">
            </form>
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
<body>

</body>
</html>
