<!DOCTYPE html>

<html>
    <head>
        <title>String Function </title> 
    </head>
    
    <body>
        <?php
            $first="The quick brown fox";
            $second=" jumped over the lazy dog";
            $third=$first;
            $third.=$second;
            echo $third;
        
        ?>
        <br />
        
        Lowercase:  <?php echo strtolower($third);?><br />
        Uppercase:  <?php echo strtoupper($third);?><br />
        Uppercase first:  <?php echo ucfirst($third);?><br />
        Uppercase word:  <?php echo ucwords($third);?><br />
        <br />
        <br />
        
        Lenght:  <?php echo strlen($third);?><br />
        Trim:  <?php echo "A".trim("     B          C        D      ")."E";?><br />
        Find:  <?php echo strstr($third, "The");?><br />
        Replace by string:  <?php echo str_replace("quick", "super-fast", $third);?><br />
        
      </body>
</html>
