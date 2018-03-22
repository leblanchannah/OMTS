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


<?php session_start();
 ?>

  <div class="container">

    <div class="row">
      <!-- Include the account info banner -->
      <?php include_once("editProfileSection.php") ?>

      <div class="col-md-9">
        <div class="card card-default">
          <div class="card-header">Select a Theatre Complex</div>

          <div class="card-body">
          <form action='showings_by_complex.php' method='post'>
            <?php
              $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
              $rows = $dbh->query("SELECT c.name, c.street, c.city, c.postal_code, c.phone_number FROM theatre_complex c");
              echo '<div class="row">';
              foreach($rows as $row) {
                      echo '<div class="col-sm-6">'.
                        '<div class="card mb-4">'.
                          '<div class="card-body">'.
                            '<h5 class="card-title">'.$row['name'].'</h5>'.
                            '<p class="card-text">'.$row['street'].'</p>'.
                            '<p class="card-text">'.$row['city'].'</p>'.
                            '<p class="card-text">'.$row['postal_code'].'</p>'.
                            '<p class="card-text">'.$row['phone_number'].'</p>'.
                            '<button type="submit" name="selected_theatre_complex" id="selected_theatre_complex" value='.$row['name'].' class="btn btn-primary">Select Theatre</button>'.
                          '</div>'.
                        '</div>'.
                      '</div>';
                    }
                    echo '</div>';
            ?>
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
