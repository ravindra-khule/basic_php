<!DOCTYPE html>

<html>
    <head>
        <title>string</title> 
    </head>
    
    <body>
        <?php
  
        echo "Hello world<br />";
        echo 'Hello world<br />';
        
        $greeting="Hello";
        $target="world";
        $phrase=$greeting . " " . $target;
        echo $phrase;

        ?>
        <br />
        <?php
            echo "$phrase Again";
            echo '$phrase Again';
            echo "{$phrase}Again";
            
        ?>
      </body>
</html>
