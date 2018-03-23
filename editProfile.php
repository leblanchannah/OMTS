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
  $user_id=$_SESSION['user_id'];

  $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
$rows = $dbh->query("select * from customer where '$user_id'=account_number");
$row = $rows->fetch();
$dbh = null;
?>

    <div class="container">
    <div class="col">
        <div class="card card-default">
          <div class="card-header">Login ID: <?php echo $row['login_id']?> <br> Account ID: <?php echo $row['account_number']?></div>

          <div class="card-body">
            <form action='submitProfileChange.php' method='post'>
              <table class="table table-hover">
                <div class="form-group float-label-control">
                 <label for="">First Name</label>
                 <input type="text" class="form-control" placeholder="<?php echo $row['fname'];?>" name="fname" value="<?php echo $row['fname'];?>" required>
                 </div>          
                 <div class="form-group float-label-control">
                 <label for="">Last Name</label>
                 <input type="text" class="form-control" placeholder="<?php echo $row['lname'];?>" name="lname" value="<?php echo $row['lname'];?>" required>
                 </div>
                 <div class="form-group float-label-control">
                 <label for="">Password</label>
                 <input type="password" class="form-control" placeholder="<?php echo $row['password'];?>" name="password" value="" required>
                 </div>
                 <div class="form-group float-label-control">
                 <label for="">Phone Number</label>
                 <input type="text" class="form-control" placeholder="<?php echo $row['phone_number'];?>" name="phone_number" value="<?php echo $row['phone_number'];?>" required>
                 </div>
                 <div class="form-group float-label-control">
                 <label for="">Email</label>
                 <input type="text" class="form-control" placeholder="<?php echo $row['email'];?>" name="email" value="<?php echo $row['email'];?>" required>
                 </div>
                 <div class="form-group float-label-control">
                 <label for="">Street</label>
                 <input type="text" class="form-control" placeholder="<?php echo $row['street'];?>" name="street" value="<?php echo $row['street'];?>" required>
                 </div>
                 <div class="form-group float-label-control">
                 <label for="">City</label>
                 <input type="text" class="form-control" placeholder="<?php echo $row['city'];?>" name="city" value="<?php echo $row['city'];?>" required>
                 </div>
                 <div class="form-group float-label-control">
                 <label for="">Postal Code</label>
                 <input type="text" class="form-control" placeholder="<?php echo $row['postal_code'];?>" name="postal_code" value="<?php echo $row['postal_code'];?>" required>
                 </div>
                 <div class="form-group float-label-control">
                 <label for="">Credit Card Number</label>
                 <input type="text" class="form-control" placeholder="<?php echo $row['credit_card_num'];?>" name="credit_card_num" value="<?php echo $row['credit_card_num'];?>" required>
                 </div>
                 <div class="form-group float-label-control">
                 <label for="">Credit Card Expiry Date</label>
                 <input type="text" class="form-control" placeholder="<?php echo $row['credit_expiry_date'];?>" name="credit_expiry_date" value="<?php echo $row['credit_expiry_date'];?>" required>
                 </div>
                 <div class='form-group'>
                              <input type='submit' name='profile-change-submit' id='profile-change-submit' tabindex='2' class='form-control btn btn-login' value= 'Change Profile'>
                            </div>
                  <!-- //   echo "<tr><td>Account Number: ".$row["account_number"]."</td></tr>";
                  //   echo "<tr><td>First Name: ".$row["fname"]."</td></tr>";
                  //   echo "<tr><td>Last Name: ".$row["lname"]."</td></tr>";
                  //   echo "<tr><td>Password: ".$row["password"]."</td></tr>";
                    echo "</form>"; -->
                  
              </table>
              <!-- <div class="btn-group">
                <button type="submit" name="ReserveButton" id="reservation" class="btn btn-primary">Make Reservation</button>
              </div>
               ?php
                if (isset($_POST['ReserveButton'])) {
                  if(isset($_POST['optradio']))
                  {
                    echo "You have selected:" .$_POST['optradio'];
                  }
                }
              ? -->
            </form>
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
