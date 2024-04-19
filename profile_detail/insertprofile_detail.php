<?php
require('../src/UserRepository.php');
require('../src/User.php');

include('../login/logindb.php');

include '../common/connectDB.php';

if(!empty($_SESSION['valid_user']))
{
    $userQuery = new UserRepository($db);

    $user = $userQuery->findByUsername($_SESSION['valid_user']);
    $cc = $user->getCreditCard();
}



mysqli_close($db);
    
?>