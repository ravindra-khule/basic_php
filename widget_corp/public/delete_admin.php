<?php require_once ("../includes/session.php"); ?>
<?php require_once ("../includes/db_connection.php"); ?>
<?php require_once ("../includes/functions.php"); ?>

<?php 
    $current_admin = find_admin_by_id($_GET["id"]);
   
    if(!$current_admin)
    {
        //subject id was missing or invalid or
        //subject could be finf in database
        redirect_to("manage_admins.php");
    } 
    
    
    
    $id = $current_admin["id"];
    $query = "delete from admins where id = {$id} limit 1";
    
    $result = mysqli_query($connection, $query);
        
        
        if($result && mysqli_affected_rows($connection) == 1){
            //success
            $_SESSION["message"] = "admin deleted"; 
            redirect_to("manage_admins.php");
        }
        else{
            //failure
            $_SESSION["message"] = "admin deletion failed"; 
            redirect_to("manage_content.php");            
        }
?>