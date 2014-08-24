<?php
    //1. Create database connection
    $dbhost = "localhost";
    $dbuser = "widget_cms";
    $dbpass = "secretpassword";
    $dbname = "widget_corp";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    //Test if connection occcured.
    if(mysqli_connect_errno()){
        die("Databse connection failled: ".
             mysqli_connect_error() .
             " (".  mysqli_connect_errno(). " )"
            );
    }
?>

<?php
    //Often these are form values in $_POST
    $menu_name = "Today's Widget Travia";
    $position = 4;
    $visible = 1;
    
    //Escape all string....
    $menu_name = mysqli_real_escape_string($connection, $menu_name);
     
    //2.Perform the database query
    $query = "insert into subjects (menu_name, position, visible) values ('{$menu_name}', {$position}, {$visible})";
    $result = mysqli_query($connection, $query);
    if($result){
        //success
        //redirect_to(something.php);
        echo "success!";
    }
    else{
        //failure
        //$message=subject creation failed
        die("Database query failed: ".mysqli_error($connection));
       
    }
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Databases</title> 
    </head>
    
    <body>
       
        
    </body>
</html>
<?php
    //5.Close database connection
    mysqli_close($connection);
?>
