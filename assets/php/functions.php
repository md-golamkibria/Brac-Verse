<?php
require_once 'config.php';
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("Error connecting to database");

//function for showing the page
function showPage($page,$data="") {
    include("assets/pages/$page.php");
}

//function for showing the error message
function showError($field){
    if(isset($_SESSION['error'])){
        $error=$_SESSION['error'];
        if(isset($error['field']) && $field==$error['field']){
            ?>
            <div class="alert alert-danger my-2" role="alert">
                <?=$error['msg']?>
            </div>
            <?php
        }
    }
}

//function for show existing form data

function showFormData($field){
    if(isset($_SESSION['formdata'])){
        $formdata=$_SESSION['formdata'];
        return $formdata[$field];
        }
    }

//duplicate email check
function isEmailRegistered($email){
    global $db;
    $query="SELECT count(*) as row FROM users WHERE email='$email'";
    $result=mysqli_query($db,$query);
    $return_data=mysqli_fetch_assoc($result);
    return $return_data['row'];
}

//duplicate username check
function isUsernameRegistered($username){
    global $db;
    $query="SELECT count(*) as row FROM users WHERE username='$username'";
    $result=mysqli_query($db,$query);
    $return_data=mysqli_fetch_assoc($result);
    return $return_data['row'];
}

//duplicate username check
function isUsernameRegisteredByOther($username){
    global $db;
    $query="SELECT count(*) as row FROM users WHERE username='$username' && id!={$_SESSION['user']['id']}";
    $result=mysqli_query($db,$query);
    $return_data=mysqli_fetch_assoc($result);
    return $return_data['row'];
}



//function for validating the signup form
function validateSignupForm($form_data){
    $response=array();
    $response['status']=true;

    if(!$form_data['password']){
        $response['msg']="Password name is required";
        $response['status']=false;
        $response['field']="password";
    }

    if(!$form_data['username']){
        $response['msg']="Username is required";
        $response['status']=false;
        $response['field']="username";
    }

    if(!$form_data['email']){
        $response['msg']="Email name is required";
        $response['status']=false;
        $response['field']="email";
    }

    if(!$form_data['last_name']){
        $response['msg']="Last name is required";
        $response['status']=false;
        $response['field']="last_name";
    }

    if(!$form_data['first_name']){
        $response['msg']="First name is required";
        $response['status']=false;
        $response['field']="first_name";
    }

    if(isEmailRegistered($form_data['email'])){
        $response['msg']="Email already registered";
        $response['status']=false;
        $response['field']="email";
    }
    if(isUsernameRegistered($form_data['username'])){
        $response['msg']="Username already registered";
        $response['status']=false;
        $response['field']="username";
    }
    return $response;

}

//function for validating the login form

function validateLoginForm($form_data){
    $response=array();
    $response['status']=true;
    $blank = false;

    if(!$form_data['password']){
        $response['msg']="Password is required";
        $response['status']=false;
        $response['field']="password";
        $blank = true;
    }

    if(!$form_data['username_email']){
        $response['msg']="Username/email is required";
        $response['status']=false;
        $response['field']="username_email";
        $blank = true;

    }

    if(!$blank && !checkUser($form_data)['status']){
        $response['msg']="Login credentials not matched. Please try again";
        $response['status']=false;
        $response['field']="checkuser";
    }else {
        $response['user']=checkUser($form_data)['user'];
    }

    return $response;

}

//check user login
function checkUser($login_data){
    global $db;
    $username_email=$login_data['username_email'];
    $password=md5($login_data['password']);
    $query="SELECT * FROM users WHERE (username='$username_email' || email='$username_email') && password='$password'";
    $result=mysqli_query($db,$query);
    $return_data['user']=mysqli_fetch_assoc($result)??array();
    if(count($return_data['user'])>0){
        $return_data['status']=true;
    }else {
        $return_data['status']=false;
    }
    return $return_data;
}

//Get user by id
function getUser($user_id){
    global $db;
    $query="SELECT * FROM users WHERE id=$user_id";
    $result=mysqli_query($db,$query);
    return mysqli_fetch_assoc($result);

}


//Creating new user
function createUser($data){
    global $db;
    $password=md5($data['password']);
    $query="INSERT INTO users (first_name,last_name,gender,email,username,password) VALUES ('{$data['first_name']}','{$data['last_name']}',{$data['gender']},'{$data['email']}','{$data['username']}','$password')";
    $result=mysqli_query($db,$query);
    return $result;

}

//verify email
function verify_email($email){
    global $db;
    $query="UPDATE users SET ac_status=1 WHERE email='$email'";
    $result=mysqli_query($db,$query);
    return $result;
}

//for validating update form


function validateUpdateForm($form_data, $image_data){
    $response=array();
    $response['status']=true;

    if(!$form_data['username']){
        $response['msg']="Username is required";
        $response['status']=false;
        $response['field']="username";
    }

    if(!$form_data['last_name']){
        $response['msg']="Last name is required";
        $response['status']=false;
        $response['field']="last_name";
    }

    if(!$form_data['first_name']){
        $response['msg']="First name is required";
        $response['status']=false;
        $response['field']="first_name";
    }



    if(isUsernameRegisteredByOther($form_data['username'])){
        $response['msg']=$form_data['username']." already registered";
        $response['status']=false;
        $response['field']="username";
    }

    if($image_data['name']){
        $image = basename($image_data["name"]);
        $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
        $size = $image_data["size"]/1024;
        if($type != "jpg" && $type != "png" && $type != "jpeg" && $type != "gif" ){
            $response['msg']="only jpg, jpeg, png and gif files are allowed";
            $response['status']=false;
            $response['field']="profile_pic";
        }

        if($size > 1024){
            $response['msg']="File size must be less than 1 MB";
            $response['status']=false;
            $response['field']="profile_pic";
        }
    }
    return $response;

}






?>