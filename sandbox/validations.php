<!DOCTYPE html>

<html>
    <head>
        <title>validations</title> 
    </head>
    
    <body>
        <?php 
            //presence or required
        
            $value = "ravi";
            if(!isset($value) || empty($value)){
                echo "validation failed:";
            }
            
        ?>
        
        <?php 
            //string lenght
        
            $value="abcd";
            $min=3;
            if(strlen($value) < $min){
                echo "validation failed";
            }
            
            $max=6;
            if(strlen($value) > $max){
                echo "validation failed";
            }
        ?>
        
        <?php
            //type
        $value = 1;
        if(is_string($value)){
            echo "validation failed";
        }
        
        ?>
        
        <?php
            //inclusion in a set
            $value = "1";
            $set = array("1","2","3","4");
            if(!in_array($value, $set)){
                echo "validation failed";
            }
       
        ?>
        <?php
            //uniquness
            //reqire database to check uniquness        
        ?>
        <?php
            //format
            if(preg_match("/PHP/", "PHP is fun")){
                echo "A match was found <br />";
            }
            else{
                echo "match was not found <br />";
            }
            
            $value = "ravickhule@gmail.com";
            if(!preg_match("/@/",$value)){
                echo "validation failed";
            }
            
        ?>
    </body>
</html>
