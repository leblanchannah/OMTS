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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha18/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha18/css/tempusdominus-bootstrap-4.min.css" />

    <link href="customer.css" rel="stylesheet">
    <script>
       $( "#theatresfromc input:radio" ).prop("checked", true);



        $( "#tcomplex5" ).change(function() {
            console.log("caught change");
            $.ajax({
                type: 'post',
                url: 'theatre_table_admin.php',
                data: $('#theatresfromc').serialize(),
                success:function(data) {
                    if (data != "error") {
                        
                        $('#theatrest').html(data)
                    } else {    
                    }
                }
            });
        });


    </script>
  </head>
  <body>
    <div class="container">
        <div class="row">
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header">Add Complex</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                        <form id="AddComplex"  method="post" action="add_complex.php">
                            <div class="form-group">
                                <label for="cname">Name</label>
                                <input type="text" class="form-control" id="input_cname" name="cname" placeholder="">
                            </div>        
                            <div class="form-group">
                                <label for="cstreet">Address</label>
                                <input type="text" class="form-control" id="input_cstreet" name="cstreet" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="ccity">City</label>
                                <input type="text" class="form-control" id="input_ccity" name="ccity" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="ccode">Postal Code</label>
                                <input type="text" class="form-control" id="input_ccode" name="ccode" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="cnumber">Phone Number</label>
                                <input type="text" class="form-control" id="input_cnumber" name="cnumber" placeholder="">
                            </div>
                            <button type="button" id="add_complex" class="btn btn-success">Add Complex</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Complexes</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form>
                                <table class="table table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Number of Theatres</th>
                                            <th scope="col">Address</th> <!-- concat street,city,postalcode-->
                                            <th scope="col">Phone Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                                            $rows = $dbh->query('SELECT * FROM theatre_complex');
                                            foreach($rows as $row) {
                                                echo '<tr><td><div class="radio"><label><input type="radio"" id="customers" name="complex" value='.$row[1].'></label></div></td><td>'.$row[1].'</td><td>'.$row[0].
                                                '</td><td>'.$row[2].', '.$row[3].', '.$row[4].'</td><td>'.$row[5].'</td></tr>';
                                            }
                                            $dbh = null;
                                        ?>
                                    </tbody>

                                </table>
                                <button type="button" id="del_complex" class="btn btn-danger" disabled>Delete Theatre</button>
                            <button type="button" id="edit_complex" class="btn btn-warning">Edit Theatre</button>
                             </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="row">
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header">Add Theatre</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                        <form id="AddTheatre" method="post" action="add_theatre.php">
                            <div  class="form-group">   
                            <label for="size">Size</label>
                            <select class="form-control" id="addsize" name="size">
                                <option class="dropdown-item" name="1" value="S">S</option>
                                <option class="dropdown-item" name="2" value="M">M</option>
                                <option class="dropdown-item" name="3" value="L">L</option>
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="tcomplex">Theatre Complex</label>
                                <select class="form-control" name="tcomplex" id="tcomplex">
                                <?php
                                    $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                                    $rows = $dbh->query('select name from theatre_complex');
                                    foreach($rows as $row) {
                                        echo '<option class="dropdown-item" name="theatrecomplex" value="'.$row[0].'">'.$row[0].'</option>';
                                    }
                                    $dbh = null;
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="addseats">Number of Seats</label>
                                <input type="text" class="form-control" id="addseats" name="addseats" placeholder="">
                            </div>
                            <button type="button" id="add_theatre" class="btn btn-success">Add Theatre</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Theatres</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                            <form id="theatresfromc">
                            <table class="table table-hover table-responsive" id="ts">
                                <div class="form-group">
                                    <label for="tcomplex5">Theatre Complex</label>
                                    <select class="form-control" name="tcomplex5" id="tcomplex5">
                                    <?php
                                        $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                                        $rows = $dbh->query('select name from theatre_complex');
                                        foreach($rows as $row) {
                                            echo '<option class="dropdown-item" name="theatrecomplex5" value="'.$row[0].'">'.$row[0].'</option>';
                                        }
                                        $dbh = null;
                                    ?>
                                    </select>
                                </div>
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Number</th>
                                        <th scope="col">Screen Size</th>
                                        <th scope="col">Seats</th>
                                    </tr>
                                </thead>
                                <tbody id="theatrest">
                                    <?php
                                        $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                                        $rows = $dbh->query('select * from theatre where name="complex_1"');
                                        foreach($rows as $row) {
                                            echo '<tr><td><div class="radio"><label><input type="radio"" id="check" name="complex_name" value="complex_1"></label></div></td><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td></tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <button type="button" id="del_theatre" class="btn btn-danger" disabled>Delete Theatre</button>
                            <button type="button" id="edit_theatre" class="btn btn-warning">Edit Theatre</button>
                            

                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

      
            </div>

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