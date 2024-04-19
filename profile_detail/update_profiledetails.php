<?php
include('insertprofile_detail.php');
include '../common/connectDB.php';

$userUpdated = new User($_GET['user_id'],$_GET['username'],$_GET['password'],
$_GET['phoneno'],$_GET['email'],$_GET['addr1'],$user->getUserType(),
new CreditCard($_GET['user_id'],$_GET['card_num'],$_GET['card_name'],$_GET['security_code'],$_GET['expiry_date']));

$userQuery = new UserRepository($db);
$userQuery->save($userUpdated);
// $password=$_GET['password'];
// $email=$_GET['email'];
// $phoneno=$_GET['phoneno'];
// $addr1=$_GET['addr1'];
// // $addr2=$_GET['addr2'];
// // $addr3=$_GET['addr3'];
// $creditcard=$_GET['card_num'];
// $creditname=$_GET['card_name'];
// $cv2=$_GET['security_code'];
// $expirydate=$_GET['expiry_date'];
// $username=$row['username'];
// $user_id = $row['user_id'];

if(!empty($email)){
    
    $sql = "UPDATE user SET email = '$email' WHERE username = '$username'";

    mysqli_query($db, $sql);
}

if(!empty($password)){
    
    $sql = "UPDATE user SET password = '$password' WHERE username = '$username'";

    mysqli_query($db, $sql);
}
if(!empty($phoneno)){
    $sql = "UPDATE user SET contact_no = '$phoneno' WHERE username = '$username'";

    mysqli_query($db, $sql);
}
if(!empty($addr1)){
    $sql = "UPDATE user SET address = '$addr1' WHERE username = '$username'";

    mysqli_query($db, $sql);
}


if((!empty($creditcard)) && (!empty($creditname)) && (!empty($cv2)) && (!empty($expirydate))){

    if(!empty($creditcard)){
        $sql = "UPDATE credit_card SET credit_card_no = '$creditcard' WHERE c_user_id = '$user_id'";
    
        mysqli_query($db, $sql);
    }

    if(!empty($creditname)){
        $sql = "UPDATE credit_card SET card_name = '$creditname' WHERE c_user_id = '$user_id'";
    
        mysqli_query($db, $sql);
    }

    if(!empty($cv2)){
        $sql = "UPDATE credit_card SET cv2 = '$cv2' WHERE c_user_id = '$user_id'";
    
        mysqli_query($db, $sql);
    }
    if(!empty($expirydate)){
        $sql = "UPDATE credit_card SET expiry_date = '$expirydate' WHERE c_user_id = '$user_id'";
    
        mysqli_query($db, $sql);
    }
}


echo "<script>alert('Profile change successfull! You will be sent back to your profile details.');</script>";
header("refresh:0;url=profile_details.php");
