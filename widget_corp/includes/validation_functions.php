
<?php 
   
        $errors = array();
        
        function field_name_as_text($fieldname){
            $fieldname = str_replace("_", " ", $fieldname);
            $fieldname = ucfirst($fieldname);
            return $fieldname;
        }
        
        //presence or required
        function has_presence($value){
            return isset($value) && $value !== "";
            
        }
        
        function validate_presences($required_field){
            global $errors;
            
            foreach($required_field as $field)
            {
                $value=trim($_POST[$field]);
                if(!has_presence($value)){
                    $errors[$field] = ucfirst($field). " can't be blank"; 
                }
            }
        }
        
        //check below the max length
        function has_max_lenght($value, $max){
            return strlen($value) <= $max;
            
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
        
        //check value in array or not
        function has_inclusion_in($value, $set){
            return in_array($value, $set);
            
        }
        
        
      
       
        
?>
        
        