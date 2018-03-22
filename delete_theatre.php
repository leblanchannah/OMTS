<?php
    //Array ( [tcomplex5] => complex_3 [num] => 3 )
    $errorMessage = "error";
    if (isset($_POST["tcomplex5"]) && !empty($_POST["tcomplex5"]) && !empty($_POST["num"]) && isset($_POST["num"])) {
        // check that customer exists
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
            $stmt = $dbh->prepare("DELETE FROM theatre WHERE name=:complex AND num=:tnum");

            if ($stmt->execute(array(':complex' => $_POST['tcomplex5'], ':tnum' => $_POST['num']))) {
            // success
                echo $_POST["num"].$_POST['tcomplex5'];
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
