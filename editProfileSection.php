<div class="col-md-3">
    <div class="card card-default">
      <div class="card-header">
          Customer Profile
      </div>
      <div class="card-body">
          <?php
            $user_id=$_SESSION['user_id'];
            $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
            $rows = $dbh->query("select account_number, email, fname, lname from customer where '$user_id'=account_number");
            
            foreach($rows as $row){
               echo "   <h4 id='user-name'>".$row['fname']." ".$row['lname']."</h4><small>";
            echo "  <cite title='Account ID' id='user-ID'>Account ID: ".$row['account_number']."
            <i class='glyphicon glyphicon-map-marker'>
            </i>
          </cite>
        </small>
        <p>";
        echo "<i class='glyphicon glyphicon-envelope' id='user-email'></i>".$row['email']."
        </p>";
           }
          ?>
     
        <form action= "editProfile.php" method="post">
            <div class="btn-group">
              <!-- load user info -->
              <!-- edit profile button-->
              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
              <button type="submit" class="btn btn-danger">Edit Profile</button>
            </div>
            </form>
      </div>
    </div>
  </div>