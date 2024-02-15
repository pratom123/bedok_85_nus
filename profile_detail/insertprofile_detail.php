<?php
include('../login/logindb.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bedok_85";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    return;
}

if(!empty($_SESSION['valid_user']))
{
    $getusername = $_SESSION['valid_user'];

    $sql = "SELECT * from Account_information WHERE username ='$getusername'";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);

}

}



mysqli_close($conn);
    
?>