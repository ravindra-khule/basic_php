<?php 
    if(!isset($layout_contex)){
        $layout_contex = "public";
    } 
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Widget Corp <?php if($layout_contex == "admin"){ echo "admin";} ?></title> 
        <link href="stylesheets/public.css" media="all" rel="stylesheet"/>
    </head>
    
    <body>
        <div id="header">
            <h1>Widget Corp <?php if($layout_contex == "admin"){ echo "admin";} ?></h1>
        </div>