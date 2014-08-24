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
    //2.Perform the database update query
    //data
    $id = 5;
    
    
    //update query
    $query = "delete from subjects ";
    $query .= "where id = {$id} ";
    $query .= "limit 1 ";
    
    
    $result = mysqli_query($connection, $query);
    
    if($result && mysqli_affected_rows($connection) == 1){
        //success
        //redirect_to(something.php);
        echo "success! record updated";
    }
    else{
        //failure
        //$message=subject creation failed
        die("Database delete query failed: ".mysqli_error($connection));
       
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
