<!DOCTYPE html>
<html lang = "en">
<head>
<title> Bedok 85 Hawker Centre </title>
<meta charset= "utf-8">
<script type="text/javascript" src ="login.js"></script>
<link rel="stylesheet" href="../common/externalCSS1.css">
<link rel="stylesheet" href="../common/externalCSS.css">
<link rel="stylesheet" href="../common/overlay.css">
<script type="text/javascript" src="../common/overlay.js"></script>
<script type ="text/javascript" src ="about_us.js"></script>
<style>
.register_table{
    border-radius:25px;
    background-color: white;
    padding: 150px;
    /* border: 2px solid #000000; */
    box-shadow: 0 5px 5px -5px #333
}
#wrapper{
    margin: auto;
    padding: 75px;
    margin-top: 3%;
    box-shadow: 0 5px 5px -5px #333;
    width: 700px;
}
label{
    display:inline-block;
    width:100px;
    text-align:right
}
</style>
</head>

<body>
    <?php include '../common/top_header.php' ?>
    <?php include '../common/overlay.php' ?>
    <div id="wrapper">
	<form action="logindb.php" method="post">
    <div class="container">
    <table align="center" class="register_table" border = "0">
        <th colspan="2" style="font-size:30px;">Sign-in</br></th>
        <tr>
            <td align="left" colspan="2"> <label>Username:  </label><input type="text" size= "30" id="username" name="username" required></br></td>
        </tr>

        <tr>
            <td colspan="2" style="height:40px;"><label>Password:  </label><input type="password" size= "30" id="password" name="password" required></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" size="10" name="register" style="font-size:20px;" id="register" value="Sign-in"></td>
        </tr>
        <tr>
            <td style="font-size:20px;"><center><a href="../registration/registration.php"><u>Create Account</u></a><center></td>
        </tr>
	</table>
	</form>
    </div>
    </div>
    <footer>
        <small>
            <i>Copyright &copy; Bedok 85
                <a href="mailto:\\192.168.56.2\f32ee">bedok85@f32ee.com</a>
            </i>
        </small>
    </footer>
</body>
</html>