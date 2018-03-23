<?php
session_start();
list($num, $complexName, $start_time, $movie_id) = explode("|", $_POST['cancel_purchase']);

$dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
$query = "UPDATE reserves r SET 
r.cancel_flag = 1 WHERE
r.account_number = :account_id and
r.name = :complexName and
r.start_time = :start_time and
r.movie_id = :movie_id and 
r.num = :num";

$update = $dbh->prepare($query);

$update->bindParam(':num', $num,PDO::PARAM_STR);
$update->bindParam(':complexName', $complexName,PDO::PARAM_STR);
$update->bindParam(':start_time', $start_time,PDO::PARAM_STR);
$update->bindParam(':movie_id',$movie_id,PDO::PARAM_STR);
$update->bindParam(':account_id',  $_SESSION['user_id'],PDO::PARAM_STR);

$dbh = null;

if($update -> execute()){
   header("Location: browse_complex.php");
}
else{
echo "error could not cancel purchase";
}


?>