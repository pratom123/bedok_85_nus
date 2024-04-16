<!DOCTYPE html>
<html lang = "en">
<head>
<title> Bedok 85 Hawker Centre </title>
<meta charset= "utf-8">
<?php
    include '../login/logindb.php';
    include 'insertprofile_detail.php';

    include '../common/connectDB.php';

    $pw=$_GET['password'];


    if(!empty($_SESSION['valid_user']))
    {
    $getusername = $_SESSION['valid_user'];

    $sql = "SELECT * from user
    INNER JOIN credit_card
    WHERE username ='$getusername' 
    AND c_user_id = user_id" ;
    $result = mysqli_query($db, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] != $pw){
            echo "<script>alert('Passwords do not match! Please try again.');</script>";
            header("refresh:0;url=profile_details.php");
        }

    }

    }
mysqli_close($db);
?>
<link rel="stylesheet" href="../common/externalCSS1.css">
<link rel="stylesheet" href="../common/externalCSS.css">
<link rel="stylesheet" href="../common/overlay.css">
<script type="text/javascript" src="../common/overlay.js"></script>
<style>

#wrapper {
    margin: auto;
    margin-top: 3%;
    padding: 50px;
    width: fit-content;
}

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

.invalid_error_msg_phoneno {
    font-weight: bold;
    color: red;
    font-size: 0.9em;
    display: none;
}
.invalid_error_msg_email {
    font-weight: bold;
    color: red;
    font-size: 0.9em;
    display: none;
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
<script type="text/javascript" src ="validator.js"></script>
<script type="text/javascript" src ="validator_email.js"></script>
<script type="text/javascript" src ="validator_phoneno.js"></script>
<script type ="text/javascript" src ="profile_detail.js"></script>

<?php 
include '../common/top_header.php';
include '../common/overlay.php';
?>
    <div id="wrapper">
	<form action="update_profiledetails.php" method="get" id='updateform'>
    <table class="register_table">
        <th colspan="2">Profile Details</th>
        <!-- <tr>
            <td>
                <section id='first_name_section'>
                <label>First name: </label><input type='text' size= '20' id='firstname' name='firstname' value="<?php echo $row['firstname'];?>" readonly>
                </section>
            </td>
        </tr>
        <tr> 
            <td><section id='last_name_section'>
                <label>Last name: </label><input type="text" size= "20" id="lastname" name="lastname" value="<?php echo $row['lastname'];?>" readonly>
                </section>
            </td>
        </tr> -->
        <tr>
            <td align="left" colspan="2"><label>Username: </label><input type="text" size= "20" id="username" name="username" value="<?php echo $row['username'];?>" readonly></br></td>
        </tr>
        <tr>
            <td colspan="2"><label>Password*: </label><input type="password" size= "20" id="password" name="password"></td>
        </tr>
        <tr>
            <td colspan="2">
            <section id='e_mail_section'><label>E-mail: </label><input type="text" size= "20" id="email" onfocus="if(this.value == '<?php echo $row['email'];?>') { this.value = ''; }" onblur="if(this.value == '') { this.value = '<?php echo $row['email'];?>' }" name="email" value="<?php echo $row['email'];?>" >
            <label><div class="invalid_error_msg_email">Invalid Email format!</label></div>
            </section></td>
        </tr>
        <tr>
            <td colspan="2">
            <section id='phone_section'><label>Mobile No.: </label><input type="text" size= "20" id="phoneno" onfocus="if(this.value == '<?php echo $row['contact_no'];?>') { this.value = ''; }" onblur="if(this.value == '') { this.value = '<?php echo $row['contact_no'];?>' }" name="phoneno" value="<?php echo $row['contact_no'];?>" maxlength="8">
            <label><div class="invalid_error_msg_phoneno">Number digits only!</label></div>
            </section> 
            </td>
        </tr>
        <tr>
            <td colspan="2"><label>Address 1: </label><input type="text" size= "20" id="addr1" name="addr1" onfocus="if(this.value == '<?php echo $row['address'];?>') { this.value = ''; }" onblur="if(this.value == '') { this.value = '<?php echo $row['address'];?>' }"value="<?php echo $row['address'];?>" ></td>
        </tr>
        <tr>
        <td colspan="2"> 
        <div class='payment_title'><center>Payment Information</center></div><br>
        <div id='img_wrapper' style="padding-bottom:5px;"><label></label> <img src="../common/img/credit_card_logos.jpg" alt='Acceptable Credit Cards' width="144" height="34"></div>
            <section id='card_num_section' style="padding-bottom:10px;">
                <label>Card number:</label>
                <input type="text" maxlength="19"  id='card_num' name='card_num' onfocus="if(this.value == '<?php echo $row['credit_card_no'];?>') { this.value = ''; }" onblur="if(this.value == '') { this.value = '<?php echo $row['credit_card_no'];?>' }" value="<?php echo $row['credit_card_no'];?>">
                <label><div class="invalid_error_msg">Invalid card number!</label></div>
            </section>
            <section id='card_name_section' style="padding-bottom:10px;">
                <label>Name on card:</label>
                <input type="text" maxlength="50"  id='card_name' name="card_name" onfocus="if(this.value == '<?php echo $row['card_name'];?>') { this.value = ''; }" onblur="if(this.value == '') { this.value = '<?php echo $row['card_name'];?>' }" value="<?php echo $row['card_name'];?>">
                <label><div class="invalid_error_msg">Only Alphabets with spaces in between allowed!</label></div>
            </section>
            <section id='expiry_security_section' style="padding-bottom:10px;">
                <aside id='expiry_section'>
                <label>Expiry date:</label>
                <input type="text" maxlength="5"  size="1" id='expiry_date' name="expiry_date" onfocus="if(this.value == '<?php echo $row['expiry_date'];?>') { this.value = ''; }" onblur="if(this.value == '') { this.value = '<?php echo $row['expiry_date'];?>' }" value="<?php echo $row['expiry_date'];?>">
                <label><div class="invalid_error_msg">Invalid date!</label></div>
            </aside></section>
            <aside id='security_section' style="padding-bottom:10px;">
                <label>Security code:</label>
                <input type="password" maxlength="3"  size="1" id='security_code' name="security_code" onfocus="if(this.value == '<?php echo $row['cv2'];?>') { this.value = ''; }" onblur="if(this.value == '') { this.value = '<?php echo $row['cv2'];?>' }" value="<?php echo $row['cv2'];?>">
                <label><div class="invalid_error_msg">Exactly 3 digits only!</label></div>
            </aside></td>
            </section>
        </tr>
        <tr>
        <td colspan="2" align="center"><input type="submit" name="save" id="save" value="Save"></td>
        </tr>                      
	</table>
	</form>
    <script type="text/javascript" src ="validator2.js"></script>
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