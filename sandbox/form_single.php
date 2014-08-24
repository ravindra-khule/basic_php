<?php 
    require_once("included_functions.php");
    if(isset($_POST["submit"])){
        //form has been submitted
        $username = $_POST["username"];
        $password = $_POST["password"];
        if($username == "ravi" && $password == "ravindra"){
            //succefull login
            redirect_to("basic.html");
        }
        else {
            $username=$_POST["username"];
            $message="there were some errors";
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
        <form action="form_single.php" method="post">
            Username:<input type="text" name="username" value="<?php echo htmlspecialchars($username);?>"><br />
            Password:<input type="password" name="password" value=""><br />
            
            <input type="submit" value="Submit" name="submit"><br />
        </form>
    </body>
</html>