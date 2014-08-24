<!DOCTYPE html>

<html>
    <head>
        <title>Form processing</title> 
    </head>
    
    <body>
        <pre>
           <?php print_r($_POST); ?>
        </pre>
        
        <?php 
//            if(isset($_POST["username"])){
//                $username=$_POST["username"]; 
//               
//            }
//            else {
//                $username="ravindra";
//            }
//            if(isset($_POST["password"])){
//                
//                $password=$_POST["password"];
//            }
//             else {
//                $password="shreyash";
//            }
            if(isset($_POST["submit"])){
                    echo "Form was submitted..<br />";
                    $username = isset($_POST["username"]) ? $_POST["username"] : "ravindra";
                    $password = isset($_POST["password"]) ? $_POST["password"] : "shreyash";

            }
            else {
                $username="not submit value";
                $password="not submit value";
            }
            echo "username= ".$username."<br /> Password=".$password;
        ?>
    </body>
</html>
