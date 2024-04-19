<?php 
    include 'initialize_all.php';
    session_start();
    // session_unset();
    // echo 'Hello';
    // $_SESSION['account_id'] = true;
    if (!isset($_SESSION['account_id']) || empty($_SESSION['account_id']))
        header("Location: http://54.162.72.241/bedok_85_nus/login/login.php");  //user not logged in, redirect to login page
?>