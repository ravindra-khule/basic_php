<?php
    //Remember: Setting cookies must be before *any* HTML output
    //unless output buffering is turned on
            $name = "test";
            $value = 400;
            $expire = time() + (60*60*24*7);
            //setcookie($name, $value, $expire);
            
           // setcookie($name);
           //setcookie($name, NULL);
           setcookie($name, $value, time()-3);
 ?>

<!DOCTYPE html>

<html>
    <head>
        <title>Cookies</title> 
    </head>
    
    <body>
       
            <?php 
             $test=$_COOKIE["test"];
             echo $test;
            ?>
    </body>
</html>
