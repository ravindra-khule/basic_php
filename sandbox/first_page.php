<!DOCTYPE html>

<html>
    <head>
        <title>First Page</title> 
    </head>
    <body>
        
        <?php 
            $secon_page_name="second page";
            $id=2;
            $campany_name="Johnson & Johnson";
        ?>
        <a href="second_page.php?id=<?php echo $id; ?>&campany_name=<?php echo urlencode($campany_name); ?>"><?php echo $secon_page_name;?></a>
    </body>
</html>
