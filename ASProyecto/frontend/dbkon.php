<?php
    $dbhost = "db";
    $dbuser = "aimar";
    $dbpass = "DrUiD189"; 
    $dbname = "webbase";
    
    if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
    {
        die("failed to connect!");
    }
?>
