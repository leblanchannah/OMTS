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
print_r($_POST);
$errorMessage = "error";

if (isset($_POST) && !empty($_POST)) {
    $start_time = $_POST["datepicker"]; 
    $movie = $_POST["moviename"];
    $complex = $_POST["tcomplex"];
    $theatre_num = $_POST["theatres"];
    $old_start_time = $_POST["oldtime"]; 
    $old_complex = $_POST["oldcomplex"];
    $old_theatre_num = $_POST["oldnum"];
    //$movie_id = $_POST["movie_id"];

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
        // set the PDO error mode to exception
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        //$sql = "UPDATE showing SET start_time=:time, movie_id=:movie, num=:tnum, name=:tcomplex WHERE movie_id=:movie AND start_time=:oldstart AND num=:oldnum AND name:=oldname";
    
        // Prepare statement
        //$stmt = $conn->prepare($sql);
    
        // execute the query
       // $stmt->execute();
    
        // echo a message to say the UPDATE succeeded
        //echo $stmt->rowCount() . " records UPDATED successfully";
       // }
    
    } catch (PDOException $e) {
        echo $errorMessage;
    }
    $dbh = null;
} else {
    echo $errorMessage;
}
?>

    </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>

  </html>