<?php
    if(!isset($_SESSION)){
        session_start();
    }
    unset($_SESSION);
    session_destroy();
    echo "<h3>You had been logout.<br><br>Click the button below to return to homepage.</h3><br><br>";
    echo "<a href='../webpage/homepage.php' class='btn btn-block btn-lg btn-primaryLight btn-primary'>Return To Homepage</a>";
?>