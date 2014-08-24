<?php require_once ("../includes/session.php"); ?>
<?php require_once ("../includes/db_connection.php"); ?>
<?php require_once ("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php require_once ("../includes/validation_functions.php"); ?>

<?php $admin = find_admin_by_id($_GET["id"]); ?>

<?php 
    if(!$admin)
    {
        //Admin id was missing or invalid or
        //Admin could be finf in database
        redirect_to("manage_admins.php");
    } 
?>

<?php
if(isset($_POST['submit'])){
     $message = null;
   //validations
    $required_field = array("username","password");
    validate_presences($required_field);
    
    $fields_with_max_lenght = array("username" => 30);
    validate_max_lengths($fields_with_max_lenght);
    
    if(empty($errors)){
        //perform update    
        $id = $admin["id"];
        $username = mysqli_prep($_POST["username"]);
        $password = password_encrypt($_POST["passowrd"]);
        
        
        $query = "update admins set ";
        $query .= "username = '{$username}', ";
        $query .= "hashed_password = '{$password}' ";
        $query .= "where id = {$id} ";
        $query .= "limit 1";
       
        
        $result = mysqli_query($connection, $query);
        
        
        if($result){
            //success
            $_SESSION["message"] = "admin updated"; 
            redirect_to("manage_admins.php");
        }
        else{
            //failure
            $message = "admin can not be updated";
            
        }

    }
}
else{
    
    
}//if(isset($_POST['submit'])){
?>

<?php $layout_contex = "admin" ?>
<?php include ("../includes/layouts/header.php"); ?>

<div id="main">
    <div id="navigation">
        &nbsp;
    </div>
    <div id="page">
        <?php  echo message(); ?>
        <?php  //message is just variable not need to use session
            if(!empty($message)){
                echo "<div class=\"message\">".htmlentities($message)."</div>";
            }
        ?>
         <?php echo form_errors($errors); ?>
       
        <h2>Edit Admin : <?php echo htmlentities($admin["username"])?></h2>
        
        <form action="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>" method="post">
            <p>User Name:
                <input type="text" name="username" value="<?php echo htmlentities($admin["username"])?>">
            </p>
            <p>Password:
                <input type="password" name="password" value="">
            </p>
            <input type="submit" name="submit" value="Edit Admin" />
        </form>
        <br />
        <a href="manage_admins.php">Cancel</a>
        &nbsp;
        &nbsp;
       
    </div>
</div>

<?php include ("../includes/layouts/footer.php");?>

