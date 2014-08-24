<?php require_once ("../includes/session.php"); ?>
<?php require_once ("../includes/db_connection.php"); ?>
<?php require_once ("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php $admin_set = find_all_admins(); ?>

<?php $layout_contex = "admin" ?>
<?php include ("../includes/layouts/header.php"); ?>


<div id="main">  
    <div id="navigation">
         <br/>
        <a href="admin.php">&laquo;Main Menu</a><br /><br /><br />
    </div>
    <div class="page">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php echo form_errors($errors); ?>
        <h2>Manage Admins</h2>
        
        <table>
            <tr>
                <th style="text-align: left; width: 200px;">Username</th>
                <th colspan="2" style="text-align: left">Actions</th>
            </tr>
            <?php while($admin =  mysqli_fetch_assoc($admin_set)){ ?>
            <tr>
                <td><?php echo htmlentities($admin["username"]); ?></td>
                <td><a href="edit_admin.php?id=<?php echo urldecode($admin["id"]); ?>">Edit</a></td>
                <td><a href="delete_admin.php?id=<?php echo urldecode($admin["id"]);?>" onclick="return confirm('Are you sure want to delete?')">Delete</a></td>
            </tr>
            <?php } ?>
        </table>
        <br />
        <br />
        
         <a href="new_admin.php"> + Add new admin user</a>
    </div>
</div>

<?php
    //4.Release returned data
    mysqli_free_result($result);
    ?>


<?php include ("../includes/layouts/footer.php");?>

