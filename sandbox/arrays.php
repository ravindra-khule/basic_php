<!DOCTYPE html>

<html>
    <head>
        <title>String Function </title> 
    </head>
    
    <body>
        <?php
          
        $numbers = array(1,2,4,6,7);
        echo $numbers[0];
        echo "<br />";
        
        $mixed=array(6,"A","df",array("x","y","z"));
        
        echo $mixed[1];echo "<br />";
     
        echo $mixed[3][1];
        
        $mixed[2]=6666;
        $mixed[4]="Hi this incrediable";
        $mixed[]="Hi this incrediable";
        
        ?>
        <pre>
        <?php echo print_r($mixed);?>
        </pre>
        
        
      </body>
</html>
