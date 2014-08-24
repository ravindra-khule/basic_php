<?php
    //session use cookies which use heasders
    //Must start before any HTML output
    //unless output buffereing  is turned on.
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <title>sessions</title> 
    </head>
    
    <body>
        <?php
            $_SESSION["first_name"]= "ravindra";
            $name = $_SESSION["first_name"];
            echo $name;
        ?>
    </body>
</html>
