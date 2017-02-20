<?php


    $type     = 'mysql';
    $host     = 'localhost'; // or ip addr
    $db_name   = 'workshop_web';
    $user_db  = 'root'; 
    $pass_db  = '';

    $con = mysqli_connect($host, $user_db, $pass_db, $db_name);
    mysqli_query($con, "SET NAMES UTF8");

?>