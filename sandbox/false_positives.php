<!DOCTYPE html>

<html>
    <head>
        <title>False positives </title> 
    </head>
    
    <body>
        <?php
            function is_equal($value1, $value2){
                $output= "{$value1} == {$value2}::";
                if($value1 == $value2){
                    $output .= "    true. <br />";
                }
                else{
                    $output .= "    false.<br />";
                }
                 return $output;       
            }
            
            echo is_equal(0, FALSE);
            echo is_equal(4, TRUE);
            echo is_equal(0, NULL);
            echo is_equal(0, "0");
            echo is_equal(0, "");
            echo is_equal(0, "a");
            echo is_equal(1, "01");
            echo is_equal("", NULL);
            echo is_equal(3, "3 dogs");
            echo is_equal(100, "1e2");
            echo is_equal(100, 100.00);
            echo is_equal("abc", TRUE);
            echo is_equal("123", "     123");
            echo is_equal("123", "+0123");
            
        ?>
        
    </body>
</html>
