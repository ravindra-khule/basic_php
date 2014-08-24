<?php require_once ("../includes/session.php"); ?>
<?php require_once ("../includes/db_connection.php"); ?>
<?php require_once ("../includes/functions.php"); ?>
<?php require_once ("../includes/validation_functions.php"); ?>

<?php

if(isset($_POST['submit'])){
    
    $menu_name = mysqli_prep($_POST["menu_name"]); 
    $position = (int) $_POST["position"];
    $visible =(int) $_POST["visible"];
  
    //validations
    $required_field = array("menu_name","position", "visible");
    validate_presences($required_field);
    
    $fields_with_max_lenght = array("menu_name" => 30);
    validate_max_lengths($fields_with_max_lenght);
    
    if(!empty($errors)){
        $_SESSION["errors"] = $errors;
        redirect_to("new_subject.php");
    }
     
  
    
    $query = "insert into subjects (menu_name, position, visible) values ('{$menu_name}', {$position}, {$visible})";
    $result = mysqli_query($connection, $query);
    if($result){
        //success
        $_SESSION["message"] = "subject created"; 
        redirect_to("manage_content.php");
    }
    else{
        //failure
        $_SESSION["message"] = "subject can not be created";
        redirect_to("new_subject.php");  
    }
    
}
else{
    
    redirect_to("new_subject.php");
}
?>

<?php
   if(isset($connection)){
        mysqli_close($connection);
}
?>