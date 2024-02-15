<?php
    session_start();


    $signout_user=$_SESSION['valid_user'];
    unset($_SESSION['valid_user']);
    unset($_SESSION['account_id']);
    unset($_SESSION['isLoggedIn']);
    session_destroy();

    if(!empty($signout_user))
    {
        echo "<script>alert('Logged out successfully! You will be sent back to the mainpage.');</script>";
        header("refresh:0;url=http://localhost/Bedok_85/home/index.php");
    }

    else
    {
        echo "You were not logged in at all.<br />"; 
    }

