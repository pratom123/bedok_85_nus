<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bedok_85";

// Create connection(
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    return;
}



$firstname=$_GET['firstname'];
$lastname=$_GET['lastname'];
$username=$_GET['username'];
$password=$_GET['password'];
$pwCheck=$_GET['pwCheck'];
$email=$_GET['email'];
$phoneno=$_GET['phoneno'];
$addr1=$_GET['addr1'];
$addr2=$_GET['addr2'];
$creditcard=$_GET['card_num'];
$creditname=$_GET['card_name'];
$cv2=$_GET['security_code'];
$expirydate=$_GET['expiry_date'];



$sql = "SELECT username from Account_information WHERE username ='$username'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

    echo "<script>alert('Username has been used. Please choose another username.');</script>";
    header("refresh:0;url=registration.php");

} elseif($pwCheck == $password) {
    create_account($firstname,$lastname,$username,$password,$email,$phoneno,$addr1,$addr2,$creditcard,$creditname,$cv2,$expirydate);
    echo "<script>alert('Account has been created! You will be sent back to the mainpage.');</script>";
    header("refresh:0;url=../login/login.php");

}else{
    echo "<script>alert('Passwords do not match! Please try again.');</script>";
    header("refresh:0;url=registration.php");
}

mysqli_close($conn);    



function create_account($firstname,$lastname,$username,$password,$email,$phoneno,$addr1,$addr2,$creditcard,$creditname,$cv2,$expirydate) {
    $conn = mysqli_connect("localhost","root","","Bedok_85");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        return;
    }

    $sql = "INSERT INTO Account_information"."(firstname,lastname,username,password_info,e_mail,mobile_no,Address1,Address2,credit_card,card_name,cv2,expirydate)".  "VALUES". "('$firstname','$lastname','$username','$password','$email','$phoneno','$addr1','$addr2','$creditcard','$creditname','$cv2', '$expirydate')";
    if (!mysqli_query($conn,$sql)) {
        echo"Failed to update order list: " . mysqli_error($conn);
        mysqli_close($conn);
    }
}