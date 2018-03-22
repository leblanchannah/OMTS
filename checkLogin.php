<?php
    session_start();
    if(isset($_POST)){ //in case you send in nothing
        $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
        $user_id = $_POST['username'];
        $user_pass = $_POST['password'];
        $rows = $dbh->query("select account_number from customer where '$user_id'=login_id and '$user_pass' = password");
        $count=0;
        //if there is no login,password combination
        foreach($rows as $row) {
            $count ++;
            $id = $row[0];
        }
         if($count==0){
            echo "Incorrect ID/password.";
            echo " <div class='container'>";
            echo "     <div class='row'>";
            echo "          <div class='col'>";
            echo "<form action= 'login.html' method='post'>";
            echo "<div class='btn-group'>";
            echo " <button type='submit' class='btn btn-danger'>Return</button>";
            echo "</div>";
           echo "</form>";
            echo "          </div>";
            echo "     </div>";
            echo " </div>";

        }
        else{
            $_SESSION['loggedin'] = true;
           $_SESSION['user_id'] = $id[0];
           header("Location: browse_complex.php");
           exit;
                  
      }
    }
?>