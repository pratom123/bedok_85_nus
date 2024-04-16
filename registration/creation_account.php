<?php

include '../common/connectDB.php';


$firstname=$_GET['firstname'];
$lastname=$_GET['lastname'];
$username=$_GET['username'];
$password=$_GET['password'];
$pwCheck=$_GET['pwCheck'];
$email=$_GET['email'];
$phoneno=$_GET['contact_no'];
$addr1=$_GET['addr1'];
$addr2=$_GET['addr2'];
$addr3=$_GET['addr3'];
$creditcard=$_GET['card_num'];
$creditname=$_GET['card_name'];
$cv2=$_GET['security_code'];
$expirydate=$_GET['expiry_date'];


$sql = "SELECT username from user WHERE username ='$username'";
$result = mysqli_query($db, $sql);

if(mysqli_num_rows($result) > 0){

    echo "<script>alert('Username has been used. Please choose another username.');</script>";
    header("refresh:0;url=registration.php");

} elseif($pwCheck == $password) {
    create_account($firstname,$lastname,$username,$password,$email,$phoneno,$addr1,$addr2,$addr3,$creditcard,$creditname,$cv2,$expirydate);
    echo "<script>alert('Account has been created! You will be sent back to the mainpage.');</script>";
    header("refresh:0;url=../login/login.php");

}else{
    echo "<script>alert('Passwords do not match! Please try again.');</script>";
    header("refresh:0;url=registration.php");
}

mysqli_close($db);    

    function create_account($firstname, $lastname, $username, $password, $email, $phoneno, $addr1,$addr2,$addr3, $creditcard, $creditname, $cv2, $expirydate) {
        $db = mysqli_connect("localhost", "root", "", "Bedok_85_nus");
    
        if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
            return;
        }
        
        // Concatenate address fields
        $address = $addr1 . ' ' . $addr2 . ' ' . $addr3;
        
        // Insert into the user table
        $sqlUser = "INSERT INTO user (username, password, contact_no, email, address, user_type) VALUES ('$username', '$password', '$phoneno', '$email', '$address', 'customer')";
        
        if (!mysqli_query($db, $sqlUser)) {
            echo "Failed to create user account: " . mysqli_error($db);
            mysqli_close($db);
            return;
        }
    
        // Get the last inserted user_id
        $userId = mysqli_insert_id($db);
    
        // Insert into the customer table
        $sqlCustomer = "INSERT INTO customer (c_user_id, first_name, last_name) VALUES ('$userId', '$firstname', '$lastname')";
        
        if (!mysqli_query($db, $sqlCustomer)) {
            echo "Failed to create customer profile: " . mysqli_error($db);
            
        }
    
        // Insert into the credit_card table
        $sqlCreditCard = "INSERT INTO credit_card (c_user_id, credit_card_no, card_name, cv2, expiry_date) VALUES ('$userId', '$creditcard', '$creditname', '$cv2', '$expirydate')";
        
        if (!mysqli_query($db, $sqlCreditCard)) {
            echo "Failed to add credit card details: " . mysqli_error($db);
          
        }
    
        mysqli_close($db);
    }
    
?>