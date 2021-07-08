<?php 
  session_start();
  require_once('../config/database_functions.php');
  $password =  $_POST['password'];
  $email =  $_POST['email'];
  $login = user_login($email,$password);
  $login_dec = json_decode($login,true);
  if($login_dec['status'] != 111){

    echo $login_dec['msg'];
  } else{
  	$_SESSION['uid'] = $login_dec['user_id']; 
    // $_SESSION['lname'] = $login_dec['lname']; 
    // $_SESSION['fname'] = $login_dec['fname']; 
    // $_SESSION['phone'] = $login_dec['phone']; 
    // $_SESSION['email'] = $login_dec['email'];
    echo 200;
     

  }

?>