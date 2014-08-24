<!DOCTYPE html>

<html>
    <head>
        <title>validation errors</title> 
    </head>
    
    <body>
        
        <?php 
        
            require_once("validation_functions.php");
            
           
            $errors= array();
            
            $username= trim("ravi");
            
            if(!has_presence($username)){
                $errors["username"]= "Username can't be blank";
            }
            echo form_errors($errors);
        ?>
    </body>
</html>
