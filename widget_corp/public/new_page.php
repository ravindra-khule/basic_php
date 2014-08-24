<?php require_once ("../includes/session.php"); ?>
<?php require_once ("../includes/db_connection.php"); ?>
<?php require_once ("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php require_once ("../includes/validation_functions.php"); ?>


<?php
   find_selected_page();
?>
//Can't add new page unless we have subject as a parent
<?php
    if(!$current_subject){
        //subject is missing or invalid
        //subject couldn't be found in database.
        redirect_to("manage_content.php");
    }
?>
<?php

if(isset($_POST['submit'])){
   
    //validations
    $required_field = array("menu_name","position", "visible","content");
    validate_presences($required_field);
    
    $fields_with_max_lenght = array("menu_name" => 30);
    validate_max_lengths($fields_with_max_lenght);
    
    if(empty($errors)){
    
    $subject_id = $current_subject["id"];
    $menu_name = mysqli_prep($_POST["menu_name"]); 
    $content = mysqli_prep($_POST["content"]); 
    $position = (int) $_POST["position"];
    $visible =(int) $_POST["visible"];
  
    
    $query = "insert into pages (subject_id, menu_name, position, visible, content) values ({$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}')";
    $result = mysqli_query($connection, $query);
    if($result){
        //success
        $_SESSION["message"] = "Page created"; 
        redirect_to("manage_content.php?subject=".urlencode($current_subject["id"]));
    }
    else{
        //failure
        $_SESSION["message"] = "Page creation failed";
         
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
        <?php echo navigation($current_subject, $current_page); ?>
    </div>
    <div id="page">
        <?php echo message(); ?>
        
         <?php echo form_errors($errors); ?>
       
        <h2>Create Page </h2>
        
        <form action="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>" method="post">
            <p>Menu Name:
                <input type="text" name="menu_name" value="">
            </p>
            <p>Position:
                <select name="position">
                    <?php
                        $page_set= find_pages_for_subject($current_subject["id"]);
                        $page_count = mysqli_num_rows($page_set);
                        for($count=1; $count<=($page_count+1);$count++ )
                        {
                            echo "<option value=\"{$count}\">$count</option>";
                        }
                    ?>
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="0" /> No
                &nbsp;
                <input type="radio" name="visible" value="1" /> Yes
            </p>
            <p>Content:<br />
                <textarea name="content" rows=20 cols=80></textarea>
            </p>
            <input type="submit" name="submit" value="Create Page" />
        </form>
        <br />
        <a href="manage_content.php?subject=<?php echo urlencode($current_subject["id"]);?>">Cancel</a>
            
    </div>
</div>

<?php
    //4.Release returned data
    mysqli_free_result($result);
    ?>

<?php include ("../includes/layouts/footer.php");?>