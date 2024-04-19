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
    width:500px;
    background-clip: content-box; 
    background-color: white;
    border: 2px solid #000000;
    border-radius:20px;
    background-clip:padding-box;
    border-spacing:0;
    box-shadow: 0 5px 5px -5px #333

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
    width:120px;
    text-align:right
}
input[type='number']{
    width: 209px;
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

::placeholder{
    color:Black;
}
</style>
</head>

<body>
<?php
    include '../login/logindb.php';
    include 'insertprofile_detail.php';
    include '../common/top_header.php';
    include '../common/overlay.php';
?>
<script type ="text/javascript" src ="profile_detail.js"></script>
    <div id="wrapper">
	<form action="edit_profiledetails.php" method="get">
    <table class="register_table">
        <th colspan="2">Profile Details</th>
        <tr>
            <td align="left" colspan="2"><label>Username: </label><input type="text" size= "20" id="username" name="username" placeholder="<?php echo $user->getUsername();?>" readonly></br></td>
        </tr>
        <tr>
            <td colspan="2">
            <section id='e_mail_section'><label>E-mail: </label><input type="text" size= "20" id="email" name="email" placeholder="<?php echo $user->getEmail();?>" readonly>
            </section></td>
        </tr>
        <tr>
            <td colspan="2">
            <section id='phone_section'><label>Mobile No.: </label><input type="text" size= "20" id='phoneno' name='phoneno' maxlength='8' placeholder="<?php echo $user->getContactNo();?>"readonly>
            </section> 
            </td>
        </tr>
        <tr>
            <td colspan="2"><label>Address: </label><input type="text" size= "20" id="addr1" name="addr1" placeholder="<?php echo $user->getAddress();?>" readonly></td>
        </tr>
        <tr>
        <td colspan="2"> 
        <div class='payment_title'><center>Payment Information</center></div><br>
        <div id='img_wrapper' style="padding-bottom:5px;"><label></label> <img src="../common/img/credit_card_logos.jpg" alt='Acceptable Credit Cards' width="144" height="34"></div>
            <section id='card_num_section' style="padding-bottom:10px;">
                <label>Card number:</label>
                <input type="text" maxlength="19"  id='card_num' name='card_num' placeholder="<?php echo $cc->getCreditCardNo()?>" readonly>
            </section>
            <section id='card_name_section' style="padding-bottom:10px;">
                <label>Name on card:</label>
                <input type="text" maxlength="50"  id='card_name' name="card_name" placeholder="<?php echo $cc->getCardName()?>" readonly>
            </section>
            <section id='expiry_security_section' style="padding-bottom:10px;">
                <aside id='expiry_section'>
                <label>Expiry date:</label>
                <input type="text" maxlength="5"  size="1" id='expiry_date' name="expiry_date" placeholder="<?php echo $cc->getExpiryDate()?>" readonly>
            </aside></section>
            <aside id='security_section' style="padding-bottom:10px;">
                <label>Security code:</label>
                <input type="password" maxlength="3"  size="1" id='security_code' name="security_code" placeholder="<?php echo $cc->getCv2()?>" readonly>
            </aside></td>
            </section>
        </tr>
        <tr>
        <tr>
            <td colspan="2"><label>Password*: </label><input type="password" size= "20" id="password" name="password" required></td>
        </tr>
        </tr>
        <tr>
        <td colspan="2" align="center"><input type="submit" name="edit" id="edit" value="Edit Information"></td>
        </tr>                      
	</table>
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