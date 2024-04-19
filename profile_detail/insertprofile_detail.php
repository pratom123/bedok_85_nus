<?php
require('../src/UserRepository.php');
require('../src/User.php');

include('../login/logindb.php');

include '../common/connectDB.php';

if(!empty($_SESSION['valid_user']))
{
    // $getusername = $_SESSION['valid_user'];

    // $sql = "SELECT * from user
    // INNER JOIN credit_card
    // WHERE username ='$getusername' 
    // AND c_user_id = user_id" ;
    // $result = mysqli_query($conn, $sql);
    
    // if ($result) {
    //     $row = mysqli_fetch_assoc($result);
    // }

    $userQuery = new UserRepository($conn);

    $user = $userQuery->findByUsername($_SESSION['valid_user']);
    $cc = $user->getCreditCard();

}



mysqli_close($db);
    
?>