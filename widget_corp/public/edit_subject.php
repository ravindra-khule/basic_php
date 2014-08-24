<?php require_once ("../includes/session.php"); ?>
<?php require_once ("../includes/db_connection.php"); ?>
<?php require_once ("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php require_once ("../includes/validation_functions.php"); ?>

<?php find_selected_page(); ?>

<?php 
    if(!$current_subject)
    {
        //subject id was missing or invalid or
        //subject could be finf in database
        redirect_to("manage_content.php");
    } 
?>

<?php
if(isset($_POST['submit'])){

    //validations
    $required_field = array("menu_name","position", "visible");
    validate_presences($required_field);
    
    $fields_with_max_lenght = array("menu_name" => 30);
    validate_max_lengths($fields_with_max_lenght);
    
    if(empty($errors)){
        //perform update    
        $id = $current_subject["id"];
        $menu_name = mysqli_prep($_POST["menu_name"]); 
        $position = (int) $_POST["position"];
        $visible =(int) $_POST["visible"];
        
        $query = "update subjects set ";
        $query .= "menu_name = '{$menu_name}', ";
        $query .= "position = {$position}, ";
        $query .= "visible = {$visible} ";
        $query .= "where id = {$id} ";
        $query .= "limit 1";
        
        $result = mysqli_query($connection, $query);
        
        
        if($result && mysqli_affected_rows($connection) >= 0){
            //success
            $_SESSION["message"] = "subject updated"; 
            redirect_to("manage_content.php");
        }
        else{
            //failure
            $message = "subject can not be updated";
            
        }

    }
}
else{
    
  
}//if(isset($_POST['submit'])){
?>

<?php $layout_contex = "admin" ?>
<?php include ("../includes/layouts/header.php"); ?>

<?php find_selected_page(); ?>

<div id="main">
    <div id="navigation">
        <?php echo navigation($current_subject, $current_page); ?>
    </div>
    <div id="page">
        <?php  //message is just variable not need to use session
            if(!empty($message)){
                echo "<div class=\"message\">".htmlentities($message)."</div>";
            }
        ?>
        
         <?php echo form_errors($errors); ?>
       
        <h2>Edit Subject : <?php echo htmlentities($current_subject["menu_name"])?></h2>
        
        <form action="edit_subject.php?subject=<?php echo urlencode($current_subject["id"]); ?>" method="post">
            <p>Menu Name:
                <input type="text" name="menu_name" value="<?php echo htmlentities($current_subject["menu_name"])?>">
            </p>
            <p>Position:
                <select name="position">
                    <?php
                        $subject_set=  find_all_subjects(false);
                        $subject_count = mysqli_num_rows($subject_set);
                        for($count=1; $count <= $subject_count;$count++ )
                        {
                            echo "<option value=\"{$count}\"";
                            if($current_subject["position"] == $count){
                               echo "selected"; 
                            }
                            
                            echo ">$count</option>";
                        }
                    ?>
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="0" <?php if($current_subject["visible"] == 0) echo "checked"; ?> /> No
                &nbsp;
                <input type="radio" name="visible" value="1" <?php if($current_subject["visible"] == 1) echo "checked"; ?> /> Yes
            </p>
            <input type="submit" name="submit" value="Edit Subject" />
        </form>
        <br />
        <a href="manage_content.php">Cancel</a>
        &nbsp;
        &nbsp;
        <a href="delete_subject.php?subject=<?php echo htmlentities($current_subject["id"])?>" onclick="return confirm('Are you sure want to delete?');">Delete subject </a>
        
            
    </div>
</div>

<?php
    //4.Release returned data
    mysqli_free_result($result);
    ?>

<?php include ("../includes/layouts/footer.php");?>

