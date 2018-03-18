<!doctype html>
<?php include 'adminnavbar.php'?>
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
    <!--https://bootsnipp.com/snippets/featured/login-and-register-tabbed-form -->
    <!-- Custom styles for this template -->
    <link href="customer.css" rel="stylesheet">

          </head>

          <body>
          <div class="container">  
            <div class="row">
                <div class="col-lg-9">
                <div class="jumbotron">
                        <!-- show all of users past purchase history-->
                        <form id="customer_table" action="customer_history.php" method="post">
                        <table class="table table-hover table-responsive " id="all_customers">
                            <thead>
                            <!--
                                SELECT title,fname,lname,seats_reserved,booking_time,cancel_flag FROM (SELECT fname,lname,seats_reserved,booking_time,cancel_flag,movie_id FROM reserves INNER JOIN customer ON customer.account_number=reserves.account_number WHERE reserves.account_number=2) reservations INNER JOIN movie ON movie.movie_id = reservations.movie_id ORDER BY booking_time ASC
                                -->
                                <tr>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Title</th>
                                <th scope="col">Seats Reserved</th>
                                <th scope="col">Booking</th>
                                <th scope="col">Cancelled</th>
                            
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                                    $rows = $dbh->query('SELECT title,fname,lname,seats_reserved,booking_time,cancel_flag FROM (SELECT fname,lname,seats_reserved,booking_time,cancel_flag,movie_id FROM reserves INNER JOIN customer ON customer.account_number=reserves.account_number WHERE reserves.account_number='.$_POST['customername'].') reservations INNER JOIN movie ON movie.movie_id = reservations.movie_id ORDER BY booking_time ASC');
                                    // add try catch
                                    // account number is id for the row so we can delete the rows with jquery later
                                    foreach($rows as $row) {
                                        echo '<tr id="'.$row[2].'"><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[0].
                                        '</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><tr>';
                                    }
                                    $dbh = null;
                                ?>
                            </tbody>
                            </table>
                            </div>
                        </form>
                                
                    </div>

                </div>
            </div>
        </div>

          </body>


