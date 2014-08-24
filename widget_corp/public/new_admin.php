<?php require_once ("../includes/session.php"); ?>
<?php require_once ("../includes/db_connection.php"); ?>
<?php require_once ("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php require_once ("../includes/validation_functions.php"); ?>


<?php

if(isset($_POST['submit'])){
   
    //validations
    $required_field = array("user_name","password");
    validate_presences($required_field);
    
    $fields_with_max_lenght = array("user_name" => 30);
    validate_max_lengths($fields_with_max_lenght);
    
    if(empty($errors)){
        
    $user_name = mysqli_prep($_POST["user_name"]); 
    $hashed_password = password_encrypt($_POST["password"]); 
  
    $query = "insert into admins (username, hashed_password) values ('{$user_name}', '{$hashed_password}')";
    $result = mysqli_query($connection, $query);
    if($result){
        //success
        $_SESSION["message"] = "Admin User created"; 
        redirect_to("manage_admins.php");
    }
    else{
        //failure
        $_SESSION["message"] = "admin creation failed";
         
    }
    
}
}
else{
    ///prbably get request
}

?>

<?php $layout_contex = "admin" ?>
<?php include ("../includes/layouts/header.php"); ?>
<div id="main">
    <div id="navigation">
        &nbsp;
    </div>
    <div id="page">
        <?php echo message(); ?>
        
         <?php echo form_errors($errors); ?>
       
        <h2>Create Admin user </h2>
        
        <form action="new_admin.php" method="post">
            <p>User Name:
                <input type="text" name="user_name" value="">
            </p>
            <p>Password:
                <input type="password" name="password" value="">
            </p>
            <input type="submit" name="submit" value="Create Admin" />
        </form>
        <br />
        <a href="manage_admins.php">Cancel</a>
            
    </div>
</div>

<?php
    //4.Release returned data
    mysqli_free_result($result);
    ?>

<?php include ("../includes/layouts/footer.php");?>