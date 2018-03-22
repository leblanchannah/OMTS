<?php session_start();

    $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
    $query = "UPDATE customer c SET 
    c.fname =  :fname,
    c.lname = :lname,  c.phone_number = :phone_num,
    c.password = :pass,  c.email = :email,
    c.street = :street, c.city = :city,
    c.postal_code = :postal_code, c.credit_card_num = :credit_card_num,
    c.credit_expiry_date = :credit_card_expiry WHERE
    c.account_number = :account_id";

    $update = $dbh->prepare($query);
    
    $update->bindParam(':fname', $_POST['fname'],PDO::PARAM_STR);
    $update->bindParam(':lname', $_POST['lname'],PDO::PARAM_STR);
    $update->bindParam(':phone_num', $_POST['phone_number'],PDO::PARAM_STR);
    $update->bindParam(':pass', $_POST['password'],PDO::PARAM_STR);
    $update->bindParam(':email', $_POST['email'],PDO::PARAM_STR);
    $update->bindParam(':street', $_POST['street'],PDO::PARAM_STR);
    $update->bindParam(':city', $_POST['city'],PDO::PARAM_STR);
    $update->bindParam(':postal_code', $_POST['postal_code'],PDO::PARAM_STR);
    $update->bindParam(':credit_card_num', $_POST['credit_card_num'],PDO::PARAM_STR);
    $update->bindParam('credit_card_expiry', $_POST['credit_expiry_date'],PDO::PARAM_STR);
    $update->bindParam(':account_id',  $_SESSION['user_id'],PDO::PARAM_STR);

    $dbh = null;

    if($update -> execute()){
        header("Location: customer.php");
    }
else{
    echo $errorMessage;
}
    ?>