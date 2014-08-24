<?php require_once ("../includes/session.php"); ?>
<?php require_once ("../includes/db_connection.php"); ?>
<?php require_once ("../includes/functions.php"); ?>
<?php require_once ("../includes/validation_functions.php"); ?>


<?php
$user_name = "";
if(isset($_POST["submit"])){
   
    //validations
    $required_field = array("user_name","password");
    validate_presences($required_field);
    
    if(empty($errors)){
        
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    //Attempt login
    $found_admin = attempt_login($user_name, $password);    

    if($found_admin){
        //success
        //mark user as a logged in
        $_SESSION["admin_id"] = $found_admin["id"];
        $_SESSION["username"] = $found_admin["username"];
        redirect_to("admin.php");
    }
    else{
        //failure
        $_SESSION["message"] = "Username/Password not found";
         
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
       
        <h2>Login </h2>
        
        <form action="login.php" method="post">
            <p>User Name:
                <input type="text" name="user_name" value="<?php echo htmlentities($user_name); ?>">
            </p>
            <p>Password:
                <input type="password" name="password" value="">
            </p>
            <input type="submit" name="submit" value="Submit" />
        </form>
       
            
    </div>
</div>

<?php
    //4.Release returned data
    mysqli_free_result($result);
    ?>

<?php include ("../includes/layouts/footer.php");?>