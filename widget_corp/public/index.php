<?php require_once ("../includes/session.php"); ?>
<?php require_once ("../includes/db_connection.php"); ?>
<?php require_once ("../includes/functions.php"); ?>
<?php $layout_contex = "public" ?>
<?php include ("../includes/layouts/header.php"); ?>

<?php
   find_selected_page(true);
?>

<div id="main">
    <div id="navigation">
        <?php echo public_navigation($current_subject, $current_page); ?>
    </div>
    <div class="page">  
       <?php 
            if($current_page){
                ?>
            <h2><?php echo htmlentities($current_page["menu_name"]); ?></h2>
                <?php echo nl2br(htmlentities($current_page["content"])); ?>
                
            <?php
            }
            else{
                echo "Welcome!";
            }      
        ?>
         
    </div>
</div>

<?php
    //4.Release returned data
    mysqli_free_result($result);
    ?>

<?php include ("../includes/layouts/footer.php");?>

