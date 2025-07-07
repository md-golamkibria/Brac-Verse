<?php
require_once 'functions.php';
require_once 'send_code.php';


//Signp action
if(isset($_GET['signup'])) {
    $response=validateSignupForm($_POST);
    if($response['status']){
        if(createUser($_POST)){
            header("location:../../?login&newuser");
            }else {
                echo "<script>alert('User creation failed')</script>";
            }
        }else{
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
        header("location:../../?signup");
    }
    }

    //login action
    if(isset($_GET['login'])) {

        $response=validateLoginForm($_POST);
        if($response['status']){
            $_SESSION['Auth'] = true;
            $_SESSION['user'] = $response['user'];
            if($response['user']['ac_status']==0){
                $_SESSION['code'] = $code = rand(111111,999999);
                sendCode($response['user']['email'],'Verify your Email',$code);
            }

            header("location:../../");

            }else{
            $_SESSION['error']=$response;
            $_SESSION['formdata']=$_POST;
            header("location:../../?login");
        }

        }


        if(isset($GET['resend_code'])){
            $_SESSION['code'] = $code = rand(111111,999999);
            sendCode($response['user']['email'],'Verify your Email',$code);
            header('location:../../?resended');
        }


        if(isset($GET['verify_email'])){
            $user_code = $_POST['code'];
            $code = $_SESSION['code'];
            if($user_code == $code){
                if(verify_email($_SESSION['user']['email'])){
                header('location:../../');
                }else{
                echo "Something went wrong";
                }

        }else{
            $response['msg']='Incorrect Code';
            $response['field']='email_verify';
            $_SESSION['error']=$response;
            header('location:../../');
        }
    }

//for logout
        if(isset($_GET['logout'])){
            session_destroy();
            header('location:../../');
        }


//for updating profile
if(isset($_GET['updateprofile'])){

    $response=validateUpdateForm($_POST, $_FILES['profile_pic']);
    print_r($response);
    // if($response['status']){
    //     if(createUser($_POST)){
    //         header("location:../../?login&newuser");
    //         }else {
    //             echo "<script>alert('User creation failed')</script>";
    //         }
    //     }else{
    //     $_SESSION['error']=$response;
    //     $_SESSION['formdata']=$_POST;
    //     header("location:../../?signup");
    // }


        }