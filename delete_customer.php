<?php
    //customer name -> account id
    $errorMessage = "error";
    $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
    if (isset($_POST["customername"]) && !empty($_POST["customername"])) {
        // check that customer exists
        try {
            $sqlquery = 'SELECT * FROM customer WHERE account_number=:account'; 
            $result=$dbh->prepare($sqlquery); 
            $result->execute(array(':account' => $_POST['customername'])); 
            if (!$result) {
                echo $errorMessage;
            } else {
                // delete custome
                $stmt = $dbh->prepare("DELETE FROM customer WHERE account_number = :account");

                if ($stmt->execute(array(':account' => $_POST['customername']))) {
                // success
                    echo $_POST["customername"];
                } else {
                // failure
                    echo $errorMessage;
                }
               
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

