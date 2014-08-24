
<?php 
        //presence or required
        function has_presence($value){
            return isset($value) && $value !== "";
            
        }
        
        //check below the max length
        function has_max_lenght($value, $max){
            return strlen($value) <= $max;
            
        }
        
        //check value in array or not
        function has_inclusion_in($value, $set){
            return in_array($value, $set);
            
        }
        
        
        function validate_max_lengths($fields_with_max_lenght){
            global $errors;
            foreach ($fields_with_max_lenght as $field => $max){
                $value = trim($_POST[$field]);
                if(!has_max_lenght($value, $max)){
                    $errors[$field]=  ucfirst($field)." is too long";
                }
            }
        }
        //display form errors
        function form_errors($errors){
            $output ="";
            if(!empty($errors)){

                    $output .= "<div class=\"error\">";
                    $output .=  "please fix the following errors";
                    $output .=  "<ul>";
                    foreach($errors as $key=>$error){
                        $output .= "<li> {$error} </li>";

                    }
                    $output .=  "</ul>";
                    $output .=  "</div>";
                }
                return $output;
        }
        
?>
        
        