<?php 
//session_start();
//include '../common/initialize_all';
?>
<?php include '../common/check_login.php'; 
    if(empty($_SESSION['cart'])) {header('Location: ../cart/cart.php'); }
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Bedok 85</title>
    <meta charset='utf-8'>
    <link rel='stylesheet' href='../common/externalCSS.css'>
    <link rel='stylesheet' href='../common/overlay.css'>
    <script type='text/javascript' src='../common/overlay.js'></script>
    <script type='text/javascript' src='payment.js'></script>
    <style>
        .path_directory {
            text-align: center;
            margin-top: 3%;
            margin-bottom: 5px;
            font-size: 1.5em;
        }

        main {
            /* all:initial; */
            /* background-color: grey; */
            width: 1200px;
            padding: 1% 3%;
            margin: auto;
        }

        main header {
            text-align: center;
        }

        #content_wrapper {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            align-items: center;
            gap: 5%;
            /* background-color: rgb(230, 230, 230); */
            background-color: rgb(240, 240, 240);
            box-shadow: 0 0 5px #333;
            border-radius: 5%;
            padding: 5%;
        }

        div>aside {    /* child selector only */
            width: 500px;
            /* height: 500px; */
            /* background-color: rgb(240, 240, 240); */
            /* border-radius: 3%; */
            padding: 10px;
            /* border: solid rgb(242, 216, 172) 2px; */
            display: flex;
            justify-content: space-between;
        }

        aside {
            font-size: 1.1em;
        }

        #payment_background {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 3%;
            border-right: #DADADA solid 2px;
        }

        input[type='text'] {
            font-size: 1.1em;
            display: block;
        }
        input[type='email'] {
            font-size: 1.1em;
            display: block;
        }

        /* -------Styling of Account Information table starts here----- */

        .payment_title {
            text-decoration: underline;
        }

        #account_info {
            border-bottom: solid #DADADA 2px;
            border-radius: 1%;
            padding: 10px 0px auto;
            /* display: none; */
            /* background-color: rgb(247, 247, 247); */
        }
        #account_info caption {
            /* border-bottom: solid black 2px; */
            margin: auto;
            /* background-color: whitesmoke; */
            font-weight: bold;
            font-size: 1.5em;
            margin-bottom: 5%;
        }

        #account_info tr {
            height: 70px;
        }

        th {
            text-align: right;
            vertical-align: text-top;
            /* border: solid black 2px; */
        }
        td {
            /* border: solid black 2px; */
            padding: 10px;
            vertical-align: text-top;
            /* box-sizing: border-box; */
        }

        #address_section td{
            padding-top: 0;
        }

        #collection_section td {
            padding-top: 3%;
        }

        #address_section th, #collection_section th {
            padding-top: 0.5%;
            vertical-align: top;
        }

        #collection_section th {
            padding-top: 2%;
        }

        #address_section td, #collection_section td {
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: start;
            /* padding: 0; */
        }

        #collection_section  td div {
            margin-bottom: 5%;
        }

        #address_section td {
            /* border:solid black 1px; */
            justify-content: flex-start;
        }

        #address_section input {
            display: inline;
        }

        .address_left {
            float:left;
        }

        .address_left input[type='radio'] {
            vertical-align: middle;
        }

        .address_right {
            float: right;
            /* margin-bottom: 1.5em; */
            /* width: ; */
        }

        .address_num_section {
            height: 60px;
        }

        .invalid_error_msg {
            font-weight: bold;
            color: red;
            font-size: 0.9em;
            display: none;
        }


        /* ----------Styling credit card--------- */

        #credit_card_background {
            background-color: lightyellow;
            margin-top: 10%;
            font-size: 0.95em;
            padding: 5%;
            border-radius: 10%;
            width: 250px;
            background-color: rgb(247, 247, 247);
            box-shadow: 0 0 5px #333;
        }

        #img_wrapper {
            margin: 5% 0 auto auto;
        }

        #credit_card_background > header {
            font-weight: bold;
            font-size: 1.2em;
        }

        #credit_card_background>main {
            width: auto;
            background-color: transparent;
            border-radius: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
        }

        #credit_card_background #expiry_security_section{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;
            font-size: 0.7em;
            gap:10px;
        }

        #expiry_security_section aside {
            width: 100px;
            /* vertical-align: top; */
            /* align-items:flex-start; */
        }

        #credit_card_background section {
            margin-bottom: 5px;
        }

        #card_name_section {
            margin-bottom: 20px;
        }

        #credit_card_background section label {
            margin-bottom: 5%;
            font-weight: bold;
        }

        #credit_card_background section aside label {
            display: block;
        }

        #credit_card_background input[type='text'] {
            font-size: 0.95em;
            display: block;
        }
        #credit_card_background input[type='password'] {
            font-size: 0.95em;
        }

        /*-------- Styling Order Summary------ */

        #order_summary_background main {
            all:initial;
        }

        #order_summary_background {
            width: auto;
            display: block;
            margin: auto;
            /* background-color: whitesmoke; */
        }

        #order_summary_background table{
            width: 500px;
            border-collapse: collapse;
            box-shadow: 0 0 5px #333;
            font-size: 1.2em;
            /* background-color: grey; */
        }

        #order_summary_background caption {
            font-weight: bold;
            font-size: 1.1em;
            text-align: start;
            margin-bottom: 1%;
        }

        caption hr {
            margin: 2px 0;
            border-top: black solid 2px;
        }

        .order_num_label {
            font-weight: bold;
            font-size: 1.2em;
            text-align: start;
            padding-left: 0;
        }

        #order_summary_background th {
            text-align: center;
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #04AA6D;
            font-weight: bold;
            font-size: 1.1em;
            color: white;
        }
        #order_summary_background tr:nth-child(even){
            background-color: rgb(235, 235, 235);
        }

        #order_summary_background table td:first-child, th:first-child {
        border-left: none;
        }

        #order_summary_background table td{
            border-left: #DADADA 1px solid;
        }

        #order_summary_background tr:hover {
            background-color: #ddd;
        }

        #order_summary_background tfoot {
            background-color: rgb(240, 230, 209);
        }

        #order_summary_background #price_label {
            text-align: right;
        }

        #order_summary_background .qty, .price {
            text-align: center;
        }
        /* Styling buttons */
        #btn_wrapper {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            gap: 5%;
            margin-top: 10%;
            
            font-weight: bold;
        }

        #cancel_btn {

            width: 100%;
            display: block; 
            height: 80px;
        }

        #cancel_btn>div  {
                display: grid;
                place-items: center;
                font-size: 1.5em;
                text-align: center;
                margin: auto auto;
                width: 100%;
                height: 100%;
                border-right: black solid 1.6px;
                border-bottom: black solid 1.6px;
                border-radius: 20px;
                background-color: red;
                color: whitesmoke;
                box-shadow: 0 0 5px #333;
        }

        #cancel_btn>div:hover {
            background-color: #DCDCDC;
        }

        #order_btn {
            background-color: green;
            color: whitesmoke;
            width: 100%;
            height: 80px;
            display: block;
            box-shadow: 0 0 5px #333;
            border-radius: 20px;
            font-size: 1.5em;
        }

        #order_btn:hover {
            background-color: #DCDCDC;
            cursor: pointer;
        }

        /*--------Styling page footer-----------*/
        footer {
            position: 'relative';
            
            bottom: 0px;
        } 


        
    </style>
</head>
<body>
    <?php include '../payment/function_definition.php';
    $data = retrieveDataFromDb();
    // var_dump($data);
    ?>
    <!-- overlay is the sidepanel for navigation links -->
    <?php include '../common/overlay.php' ?>
    <?php include '../common/top_header.php' ?>
    
    <div class='path_directory'>
        <!-- path directory -->
    <a href='../home/index.php'>Home</a>&nbsp;&rarr;&nbsp;<a href='../cart/cart.php'>Cart</a>&nbsp;&rarr;&nbsp;<a href=''>Payment</a>
    </div>
    <main>
        <header><h2>Checkout</h2></header>
            <form action='process_payment.php' method="GET" id='to_payment'>
                <div id='content_wrapper'>
                    <aside id='payment_background'>
                            <div id="account_info">
                                <table>
                                    <caption class="payment_title">Collection Mode</caption>
                                    <!-- <tr>
                                        <th>First Name:</th>
                                        <td><input type='text' required placeholder='John' size='5' id='firstname'><span class="invalid_error_msg">Invalid name!</span></td>
                                    </tr>
                                    <tr>
                                        <th>Last Name:</th>
                                        <td><input type='text' required placeholder='Sim' size='5' id=''><span class="invalid_error_msg">Invalid name!</span></td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td><input type='email' required placeholder="john@hotmail.com"><span class="invalid_error_msg">Invalid name!</span></td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td><input type='text' required placeholder='81234567'><span class="invalid_error_msg">Invalid name!</span></td>
                                    </tr> -->
                                    <tr id='collection_section'>
                                        <th>Collection:</th>
                                        <td>
                                            <div>
                                                <label for='self_pickup'>
                                                <input type='radio' name='collection' class='collection_radio' id='self_pickup' value='Self-pickup' checked>
                                                <span class='radio_label'>Self-pickup</span>
                                                </label>
                                            </div>
                                            <div>
                                                <label for='delivery'>
                                                <input type='radio' name='collection' class='collection_radio' value='Delivery' id='delivery'>
                                                <span class='radio_label'>Delivery</span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id='address_section'>
                                        <th>Address:</th>
                                        <td>
                                            <div class="address_num_section">
                                                <div class="address_left"><input type='radio' name='address' class="address_radio" disabled></div>
                                                <span class="address_right">
                                                    <div><input type='text' placeholder="Address 1" disabled class='address_text' maxlength="100" value='<?php echo (isset($data['Address1']) && !empty($data['Address1']))? $data['Address1']:''; ?>'></div>
                                                    <div class="invalid_error_msg" id='address_1_error_msg'>Invalid address!</div>
                                                </span>
                                            </div>
                                            <div class="address_num_section">
                                                <div class="address_left"><input type='radio' name='address' class="address_radio" disabled></div>
                                                <span class="address_right">
                                                    <div><input type='text' placeholder="Address 2" disabled class='address_text' maxlength="100" value='<?php echo (isset($data['Address2']) && !empty($data['Address2']))? $data['Address2']:''; ?>'></div>
                                                    <div class="invalid_error_msg">Invalid address!</div>
                                                </span>
                                            </div>
                                            <div class="address_num_section">
                                                <div class="address_left"><input type='radio' name='address' class="address_radio" disabled></div>
                                                <span class="address_right">
                                                    <div><input type='text' placeholder="Address 3" disabled class='address_text' maxlength="100" value='<?php echo (isset($data['Address3']) && !empty($data['Address3']))? $data['Address3']:''; ?>'></div>
                                                    <div class="invalid_error_msg">Invalid address!</div>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div id='credit_card_background'>
                                <header>
                                    <div class='payment_title'>Payment Information</div>
                                    <div id='img_wrapper'><img src="../common/img/credit_card_logos.jpg" alt='Acceptable Credit Cards' width="144" height="34"></div>
                                </header>
                                <main>
                                    <section id='card_num_section'>
                                        <label>Card number</label>
                                        <input type="text" maxlength="19" placeholder="1234 5678 9012 3456" id='card_num' required value='<?php echo (isset($data['credit_card']) && !empty($data['credit_card']))? $data['credit_card']:''; ?>'>
                                        <div class="invalid_error_msg">Invalid card number!</div>
                                    </section>
                                    <section id='card_name_section'>
                                        <label>Name on card</label>
                                        <input type="text" maxlength="50" placeholder="John Sim" id='card_name' required value='<?php echo (isset($data['card_name']) && !empty($data['card_name']))? $data['card_name']:''; ?>'>
                                        <div class="invalid_error_msg">Only Alphabets with spaces in between allowed!</div>
                                    </section>
                                    <section id='expiry_security_section'>
                                        <aside id='expiry_section'>
                                            <label>Expiry date</label>
                                            <input type="text" maxlength="5" placeholder="01/19" size="1" id='expiry_date' required value='<?php echo (isset($data['expirydate']) && !empty($data['expirydate']))? $data['expirydate']:''; ?>'>
                                            <div class="invalid_error_msg">Invalid date!</div>
                                        </aside>
                                        <aside id='security_section'>
                                            <label>Security code</label>
                                            <input type="password" maxlength="3" placeholder="123" size="1" id='security_code' required value='<?php echo (isset($data['cv2']) && !empty($data['cv2']))? $data['cv2']:''; ?>'>
                                            <div class="invalid_error_msg">Exactly 3 digits only!</div>
                                        </aside>
                                    </section>
                                </main>
                            </div>
                    </aside>
                    <aside id='order_summary_background'>
                        <main>
                            <table>
                                <thead>
                                    <caption>Order Summary<hr></caption>
                                    <caption>Order No.: <?php echo (isset($data['order_id']) && !empty($data['order_id']))? $data['order_id']:''; ?></caption>
                                    <!-- <tr>
                                        <td colspan="3" class='order_num_label'>
                                            Order No.: 0123456
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <th>Quantity</th>
                                        <th>Order Item</th>
                                        <th>Price ($)</th>
                                    </tr>
                                </thead>
                                <?php displayCartItems(); ?>
                            </table>
                        </main>
                        <div id='btn_wrapper'>
                        <a href='../cart/cart.php' id='cancel_btn'>
                            <div>Cancel</div>
                        </a>
                        <input type='submit' id='order_btn' value='Place Order'>
                        </div>
                    </aside>
                </div>
            </form>
            <script type='text/javascript' src='paymentR.js'></script>
    </main>
    <footer>
        <small>
            <i>Copyright &copy; Bedok 85
                <a href='mailto:\\192.168.56.2\f32ee'>bedok85@f32ee.com</a>
            </i>
        </small>
    </footer>
</body>
</html>