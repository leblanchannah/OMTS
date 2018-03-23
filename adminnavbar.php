<?php 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    else
    {
        session_destroy();
        session_start(); 
    }
?>


<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">OMTS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" data-toggle="tooltip" title="Home" href="admin.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" data-toggle="tooltip" title="Browse Movies, Make Reservations" href="admin_movies.php">Showings<span class="sr-only">(current)</span></a>
        </li>
        
        <li class="nav-item active">
            <a class="nav-link" data-toggle="tooltip" title="View or cancel purchases" href="admin_theaters.php">Theaters<span class="sr-only">(current)</span></a>
        </li>

        </ul>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                <?php 
                    
                    $dbh = new PDO('mysql:host=localhost;dbname=db_omts', "root", "");
                    $row= $dbh->query('SELECT login_id FROM admin WHERE account_number='.$_SESSION['user_id']);
                    $result = $row->fetch(PDO::FETCH_ASSOC);
                echo 'Logged in as: '.$result['login_id'];?>
                </a>
            </li>
        </ul>
    </div>
</nav>