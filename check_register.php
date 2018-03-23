<?php
$neededFields = array('phone_number','login_id','password','fname','lname','email','street','city','postal_code','credit_card_num','credit_expiry_date');
$errorFlag = false;

foreach($neededFields as $field){
    if(empty($_POST[$field])){
        $errorFlag = true;
        echo "The Field: ".$field." must be filled.<br>";
    }
}
if ($errorFlag){
    echo " <div class='container'>";
    echo "     <div class='row'>";
    echo "          <div class='col'>";
    echo "<form action= 'register.html' method='post'>";
    echo "<div class='btn-group'>";
    echo " <button type='submit' class='btn btn-danger'>Register Again</button>";
    echo "</div>";
   echo "</form>";
    echo "          </div>";
    echo "     </div>";
    echo " </div>";
}
else{
    $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
    $user_id = $_POST['login_id'];
    $rows = $dbh->query("select count(*) count from customer where login_id= 
    '$user_id' ");
    $count = $rows->fetch();
    //if empty, it means
    if($count['count'] == 1){
        echo "Login ID already taken";
        echo " <div class='container'>";
        echo "     <div class='row'>";
        echo "          <div class='col'>";
        echo "<form action= 'register.html' method='post'>";
        echo "<div class='btn-group'>";
        echo " <button type='submit' class='btn btn-danger'>Return</button>";
        echo "</div>";
       echo "</form>";
        echo "          </div>";
        echo "     </div>";
        echo " </div>";
    }
    else{
        $query = " INSERT INTO customer (fname, lname, phone_number, password, login_id, email, street, city, postal_code, credit_card_num, credit_expiry_date)
        VALUES (:fname, :lname, :phone_num, :pass, :login_id, :email, :street, :city, :postal_code, :credit_card_num, :credit_expiry_num)";
    
        $add = $dbh->prepare($query);
        
        $add->bindParam(':fname', $_POST['fname'],PDO::PARAM_STR);
        $add->bindParam(':lname', $_POST['lname'],PDO::PARAM_STR);
        $add->bindParam(':phone_num', $_POST['phone_number'],PDO::PARAM_STR);
        $add->bindParam(':pass', $_POST['password'],PDO::PARAM_STR);
        $add->bindParam(':email', $_POST['email'],PDO::PARAM_STR);
        $add->bindParam(':street', $_POST['street'],PDO::PARAM_STR);
        $add->bindParam(':city', $_POST['city'],PDO::PARAM_STR);
        $add->bindParam(':postal_code', $_POST['postal_code'],PDO::PARAM_STR);
        $add->bindParam(':credit_card_num', $_POST['credit_card_num'],PDO::PARAM_STR);
        $add->bindParam('credit_expiry_num', $_POST['credit_expiry_date'],PDO::PARAM_STR);
        $add->bindParam(':login_id',  $_POST['login_id'],PDO::PARAM_STR);
        if($add -> execute()){
            header("Location: login.html");
        }
    else{
        echo "Could not add account. BROKE";
        echo " <div class='container'>";
        echo "     <div class='row'>";
        echo "          <div class='col'>";
        echo "<form action= 'register.html' method='post'>";
        echo "<div class='btn-group'>";
        echo " <button type='submit' class='btn btn-danger'>Return</button>";
        echo "</div>";
       echo "</form>";
        echo "          </div>";
        echo "     </div>";
        echo " </div>";
    }
    }
    $dbh = null;
}

?>