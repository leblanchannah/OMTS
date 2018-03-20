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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha18/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha18/css/tempusdominus-bootstrap-4.min.css" />

    <link href="customer.css" rel="stylesheet">


  </head>
<body>
<script>
$(document).ready(function () {
    $( "#showings input:radio" ).prop("checked", true);
    $.ajax({
            type: 'post',
            url: 'get_theatre.php',
            data: $('.showings').serialize(),
            success:function(data) {
                if (data != "error") {
                    $('#theatres').html(data)
                    $('#theatres2').html(data)
                } else {    
                }
            }
        });


    $( "#tcomplex" ).change(function() {
        $.ajax({
            type: 'post',
            url: 'get_theatre.php',
            data: $('.showings').serialize(),
            success:function(data) {
                if (data != "error") {
                    $('#theatres').html(data)
                } else {    
                }
            }
        });
    });

    $( "#tcomplex2" ).change(function() {
        $.ajax({
            type: 'post',
            url: 'get_theatre.php',
            data: $('#add_showing').serialize(),
            success:function(data) {
                if (data != "error") {
                    $('#theatres2').html(data)
                } else {    
                }
            }
        });
        
    });

});


</script>
<!-- show table of all movies and showings -->
<!-- load table with current showings, in asc order, highlight movies no longer playing with red -->
<div class="container">
  <div class="row">

  </div>
  <br>
  <div class="row">
  <div class="col-md-4">
    <div class="card card-default">
        <div class="card-header">Add Showing</div>
        <div class="card-body">
          <form id="add_showing" method="post" action="add_movie_showing.php">
          <div class="form-group col-sm-12">
            <label for="tcomplex2">Theatre Complex</label>
            <select class="form-control" name="tcomplex2" id="tcomplex2">
                    <?php
                    // add try catch
                        $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                        $rows = $dbh->query('select name from theatre_complex');

                        foreach($rows as $row) {
                            echo '<option class="dropdown-item" name="theatrecomplex2" value="'.$row[0].'">'.$row[0].'</option>';
                        }
                        $dbh = null;

                    ?>
            </select>
            </div>
            <div class="form-group col-sm-12">
                <label for="theaters2">Theatre Number</label>
                <select class="form-control" name="theatres2" id="theatres2">
                </select>
            </div>
            <div class="form-group col-sm-12">
                <label for="theaters2">Available Movies</label>
                <select class="form-control" name="movies" id="movies">
                <?php
                    // add try catch
                        $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                        $rows = $dbh->query('select title,movie_id from movie');

                        foreach($rows as $row) {
                            echo '<option class="dropdown-item" name="movie" value="'.$row[1].'">'.$row[0].'</option>';
                        }
                        $dbh = null;

                    ?>
                </select>
            </div>
            <div class="form-group col-sm-12">
              <label for="datepickeradd">Start Time (YYYY-MM-DD HH:MM)</label>
              <input type="text" class="form-control" name="datepickeradd" id="datepickeradd"/>
            </div>
            <br>
            <input class="btn btn-primary" type="submit" value="Add Showing">
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">Edit Showings</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <form class="showings"  method="post" action="edit_movie.php"> 
                <table class="table table-hover table-responsive" id="showings">
                  <thead>
                  <tr>
                        <th scope="col"></th>
                        <th scope="col">Movie</th>
                        <th scope="col">Theatre Complex</th>
                        <th scope="col">Theatre</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">Seats Available</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                        //SELECT start_time,movie_id,showing.num,showing.name,theatre.max_seats FROM showing INNER JOIN theatre ON showing.num = theatre.num AND showing.name =theatre.name;
                        $rows = $dbh->query('SELECT title, name, num, start_time, avail,movie.movie_id FROM (SELECT all_seats.start_time, all_seats.movie_id, all_seats.num, all_seats.name, (all_seats.max_seats-IFNULL(available_seats.booked,0)) avail FROM (SELECT start_time,movie_id,showing.num,showing.name,theatre.max_seats FROM showing INNER JOIN theatre ON showing.num = theatre.num AND showing.name = theatre.name) all_seats LEFT OUTER JOIN (SELECT name, num, start_time, movie_id, SUM(seats_reserved) as booked FROM reserves GROUP BY name, num, start_time, movie_id) available_seats ON all_seats.start_time = available_seats.start_time AND all_seats.num = available_seats.num AND all_seats.name=available_seats.name GROUP BY all_seats.start_time, all_seats.num, all_seats.name) seats LEFT JOIN movie ON seats.movie_id = movie.movie_id');
                        foreach($rows as $row) {
                            echo '<tr><td><div class="radio"><label><input type="radio"" id="movie" name="moviename" value="'.$row[5].'"></label></div></td><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].
                            '</td><td>'.$row[3].'</td><td>'.$row[4].'</td>'.'<input type="hidden" name="oldcomplex" value="'.$row[1].'"/>'.
                            '<input type="hidden" name="oldnum" value="'.$row[2].'"/>'.
                            '<input type="hidden" name="oldtime" value="'.$row[3].'"/>'.
                            '<input type="hidden" name="movie_id" value="'.$row[5].'"/>'.
                            '</tr>';

                        }
                        $dbh = null;

                    ?>
                  </tbody>
                </table>
                <div class="form-group col-sm-6">
                <label for="supplier">Theatre Complex</label>
                <select class="form-control" name="tcomplex" id="tcomplex">
                        <?php
                        // add try catch
                            $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                            $rows = $dbh->query('select name from theatre_complex');

                            foreach($rows as $row) {
                                echo '<option class="dropdown-item" name="theatrecomplex" value="'.$row[0].'">'.$row[0].'</option>';
                            }
                            $dbh = null;

                        ?>

                </select></div>
                <div class="form-group col-sm-6">
                <label for="supplier">Theatre Number</label>
                <select class="form-control" name="theatres" id="theatres">
                </select></div>

                <div class="col-sm-6">
                    <label for="datepicker">Start Time (YYYY-MM-DD HH:MM)</label>
                    <input type="text" class="form-control" name="datepicker" id="datepicker" />
                </div>
                <br>
                <input class="btn btn-primary" type="submit" value="Edit Showing">
              </form>
            </div>
            <!-- /.col-md-12>-->
          </div>
          <!-- /.row>-->
          <div class="row">
            <div class="col-md-12">
            </div>
            <!-- /.col-md-12>-->
          </div>
          <!-- /.row>-->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.col-md-12>-->
    </div>
    <!-- /.row>-->
  </div>
  <!-- /.container -->
  <br> <br> <br>

</body>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>