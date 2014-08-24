<!DOCTYPE html>

<html>
    <head>
        <title>Type casting and type juggling </title> 
    </head>
    
    
    <body>
        Type Juggling:<br />
        <?php $count = "2 cats"?>
        Type:<?php echo gettype($count);?><br />
        
        <?php $count += 3?>
        Type:<?php echo gettype($count);?><br />
        <br /><br />
        Type casting:<br />
        <?php settype($count, "string");?>
        type:<?php echo gettype($count);?><br />
        
        <?php $count1 = (integer) $count;?>
        type count1:<?php echo gettype($count1);?><br />
        type count:<?php echo gettype($count);?>
        
        
    </body>
</html>
