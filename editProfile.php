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
    <div class="col-md-6">
        <div class="card card-default">
          <div class="card-header"></div>

          <div class="card-body">
            <form action='' method='post'>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">User Profile</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                date_default_timezone_set('America/Toronto');
                $timezone = date_default_timezone_get();
                // echo "The current server timezone is: " . $timezone;
                $date = date('Y/m/d H:i:s');

                $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                $rows = $dbh->query("select * from customer where account_number = 1");
                foreach($rows as $row) {
                    echo "<tr>";
                    echo "<td>Account Number: ".$row["account_number"]."</td></tr>";
                    echo "<td>First Name: ".$row["fname"]."</td></tr>";
                    echo "<td>Last Name: ".$row["lname"]."</td></tr>";
                    echo "<td>Password: ".$row["password"]."</td></tr>";
                  }
                
                $dbh = null;
              ?>
                </tbody>
              </table>
              <!-- <div class="btn-group">
                <button type="submit" name="ReserveButton" id="reservation" class="btn btn-primary">Make Reservation</button>
              </div>
               ?php
                if (isset($_POST['ReserveButton'])) {
                  if(isset($_POST['optradio']))
                  {
                    echo "You have selected:" .$_POST['optradio'];
                  }
                }
              ? -->
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
