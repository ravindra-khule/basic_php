<!DOCTYPE html>

<html>
    <head>
        <title></title> 
    </head>
    
    <body>
        <?php 
            function add_sub($val1,$val2){
                $add = $val1 + $val2;
                $sub = $val1 - $val2;
                
                return array($add,$sub);
                
            }
            $string1="ravi";
            $result_array=add_sub(5, 6);
            echo "Add:".$result_array[0]."<br />";
            echo "Sub:".$result_array[1]."<br />";
            
            list($addition,$substraction)=  add_sub(20, 7);
            echo "Add:".$addition."<br />";
            echo "Sub:".$substraction."<br />";
            
            var_dump($addition);
            echo "<br />";
            var_dump($result_array);
            echo "<br />";
            var_dump($string1);
            
        ?>
        <pre>
        <?php
        print_r(get_defined_vars());
        ?>
        </pre>
    </body>
</html>
