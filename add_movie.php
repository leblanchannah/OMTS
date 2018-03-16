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

    <!--https://bootsnipp.com/snippets/featured/login-and-register-tabbed-form -->
    <!-- Custom styles for this template -->
    <link href="customer.css" rel="stylesheet">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="admin.php">OMTS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" data-toggle="tooltip" title="Home" href="admin.php">Home <span class="sr-only">(current)</span></a>
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
    </script>
  </head>
  <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <?php
                    // // first get supplier phone number so that insert can be done
                    $title = $_POST["title"]; 
                    $director = $_POST["director"];
                    $length = $_POST["length"];
                    $rating = $_POST["rating"];
                    $actor = $_POST["actors"];
                    $plotsynopsis = $_POST["plotsynopsis"];
                    $productioncompany = $_POST["production_company"];
                    $supplier = $_POST["supplier"];
                    $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                    try {
                        $stmt = $dbh->prepare("insert into movie values(:title, :director, :length, :plot_synopsis, :actors, :production_company, :supplier_phone_number)");
                        $stmt->bindParam(':title', $title);    
                        $stmt->bindParam(':director', $director);    
                        $stmt->bindParam(':length', $length);
                        $stmt->bindParam(':plot_synopsis', $plotsynopsis);    
                        $stmt->bindParam(':actors', $actor);    
                        $stmt->bindParam(':production_company', $productioncompany);           
                        $stmt->bindParam(':supplier_phone_number', $suppliernum);  
                        // insert a row    
                        $stmt->execute();
                        
                    } catch (PDOException $e) {
                     echo '<div class="alert alert-danger" role="alert">
                          Movie creation unsuccessful, please return to <a href="admin.php">homepage</a> and try again!
                          </div>';
                    }
                    echo '<div class="alert alert-primary" role="alert">
                          Movie creation successful, please return to <a href="admin.php">homepage</a>!
                          </div>';
                          $dbh = null;
                ?>
                </div>
            </div>
        </div>

          <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <!--<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>

    


