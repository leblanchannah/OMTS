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
        }
         if($count==0){
            echo "Incorrect ID/password.";
            echo " <div class='container'>";
            echo "     <div class='row'>";
            echo "          <div class='col'>";
            echo "<form action= 'index.html' method='post'>";
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
            $_SESSION['username'] = $_POST['username'];
            header("Location: customer.php");
            exit;
                  
      }
    }
?>