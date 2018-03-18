<?php

$errorMessage = "error";
 $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
 if (isset($_POST["tcomplex"]) && !empty($_POST["tcomplex"])) {
     // check that customer exists
     try {
        $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
        $rows = $dbh->query('select num from theatre where name="'.$_POST["tcomplex"].'"');
        foreach($rows as $row) {
              echo '<option class="dropdown-item" name="theatre" value="'.$row[0].'">'.$row[0].'</option>';
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