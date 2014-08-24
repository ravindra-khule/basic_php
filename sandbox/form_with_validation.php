<?php 
    require_once("included_functions.php");
    require_once("validation_functions.php");
    
    $errors= array();
    
    if(isset($_POST["submit"])){
        
        //form has been submitted
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        
        
        //validations
        $fields_reqired=array("username","password");
        foreach ($fields_reqired as $field){
            $value = trim($_POST[$field]);
            if(!has_presence($value)){
                $errors[$field]= ucfirst($field)." can't be blank";
            }
        }
        
        $fields_with_max_lenght=array("username"=>30, "password"=>8);
        validate_max_lengths($fields_with_max_lenght);
        if(empty($errors)){
            
             if($username == "ravi" && $password == "ravindra"){
            //succefull login
            redirect_to("basic.html");
            }
            else {
                $message="Username/Password do not match";
            }
        }
    }
    else{
        $username = "";
        $message = "please log in:";
    }
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Form</title> 
    </head>
    
    <body>
        <?php echo $message; ?><br />
        <?php echo form_errors($errors) ?><br />
        <form action="form_with_validation.php" method="post">
            Username:<input type="text" name="username" value="<?php echo htmlspecialchars($username);?>"><br />
            Password:<input type="password" name="password" value=""><br />
            
            <input type="submit" value="Submit" name="submit"><br />
        </form>
    </body>
</html>