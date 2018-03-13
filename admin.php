<!-- admin -->

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
    <link href="./../bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--https://bootsnipp.com/snippets/featured/login-and-register-tabbed-form -->
    <!-- Custom styles for this template -->
    <link href="customer.css" rel="stylesheet">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">OMTS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
      
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" data-toggle="tooltip" title="Home" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" data-toggle="tooltip" title="Browse Movies, Make Reservations" href="#">Browse Movies <span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" data-toggle="tooltip" title="View or cancel purchases" href="#">View Purchases <span class="sr-only">(current)</span></a>
                </li>
    
              </ul>
            </div>
          </nav>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        $(document).ready(function () {
            $('form').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: './add_customer.php',
                    data: $('#add_customer').serialize(),
                    success: function () {
                        alert('Customer added successfully!');
                    }
                });
            });
        });
    </script>
  </head>

  <body>

    

<div class="container">    
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-default">
                <div class="card-header">Admin Profile</div>
                <div class="card-body">
                    <h4 id="user-name">Test Name</h4>
                    <small><cite title="San Francisco, USA" id="user-city">San Francisco, USA <i class="glyphicon glyphicon-map-marker">
                    </i></cite></small>
                    <p>
                            <i class="glyphicon glyphicon-envelope" id="user-email"></i>email@example.com
                    </p>
                    <div class="btn-group">
                    <!-- load user info --> 
                    <!-- edit profile button-->
                    <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                    <button type="button" class="btn btn-warning">Edit Profile</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-9">
            <div class="card card-default">
                <div class="card-header">Popular</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>
                                Popular Movie
                            </h4>
                            <p id="popular-movie">
                                Tickets Sold:

                            </p>

                        </div>
                        <div class="col-sm-6">
                            <h4>
                                Popular Theatre Complex
                            </h4>
                            <p id="popular-theater">
                                Tickets Sold:
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-default">
                <div class="card-header">Add Movie</div>
                <div class="card-body">
                    <form id="add_movie">
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
                        <!-- drop down???-->
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <select class="form-control" id="rating">
                                <option class="dropdown-item" href="#">PG</option>
                                <option class="dropdown-item" href="#">14-A</option>
                                <option class="dropdown-item" href="#">R</option>
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
                            <select class="form-control" id="supplier">
                                <!-- populate on load with supplir-->
                                
                                    <?php
                                        $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                                        $rows = $dbh->query('select name,phone_number from supplier');
                        
                                        foreach($rows as $row) {
                                            echo '<option class="dropdown-item" value="'.$row[1].'">'.$row[0].'</option>';
                                        }
                                        $dbh = null;
                                    ?>
                                    </select>
                            </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card card-default">
                <div class="card-header">Customers</div>
                <div class="card-body">
                    <div class="row">
                    <table class="table table-hover">
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
                                    echo '<tr id="'.$row[2].'"><td><div class="radio"><label><input type="radio" id="regular" name="optradio"></label></div></td><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[6].
                                    '</td><td>'.$row[3].'</td><td>'.$row[5].'</td><td>'.$row[7].', '.$row[8].', '.$row[9].'</td><tr>';
                                }
                                $dbh = null;
                            ?>
                        </tbody>
                        </table>
                        </div>
                        <div class="btn-group row">
                            <div class="col-sm-6">
                                <button type="button" id="customer-history" class="btn btn-primary">View Purchase History</button>
                                <!-- On button click, -->
                            </div>
                            <div class="col-sm-6">
                            <button type="button" id="customer-delete" class="btn btn-danger">Delete Account</button>
                            </div>
                        </div>


                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-header">Edit Showings</div>
                <div class="card-body"></div>
            </div>

        </div>
        <div class="col-lg-6">

        </div>
    </div>
</div>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <!--<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>-->
    <script src="./../bootstrap-4.0.0/assets/js/vendor/popper.min.js"></script>
    <script src="./../bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
  </body>
</html>