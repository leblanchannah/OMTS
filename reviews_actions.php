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

<?php
    session_start();

    $error_html = '<div class="alert alert-danger" role="alert">Review action unsuccessful, please <a href="reviews.php">go back</a> and try again.</div>';

    if(isset($_POST['new_review'])) {
        list($selected_movie, $user_id) = explode("|", $_POST['new_review']);
        $review_text = $_POST['new_review_text'];

        $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
        try {
            $stmt = $dbh->prepare("insert into reviews values(:review, :movieid, :accountnum)");
              // insert a row
            if ($stmt->execute(array(':review' => $review_text, ':movieid' => $selected_movie, ':accountnum' => $user_id))) {
               // success
               header("Location: reviews.php");
               } else {
               // failure
               echo $error_html;
               }

         } catch (PDOException $e) {
            echo $error_html;
         }
         $dbh = null;

    } else if (isset($_POST['update_review'])) {
        list($selected_movie, $user_id) = explode("|", $_POST['update_review']);
        $review_text = $_POST['update_review_text'];

        $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
        try {
            $query = "UPDATE reviews r SET
            r.review = :updatereview WHERE
            r.account_number = :account_id AND
            r.movie_id = :movieid";

            $update = $dbh->prepare($query);

            $update->bindParam(':updatereview', $review_text, PDO::PARAM_STR);
            $update->bindParam(':account_id', $user_id, PDO::PARAM_INT);
            $update->bindParam(':movieid', $selected_movie, PDO::PARAM_INT);

            if($update->execute()){
                header("Location: reviews.php");
            } else{
                echo $error_html;
            }
        } catch (PDOException $e) {
            echo $error_html;
        }
        $dbh = null;

    } else if (isset($_POST['delete_review'])) {
        list($selected_movie, $user_id) = explode("|", $_POST['delete_review']);

        $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
        try {
            $stmt = $dbh->prepare("DELETE FROM reviews WHERE account_number=:account_id");

            if ($stmt->execute(array(':account_id' => $user_id))) {
            // success
                header("Location: reviews.php");
            } else {
            // failure
                echo $error_html;
            }
        } catch (PDOException $e) {
            echo $error_html;
        }
        $dbh = null;
    }
?>
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
