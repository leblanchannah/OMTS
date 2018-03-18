<!-- admin -->
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
    <!--https://bootsnipp.com/snippets/featured/login-and-register-tabbed-form -->
    <!-- Custom styles for this template -->
    <link href="customer.css" rel="stylesheet">


    <script>
        $(document).ready(function () {
            $('#goodcall').fadeToggle("slow");
            $('#badcall').fadeToggle("slow");
            $('#customer-delete').on('click', function (e) {
                e.preventDefault();
                console.log("customer-delete button clicked");
                $.ajax({
                    type: 'post',
                    url: 'delete_customer.php',
                    data: $('#customer_table').serialize(),
                    success:function(data) {
                        if (data != "error") {
                            $('table#all_customers tr#'+data).remove();
                            $('#goodcall').text("Success: deleted user.")
                            $('#goodcall').fadeToggle("slow");
                            $('#goodcall').fadeToggle("slow");
                        } else {
                            alert("Unable to delete user.");
                            $('#badcall').text("Error: unable to delete user.")
                            $('#badcall').fadeToggle("slow");
                            $('#badcall').fadeToggle("slow");

                        }
                    }
                });
            });
        $( "#customer_table input:radio" ).prop("checked", true);
        });
    </script>
  </head>
<body>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="alert alert-success" id="goodcall"></div>
      <div class="alert alert-danger" id="badcall"></div>
    </div>
    <!--/.col-sm-12 -->
  </div>
  <!-- /.row> -->
  <div class="row">
    <div class="col-md-3">
      <div class="card card-default">
        <div class="card-header">Add Movie</div>
        <div class="card-body">
          <form id="add_movie" method="post" action="add_movie.php">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="">
            </div>
            <div class="form-group">
              <label for="director">Director</label>
              <input type="text" class="form-control" id="director" name="director" placeholder="">
            </div>
            <div class="form-group">
              <label for="length">Length</label>
              <input type="text" class="form-control" name="length" id="length" placeholder="">
            </div>
            <div class="form-group">
              <label for="plotsynopsis">Plot Synopsis</label>
              <input type="text" class="form-control" name="plotsynopsis" id="plotsynopsis" placeholder="">
            </div>
            <!-- drop down???-->
            <div class="form-group">
              <label for="rating">Rating</label>
              <select class="form-control" id="rating" name="rating">
                            <option class="dropdown-item" name="1" value="G">G</option>
                            <option class="dropdown-item" name="2" value="PG">PG</option>
                            <option class="dropdown-item" name="3" value="14-A">14-A</option>
                            <option class="dropdown-item" name="4" value="18-A">18-A</option>
                            <option class="dropdown-item" name="5" value="R">R</option>
                            </select>

            </div>
            <div class="form-group">
              <label for="actors">Actors</label>
              <input type="text" class="form-control" id="actors" name="actors" placeholder="">
            </div>
            <!-- drop down -->
            <div class="form-group">
              <label for="productioncompany">Production Company</label>
              <input type="text" class="form-control" id="productioncompany" name="production_company" placeholder="">
            </div>
            <!-- supplier dropdown -->
            <div class="form-group">
              <label for="supplier">Supplier</label>
              <select class="form-control" name="supplier">
                        <?php
                        // add try catch
                            $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                            $rows = $dbh->query('select name,phone_number from supplier');

                            foreach($rows as $row) {
                                 echo '<option class="dropdown-item" name="supplier" value="'.$row[1].'">'.$row[0].'</option>';
                            }
                            $dbh = null;

                         ?>

          </select><button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </form>


    </div>
    </div>
  </div>
  <!-- /.col-lg-3 -->
  <div class="col-md-9">
    <div class="row">
    <div class="col-md-12">
    
      <div class="card card-default">
        <div class="card-header">Popular</div>
        <div class="card-body">
            <div class="row">
            <div class="col-sm-6">
              <h4>Popular Movie</h4>
              <?php
                                    $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                                    $row= $dbh->query("SELECT title, MAX(taken_seats) as popular FROM (SELECT movie_id, SUM(seats_reserved) as taken_seats FROM reserves GROUP BY movie_id) taken INNER JOIN movie ON movie.movie_id=taken.movie_id");
                                    $results = $row->fetchAll(PDO::FETCH_ASSOC);
                                    echo '<p id="popular-movie">'.$results[0]['title'].'<br> Tickets Sold: '.$results[0]['popular'].'</p>';
                                    $dbh = null;
                                ?>
            </div>
            <div class="col-sm-6">
              <h4>Popular Theatre Complex</h4>
              <?php
                                $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                                $row= $dbh->query("SELECT name, MAX(seats) as popular FROM (SELECT name, SUM(seats_reserved) as seats FROM `reserves` GROUP BY name) count_seats");
                                $results = $row->fetchAll(PDO::FETCH_ASSOC);
                                echo '<p id="popular-movie">'.$results[0]['name'].'<br> Tickets Sold: '.$results[0]['popular'].'</p>';
                                $dbh = null;
                            ?>
            </div>
          </div>
          </div>
          </div>

      </div>


    <!-- /.row> -->
  </div>

<!-- /.row> -->
<br>
<div class="row">
    <div class="col-md-12">
  <div class="card card-default">
    <div class="card-header">Customers</div>
    <div class="card-body">
      <form id="customer_table" action="customer_history.php" method="post">
        <div class="row">
          <table class="table table-hover table-responsive" id="all_customers">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Login Id</th>
                <th scope="col">Address</th>

              </tr>
            </thead>
            <tbody>
              <?php
                                $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                                $rows = $dbh->query("select * from customer");
                                // add try catch
                                // account number is id for the row so we can delete the rows with jquery later
                                foreach($rows as $row) {
                                    echo '<tr id="'.$row[2].'"><td><div class="radio"><label><input type="radio"" id="customers" name="customername" value='.$row[2].'></label></div></td><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[6].
                                    '</td><td>'.$row[3].'</td><td>'.$row[5].'</td><td>'.$row[7].', '.$row[8].', '.$row[9].'</td><tr>';
                                }
                                $dbh = null;
                            ?>
            </tbody>
          </table>
        </div>
        <div class="btn-group row">
          <div class="col-sm-6">
            <button type="submit" id="customer-history" class="btn btn-primary">View Purchase History</button>
            <!-- On button click, -->
          </div>
          <div class="col-sm-6">
            <button type="button" id="customer-delete" class="btn btn-danger">Delete Account</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  </div>
  </div>
  </div>
    <!-- /.col-lg-9 -->
</div>
</div>
<!-- /.row> -->
<!-- /. container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>