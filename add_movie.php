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

    <!--https://bootsnipp.com/snippets/featured/login-and-register-tabbed-form -->
    <!-- Custom styles for this template -->
    <link href="customer.css" rel="stylesheet">
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
                        $stmt = $dbh->prepare("insert into movie (title, director, length, rating, plot_synopsis, actors, production_company, supplier_phone_number)
                          values(:title, :director, :length,:rating, :plot_synopsis, :actors, :production_company, :supplier_phone_number)");
                        // insert a row    
                        if ($stmt->execute(array(':title' => $title, ':director' => $director,':length'=> $length,':rating'=>$rating,':plot_synopsis'=> $plotsynopsis,':actors'=> $actor, ':production_company'=> $productioncompany,':supplier_phone_number'=>$supplier))) {
                          // success
                            echo '<div class="alert alert-primary" role="alert">
                            Movie creation successful, please return to <a href="admin.php">admin homepage</a>!
                            </div>';
                          } else {
                          // failure
                          echo '<div class="alert alert-danger" role="alert">
                          Movie creation unsuccessful, please return to <a href="admin.php">admin homepage</a> and try again!
                          </div>';
                          }
                        
                    } catch (PDOException $e) {
                     echo '<div class="alert alert-danger" role="alert">
                          Movie creation unsuccessful, please return to <a href="admin.php">admin homepage</a> and try again!
                          </div>';
                    }
                    
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

    


