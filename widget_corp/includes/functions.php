<?php

function confirm_query($result_set){
    
    if(!$result_set){
        die("database query failed: ");
    }
}

function form_errors($errors){
            $output ="";
            if(!empty($errors)){

                    $output .= "<div class=\"error\">";
                    $output .=  "please fix the following errors";
                    $output .=  "<ul>";
                    foreach($errors as $key=>$error){
                        $output .= "<li>";
                        $output .= htmlentities($error);
                        $output .= "</li>";

                    }
                    $output .=  "</ul>";
                    $output .=  "</div>";
                }
                return $output;
        }

function redirect_to($new_location){
        header("Location: ".$new_location);
        exit;
        
    }
    
function mysqli_prep($string){
    
    global $connection;
    $menu_name = mysqli_real_escape_string($connection, $string);
    return $menu_name;
}

function find_all_subjects($public=true){
    
    global $connection;
    
    $query = "select * ";
    $query .= "from subjects ";
    if($public){
        $query .= "where visible=1 ";
    }
    $query .= "order by position asc";
   
    $result = mysqli_query($connection, $query);
    
    confirm_query($result);
    return $result;
    
}

function find_all_admins(){
    
    global $connection;
    
    $query = "select * ";
    $query .= "from admins ";
    $query .= "order by username asc";
   
    $admin_set = mysqli_query($connection, $query);
    
    confirm_query($admin_set);
    return $admin_set;
    
}

function find_admin_by_id($admin_id){
    
        global $connection;
        
        $safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
        
        $query = "select * from admins where id = {$safe_admin_id} ";
        $query .="limit 1";
        $admin_set = mysqli_query($connection, $query);
        confirm_query($admin_set);
        if($admin = mysqli_fetch_assoc($admin_set)){
            return $admin;
        }
        else {
            return null;
        }
    
}   

function find_admin_by_username($username){
    
        global $connection;
        
        $safe_username = mysqli_real_escape_string($connection, $username);
        
        $query = "select * from admins where username = '{$safe_username}' ";
        $query .="limit 1";
        $admin_set = mysqli_query($connection, $query);
        confirm_query($admin_set);
        $admin = mysqli_fetch_assoc($admin_set);
        if($admin){
            mysqli_fetch_assoc($result);
            return $admin;
        }
        else {
            return null;
        }
    
}   

function find_pages_for_subject($subject_id, $public=true){
    
    global $connection;
    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
    $query = "select * from pages ";
    $query .= "where subject_id= {$safe_subject_id} ";
    if($public){
        $query .= "and visible = 1 ";
    }
    $query .= "order by position asc";
                    
    $page_set = mysqli_query($connection, $query);
    //test if there was query error
    confirm_query($page_set);
    return $page_set;
    
}

function find_subject_by_id($subject_id, $public=true){
    
        global $connection;
        
        $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
        
        $query = "select * from subjects where id = {$safe_subject_id} ";
        if($public){
            $query .= "and visible = 1 ";
        }
        $query .="limit 1";
        $result = mysqli_query($connection, $query);
        confirm_query($result);
        if($subject = mysqli_fetch_assoc($result)){
            return $subject;
        }
        else {
            return null;
        }
    
}   

function find_page_by_id($page_id, $public=true){
    
        global $connection;
        
        $safe_page_id = mysqli_real_escape_string($connection, $page_id);
        
        $query = "select * from pages where id = {$safe_page_id} ";
        if($public){
            $query .= "and visible = 1 ";
        }
        $query .="limit 1";
        $result = mysqli_query($connection, $query);
        confirm_query($result);
        if($page = mysqli_fetch_assoc($result)){
            return $page;
        }
        else {
            return null;
        }
}

function find_default_page_for_subject($subject_id){
    $page_set = find_pages_for_subject($subject_id);
     if($first_page = mysqli_fetch_assoc($page_set)){
            return $first_page;
        }
        else {
            return null;
        }
    
}

function find_selected_page($public = FALSE){
    
        global $current_subject;
        global $current_page;

        if(isset($_GET["subject"])){
           $current_subject = find_subject_by_id($_GET["subject"], $public);
           if($current_subject && $public){
             $current_page = find_default_page_for_subject($current_subject["id"]);
           }
           else
           {
              $current_page = null; 
           }
        }
        elseif (isset($_GET["page"])) {          
            $current_page = find_page_by_id($_GET["page"], $public);        
            $current_subject =null;
        }
        else {
             $current_subject =null;
             $current_page = null;
        }
}

        
//navigation takes two arguments.
//-the current subject array or null 
//-the current page array or null

function navigation($subject_array, $page_array ){

            $output = "<ul class=\"subjects\">";   
            $result = find_all_subjects(false);
            
            while($subject= mysqli_fetch_assoc($result)){
                //heiglight selected naviagtion
                $output .="<li";
                if($subject_array && $subject["id"] == $subject_array["id"]){
                    $output .= " class=\"selected\"";
                }
                $output .= ">";
                //get subject 
                $output .="<a href=\"manage_content.php?subject=";
                $output .= urldecode($subject["id"]);
                $output .="\">";
                $output .= htmlentities($subject["menu_name"]); 
                $output .="</a>";
           
                $page_set = find_pages_for_subject($subject["id"], false);              
                $output .="<ul class=\"pages\">";                       
                    while($page = mysqli_fetch_assoc($page_set)){
                        $output .= "<li";
                        if($page_array && $page["id"] == $page_array["id"]){
                        $output .= " class=\"selected\"";
                        }
                        $output .= ">";
                   
                       $output .="<a href=\"manage_content.php?page=";
                       $output .= urldecode($page["id"]);
                       $output .= "\">";
                       $output .= htmlentities($page["menu_name"]); 
                       $output .="</a></li>";
                    }
                    mysqli_free_result($page_set);
                 $output .="</ul> </li>";
            }      
            mysqli_free_result($result);
            $output .="</ul>"; 
            
            return $output;
}


function public_navigation($subject_array, $page_array ){

            $output = "<ul class=\"subjects\">";   
            $result = find_all_subjects();
            
            while($subject= mysqli_fetch_assoc($result)){
                //heiglight selected naviagtion
                $output .="<li";
                if($subject_array && $subject["id"] == $subject_array["id"]){
                    $output .= " class=\"selected\"";
                }
                $output .= ">";
                //get subject 
                $output .="<a href=\"index.php?subject=";
                $output .= urldecode($subject["id"]);
                $output .="\">";
                $output .= htmlentities($subject["menu_name"]); 
                $output .="</a>";
           
                if($subject_array["id"] == $subject["id"] || 
                        $page_array["subject_id"] == $subject["id"]){
                    $page_set = find_pages_for_subject($subject["id"]);              
                    $output .="<ul class=\"pages\">";                       
                    while($page = mysqli_fetch_assoc($page_set)){
                        $output .= "<li";
                        if($page_array && $page["id"] == $page_array["id"]){
                        $output .= " class=\"selected\"";
                        }
                        $output .= ">";
                   
                       $output .="<a href=\"index.php?page=";
                       $output .= urldecode($page["id"]);
                       $output .= "\">";
                       $output .= htmlentities($page["menu_name"]); 
                       $output .="</a></li>";
                    }
                    mysqli_free_result($page_set);
                 $output .="</ul>";
                }
                 $output .="</li>";//End of the subject li
            }      
            mysqli_free_result($result);
            $output .="</ul>"; 
            
            return $output;
}

function password_encrypt($password){
    $hash_format = "$2y$10$";
    $salt_length = 22;
    $salt = generate_salt($salt_length);
    $format_and_salt = $hash_format.$salt;
    $hash = crypt($password, $format_and_salt);
    return $hash; 
}

function generate_salt($length){
    //Not 100% unique , Not 100% random, but good enough for salt
    //Md5 teturns 32 character
    $unique_random_string = md5(uniqid(mt_rand(),TRUE));
    
    //valid charcters fro salt are [a-z A-Z 0-9]
    $base64_string = base64_encode($unique_random_string);
    
    //But not '+' is valid in base64 encoding
    $modified_base64_string = str_replace('+', '.', $base64_string);
    
    //Truncate string to correct lenght
    $salt = substr($modified_base64_string, 0, $length);
    return $salt; 
}

function password_check($password, $existing_hash){
    $hash = crypt($password, $existing_hash);
        
    if($hash === $existing_hash){
        return TRUE;
    }
    else{
        return false;
    }
}

function attempt_login($username, $password){
    $admin = find_admin_by_username($username);
    if($admin){
        //found admin, now check password
        if(password_check($password, $admin["hashed_password"])){
            //password matches
            return $admin;
        }
        else{
            //password doesn't match
            //echo "password doesn't match";
            return $admin;
        }
    }
    else{
        //admin not found
       // echo "user not found";
        return false;
    }
}

function logged_in(){
    return isset($_SESSION["admin_id"]);
}

function confirm_logged_in(){
    if(!logged_in()){
            redirect_to("login.php");
    }
}

