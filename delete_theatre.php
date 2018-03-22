<?php
    //customer name -> account id
    print_r($_POST);
    $errorMessage = "error";
    if (isset($_POST["complex"]) && !empty($_POST["complex"])) {
        // check that customer exists
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
            $stmt = $dbh->prepare("DELETE FROM theatre_complex WHERE name=:complex");

            if ($stmt->execute(array(':complex' => $_POST['complex']))) {
            // success
                echo $_POST["complex"];
            } else {
            // failure
                echo $errorMessage;
            }
               
            
        } catch (PDOException $e ) {
            // send error message
            echo $errorMessage;
        }
    } else {
        echo $errorMessage;
    }
    $dbh = null;

?>
