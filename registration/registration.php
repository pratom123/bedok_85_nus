<!DOCTYPE html>
<html lang = "en">
<head>
<title> Bedok 85 Hawker Centre </title>
<meta charset= "utf-8">
<link rel="stylesheet" href="../common/externalCSS1.css">
<link rel="stylesheet" href="../common/externalCSS.css">
<link rel="stylesheet" href="../common/overlay.css">
<script type="text/javascript" src="../common/overlay.js"></script>
<style>
.register_table{
    height:720px;
    margin:auto;
    background-clip: content-box; 
    background-color: white;
    border: 2px solid #000000;
    border-radius:20px;
    background-clip:padding-box;
    border-spacing:0;
    box-shadow: 0 5px 5px -5px #333;
}

table.register_table td,
table.register_table tr,
table.register_table th{
    border-bottom: 2px solid black;
    padding:10px 0px 10px 0px;
}
table.register_table tr:last-child>td{
    border-bottom:none;
}   

label{
    display:inline-block;
    width:180px;
    text-align:right
}
.mySidenav{
    align:right;
}

#wrapper{
margin: auto;
padding:50px;
margin-top: 3%;
box-shadow: 0 5px 5px -5px #333;
width: fit-content;
}

.wrapper{
    position:flex;
    flex-direction:row;
}

.invalid_error_msg {
    font-weight: bold;
    color: red;
    font-size: 0.9em;
    display: none;
}
</style>
</head>
<body>
<?php
    include '../login/logindb.php';
    include '../common/top_header.php';
    include '../common/overlay.php';
?>
<script type ="text/javascript" src ="registration.js"></script>
    <div class="wrapper" id="wrapper">
	<form action="creation_account.php" method="GET" id="registerform">
    <table class="register_table">
        <th colspan="2">Registration</th>
        <tr>
            <td>
                <section id='first_name_section'>
                <label>First name*: </label><input type='text' size= '20' id='firstname' name='firstname' equired>
                <label><div class="invalid_error_msg">Only Alphabets with spaces in between allowed!</label></div>
                </section>
            </td>
        </tr>
        <tr> 
            <td><section id='last_name_section'>
                <label>Last name*: </label><input type="text" size= "20" id="lastname" name="lastname"required>
                <label><div class="invalid_error_msg">Only Alphabets with spaces in between allowed!</label></div>
                </section>
            </td>
        </tr>
        <tr>
            <td align="left" colspan="2"><label>Username*: </label><input type="text" size= "20" id="username" name="username" required></br></td>
        </tr>
        <tr>
            <td colspan="2"><label>Password*: </label><input type="password" size= "20" id="password" name="password" required></td>
        </tr>
        <tr>
            <td colspan="2"><label>Re-enter Password*: </label><input type="password" size= "20" id="pwCheck" name="pwCheck" required></td>
        </tr>
        <tr>
            <td colspan="2">
            <section id='e_mail_section'><label>E-mail*: </label><input type="text" size= "20" id="email" name="email" required>
            <label><div class="invalid_error_msg">Wrong Email format!</label></div>
            </section></td>
        </tr>
        <tr>
            <td colspan="2">
            <section id='phone_section'><label>Mobile No.*: </label><input type="text" size= "20" id="phoneno" name="phoneno" maxlength="8" required>
            <label><div class="invalid_error_msg">digits only!</label></div>
            </section> 
            </td>
        </tr>
        <tr>
            <td colspan="2"><label>Address 1: </label><input type="text" size= "20" id="addr1" name="addr1"></td>
        </tr>
        <tr>
            <td colspan="2"><label>Address 2: </label><input type="text" size= "20" id="addr2" name="addr2"></td>
        </tr>
        <tr>
            <td colspan="2"><label>Address 3: </label><input type="text" size= "20" id="addr3" name="addr3"></td>
        </tr>
        <tr>
        <td colspan="2"> 
        <div class='payment_title'><center>Payment Information</center></div><br>
        <div id='img_wrapper' style="padding-bottom:5px;"><label></label> <img src="../common/img/credit_card_logos.jpg" alt='Acceptable Credit Cards' width="144" height="34"></div>
            <section id='card_num_section' style="padding-bottom:10px;">
                <label>Card number:</label>
                <input type="text" maxlength="19" placeholder="1234 5678 9012 3456" id='card_num' name='card_num' required>
                <label><div class="invalid_error_msg">Invalid card number!</label></div>
            </section>
            <section id='card_name_section' style="padding-bottom:10px;">
                <label>Name on card:</label>
                <input type="text" maxlength="50" placeholder="John Sim" id='card_name' name="card_name" required>
                <label><div class="invalid_error_msg">Only Alphabets with spaces in between allowed!</label></div>
            </section>
            <section id='expiry_security_section' style="padding-bottom:10px;">
                <aside id='expiry_section'>
                <label>Expiry date:</label>
                <input type="text" maxlength="5" placeholder="01/19" size="1" id='expiry_date' name="expiry_date" required>
                <label><div class="invalid_error_msg">Invalid date!</label></div>
            </aside></section>
            <aside id='security_section' style="padding-bottom:10px;">
                <label>Security code:</label>
                <input type="password" maxlength="3" placeholder="123" size="1" id='security_code' name="security_code" required>
                <label><div class="invalid_error_msg">Exactly 3 digits only!</label></div>
            </aside></td>
            </section>
        </tr>
        <tr>
        <td colspan="2" align="center"><input type="submit" name="register" id="register" value="Register"></td>
        </tr>                      
	</table>
    <script type="text/javascript" src ="validator.js"></script>
    <script type="text/javascript" src ="validator2.js"></script>
	</form>
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