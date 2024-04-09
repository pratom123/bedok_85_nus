<?php
include('../login/logindb.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bedok_85_nus";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    return;
}

if(!empty($_SESSION['valid_user']))
{
    $getusername = $_SESSION['valid_user'];

    $sql = "SELECT * from user
    INNER JOIN credit_card
    WHERE username ='$getusername' 
    AND c_user_id = user_id" ;
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
    }

}



mysqli_close($conn);
    
?>