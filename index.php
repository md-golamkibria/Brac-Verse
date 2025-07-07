<?php
require_once('assets/php/functions.php');

if(isset($_SESSION['Auth'])){
    $user = getUser($_SESSION['user']['id']);
}

//manage pages
$page_count = count($_GET);

if(isset($_SESSION['Auth']) && $user['ac_status']==1 && !$page_count) {
    //$userdata = $_SESSION['user'];
    showPage('header',['page_title'=>'Home']);
    showPage('navbar',[]);
    showPage('wall',[]);

}elseif(isset($_SESSION['Auth']) && $user['ac_status']==0 && !$page_count) {
    showPage('header',['page_title'=>'Verify your Email']);
    showPage('verify_email',[]);

}elseif(isset($_SESSION['Auth']) && $user['ac_status']==2 && !$page_count) {
    showPage('header',['page_title'=>'Blocked']);
    showPage('blocked',[]);

}elseif(isset($_SESSION['Auth']) && isset($_GET['edit_profile'])){
    showPage('header',['page_title'=>'Edit Profile']);
    showPage('navbar',[]);
    showPage('edit_profile',[]);

}elseif(isset($_GET['signup'])) {
    showPage('header',['page_title'=>'Brac Verse Sign Up']);
    showPage('signup',[]);

}elseif(isset($_GET['login'])) {
    showPage('header',['page_title'=>'Brac Verse Login']);
    showPage('login',[]);
}else {
    if(isset($_SESSION['Auth'])){
        showPage('header',['page_title'=>'Home']);
        showPage('navbar',[]);
        showPage('wall',[]);
    }else{

        if(isset($_SESSION['Auth'])){
            showPage('header',['page_title'=>'Home']);
            showPage('navbar',[]);
            showPage('wall',[]);
        }else{
            showPage('header',['page_title'=>'Brac Verse Login']);
            showPage('login',[]);
}
}
}


showPage('footer',[]);
unset($_SESSION['error']);
unset($_SESSION['formdata']);
?>