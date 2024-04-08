<?php
include('insertprofile_detail.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bedok_85_nus";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    return;
}


$password=$_GET['password'];
$email=$_GET['email'];
$phoneno=$_GET['phoneno'];
$addr1=$_GET['addr1'];
$addr2=$_GET['addr2'];
$addr3=$_GET['addr3'];
$creditcard=$_GET['card_num'];
$creditname=$_GET['card_name'];
$cv2=$_GET['security_code'];
$expirydate=$_GET['expiry_date'];
$username=$row['username'];

if(!empty($email)){
    
    $sql = "UPDATE Account_information SET e_mail = '$email' WHERE username = '$username'";

    mysqli_query($conn, $sql);
}

if(!empty($password)){
    
    $sql = "UPDATE Account_information SET password_info = '$password' WHERE username = '$username'";

    mysqli_query($conn, $sql);
}
if(!empty($phoneno)){
    $sql = "UPDATE Account_information SET mobile_no = '$phoneno' WHERE username = '$username'";

    mysqli_query($conn, $sql);
}
if(!empty($addr1)){
    $sql = "UPDATE Account_information SET Address1 = '$addr1' WHERE username = '$username'";

    mysqli_query($conn, $sql);
}
if(!empty($addr2)){
    $sql = "UPDATE Account_information SET Address2 = '$addr2' WHERE username = '$username'";

    mysqli_query($conn, $sql);
}
if(!empty($addr3)){
    $sql = "UPDATE Account_information SET Address3 = '$addr3' WHERE username = '$username'";

    mysqli_query($conn, $sql);
}

if((!empty($creditcard)) && (!empty($creditname)) && (!empty($cv2)) && (!empty($expirydate))){

    if(!empty($creditcard)){
        $sql = "UPDATE Account_information SET credit_card = '$creditcard' WHERE username = '$username'";
    
        mysqli_query($conn, $sql);
    }

    if(!empty($creditname)){
        $sql = "UPDATE Account_information SET card_name = '$creditname' WHERE username = '$username'";
    
        mysqli_query($conn, $sql);
    }

    if(!empty($cv2)){
        $sql = "UPDATE Account_information SET cv2 = '$cv2' WHERE username = '$username'";
    
        mysqli_query($conn, $sql);
    }
    if(!empty($expirydate)){
        $sql = "UPDATE Account_information SET expirydate = '$expirydate' WHERE username = '$username'";
    
        mysqli_query($conn, $sql);
    }
}


echo "<script>alert('Profile change successfull! You will be sent back to your profile details.');</script>";
header("refresh:0;url=profile_details.php");
