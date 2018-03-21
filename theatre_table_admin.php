<?php
// add table for theatre and theatre complexes for admin
$errorMessage = "error";
$dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
if (isset($_POST["tcomplex5"]) && !empty($_POST["tcomplex5"])) {
    // check that customer exists
    try {
    $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
    $rows = $dbh->query('select * from theatre where name="'.$_POST["tcomplex5"].'"');
    foreach($rows as $row) {
            echo '<tr><td><div class="radio"><label><input type="radio"" id="check" name="complex_name" value="'.$_POST["tcomplex5"].'"></label></div></td><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td></tr>';
    }
    } catch (PDOException $e ) {
        // send error message
        echo $errorMessage;
    }
} 
$dbh = null;



?>


