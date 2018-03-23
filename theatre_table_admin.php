<?php
// add table for theatre and theatre complexes for admin
$errorMessage = "error";
$dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
if (isset($_POST["tcomplex5"]) && !empty($_POST["tcomplex5"])) {
    // check that customer exists
    try {
    $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
    if ($_POST["tcomplex5"]=="all") {
        $rows = $dbh->query('select * from theatre');
    } else {
        $rows = $dbh->query('select * from theatre where name="'.$_POST["tcomplex5"].'"');
    }
    foreach($rows as $row) {
            echo '<tr id="'.$row[0].$_POST['tcomplex5'].'"><td><div class="radio"><label><input type="radio"" id="check" name="num" value="'.$row[0].'"></label></div></td><td>'.$row[0].'</td><td>'.$row[2].'</td><td>'.$row[1].'</td></tr>';
    }
    } catch (PDOException $e ) {
        // send error message
        echo $errorMessage;
    }
}
$dbh = null;



?>


