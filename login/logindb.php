<?php
// include '../common/initialize_all.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bedok_85";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    return;
}

session_start();

if( isset($_POST['username']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = 'SELECT * from Account_information '
            ."WHERE username ='$username'"
            . "and password_info ='$password'";
    $result = $conn->query($sql);
    if($result->num_rows>0)
    {
        $loginst=1;
        $_SESSION['valid_user'] = $username;
        $row = $result->fetch_assoc();
        $_SESSION['account_id'] = $row['account_id'];


        if ($row['admin'] == 1) {  //Checks if user is admin or customer
            // user is admin, so go to admin page
            $_SESSION['isAdmin'] = true;
            // get stall id and stall name which the admin user is from
            $query = "SELECT subquery.stall_id, stalls.stall_name FROM stalls, (SELECT stall_id FROM admin WHERE account_id = " . $row['account_id'] . ") subquery
            WHERE stalls.stall_id = subquery.stall_id;";

            $result = $conn->query($query);

            if ($result->num_rows == 1) {
                // identify the stall id of the admin user
                $row = $result->fetch_assoc();
                $_SESSION['stall_id'] = $row['stall_id'];
                $_SESSION['stall_name'] = $row['stall_name'];
            }
            
            header("Location:../admin/admin.php");
        } else {
            // user is customer
            $_SESSION['isAdmin'] = false;
           
            header("Location:../home/index.php");
        }
    }

    else{
        echo "<script>alert('Wrong username or password!');</script>";
        header("refresh:0;url=login.php");
        
    }


    mysqli_close($conn);
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>

