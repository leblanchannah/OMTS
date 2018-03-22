<?php
    session_start();
    $_SESSION['browse_movies_post_data'] = $_POST;
    if(isset($_POST['selected_movie'])) {
        header("Location: showings_by_movie.php");
     } else if(isset($_POST['reviews'])) {
        header("Location: reviews.php");
     }
?>
