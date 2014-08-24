<?php require_once ("../includes/session.php"); ?>
<?php require_once ("../includes/db_connection.php"); ?>
<?php require_once ("../includes/functions.php"); ?>

<?php 
    $current_page = find_page_by_id($_GET["page"], false);
   
    if(!$current_page)
    {
        //subject id was missing or invalid or
        //subject could be finf in database
        redirect_to("manage_content.php");
    } 
    
    
    
    $id = $current_page["id"];
    $query = "delete from pages where id = {$id} limit 1";
    
    $result = mysqli_query($connection, $query);
        
        
        if($result && mysqli_affected_rows($connection) == 1){
            //success
            $_SESSION["message"] = "page deleted"; 
            redirect_to("manage_content.php");
        }
        else{
            //failure
            $_SESSION["message"] = "subject deletion failed"; 
            redirect_to("manage_content.php?page={$id}");            
        }
?>