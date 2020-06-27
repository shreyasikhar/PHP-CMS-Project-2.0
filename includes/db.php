<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $db['db_host'] = "localhost";
    $db['db_user'] = "phpmyadmin";
    $db['db_pass'] = "yayati23";
    $db['db_name'] = "cms";


    foreach($db as $key => $value)
    {
        define(strtoupper($key), $value);
    }

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

     //if($connection)
       // echo "We are connected...";
     //else
       //  echo "Database not connected...";    
?>
