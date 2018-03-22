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

<?php session_start(); ?>

<div class="container">
  <div class="row">
    <!-- Include the account info banner -->
    <?php include_once("editProfileSection.php") ?>

      <div class="col-md-9">
        <div class="card card-default">
          <div class="card-header">Reviews for:
          <?php
            $_POST = $_SESSION['browse_movies_post_data'];
            // unset($_SESSION['browse_movies_post_data']);

            $selected_movie = $_POST['reviews'];
            $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
            $rows = $dbh->query("SELECT * FROM movie m WHERE m.movie_id=$selected_movie");
            foreach($rows as $row) {
              echo $row['title'];
            }
            $dbh = null;
           ?>
           </div>
          <div class="card-body">
            <form action='reviews_actions.php' method='post'>
                <?php
                    $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                    $rows = $dbh->query("SELECT count(*) count FROM reviews r WHERE r.movie_id = $selected_movie");
                    $num_reviews = $rows->fetch()['count'];

                    $review_key = implode("|", array($selected_movie, $_SESSION['user_id']));

                    if ($num_reviews) {
                        $rows = $dbh->query("select fname, lname, review, title from customer c join (SELECT review, title, account_number FROM reviews r JOIN movie m on r.movie_id = m.movie_id WHERE r.movie_id = $selected_movie) movie_reviews on c.account_number = movie_reviews.account_number");
                        echo '<div class="row">';
                        foreach($rows as $row) {
                                echo '<div class="col-sm-6">'.
                                  '<div class="card mb-4">'.
                                    '<div class="card-body">'.
                                      '<h5 class="card-title">'.$row['title'].'</h5>'.
                                      '<p class="card-text">'.$row['review'].'</p>'.
                                      '<p class="card-text">- '.$row['fname'].' '.$row['lname'].'</p>'.
                                    '</div>'.
                                  '</div>'.
                                '</div>';
                              }
                              echo '</div>';
                    } else {
                        echo "There are no reviews for this movie at the moment. Please check again later or leave your own.<br>";
                    }

                    $rows = $dbh->query("SELECT count(*) count FROM reviews r WHERE r.movie_id = $selected_movie AND r.account_number =".$_SESSION['user_id']);
                    $review_count = $rows->fetch()['count'];
                    if ($review_count) {
                        echo '<br><div class="form-group">'
                        .'<label for="update_review_text">Update Review:</label>'
                        .'<textarea class="form-control" id="update_review_text" name="update_review_text" rows="3"></textarea>'
                        .'</div>'
                        .'<button type="submit" name="update_review" id="update_review" value='.$review_key.' class="btn btn-primary">Update My Review</button>'
                        .'<button type="submit" name="delete_review" id="delete_review" value='.$review_key.' class="btn btn-danger">Delete My Review</button>';
                    } else {
                        echo '<br><div class="form-group">'
                        .'<label for="new_review_text">Leave a Review:</label>'
                        .'<textarea class="form-control" id="new_review_text" name="new_review_text" rows="3"></textarea>'
                        .'</div>'
                        .'<button type="submit" name="new_review" id="new_review" value='.$review_key.' class="btn btn-primary">Post Review</button>';
                    }
                    $dbh = null;
                ?>
            </form>
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

</body>

</html>
