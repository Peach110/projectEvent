<?php
$email = $_POST['email'];
$password = $_POST['password'];
$result = login( $email, $password,$password);
if($result){
    $unix_timestamp = time();
    $_SESSION['timestamp'] = $unix_timestamp;
    $_SESSION['user_id'] = $result['user_id'];
    renderView('main_get', $result);
}else{
    $_SESSION['message'] = 'Email or Password invalid';
    renderView('login_get');
    unset($_SESSION['message']);
    unset($_SESSION['timestamp']);
}


