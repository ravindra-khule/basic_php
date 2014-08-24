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
    //2.Perform the database query
    $query = "select * from subjects where visible=1 order by position asc";
    $result = mysqli_query($connection, $query);
    //test if thre was query error
    if(!$result){
        die("Database query failed:");
    }
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Databases</title> 
    </head>
    
    <body>
        <ul>   
            <?php
            //3.Use returned data (if any)
            while($subject= mysqli_fetch_assoc($result)){
            ?>
            <li><?php echo $subject["menu_name"]." (" .$subject["id"].")"; ?></li>
            <?php
            }

            ?>
        </ul>  
        
    <?php
    //4.Release returned data
    mysqli_free_result($result);
    ?>
        
    </body>
</html>
<?php
    //5.Close database connection
    mysqli_close($connection);
?>
