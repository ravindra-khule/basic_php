<?php
    //1. Create database connection
    define("DB_SERVER", "localhost");
    define("DB_USER", "widget_cms");
    define("DB_PASS", "secretpassword");
    define("DB_NAME", "widget_corp");

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    
    //Test if connection occcured.
    if(mysqli_connect_errno()){
        die("Databse connection failled: ".
             mysqli_connect_error() .
             " (".  mysqli_connect_errno(). " )"
            );
    }
?>
