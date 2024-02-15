<?php 
// session_start();
// include 'initialize_all';
// include '../common/check_login.php'; 
include 'function_definition.php'; 
    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
        // user is admin, continue...
    } else {
        // user is not admin, redirect to home page
        header("Location:../home/index.php");
    }

    $proj_dir = 'http://localhost/Bedok_85/';
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Admin page</title>
    <meta charset='utf-8'>
    <link rel='stylesheet' href='../common/externalCSS.css'>
    <script type='text/javascript' src='admin.js'></script>
    <style>
        main {
            /* all: initial; */
            /* width: 1200px; */
            margin: 50px auto;
            padding: 3% 3%;
            background-color: whitesmoke;
        }
        main>section {
            margin: auto;
            padding: 30px;
            border-radius: 30px;
            background-color: white;
            box-shadow: 0 0 5px #333;
            font-family: Arial, Helvetica, sans-serif;
        }
        #stall_title {
            /* Stall name */
            margin-bottom: 30px;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.5em;
        }

        table {
            margin: auto;
            width: 1000px;
            max-width: 1000px;
            max-height: 100px;
            overflow: auto;
            border-collapse: collapse;
        }
        /* Styling orders containers */

        #orders_wrapper {
            border-collapse: collapse;
            /* width: 100%; */
        }


        #orders_wrapper header {
            /* width: 50%; */
            max-width: 100%;
            height: 60px;
            margin: auto;
        }

        #orders_wrapper header div {
            /* display: flex;
            justify-content: space-between;
            float: right; */
            font-size: 1.5em;
            font-weight: bold;
            margin: auto;
        }

        #food_orders_title {
            /* vertical-align: middle; */
            /* margin-left: 50px; */
            margin-right: 40%;
            float: left;
        }

        #refresh_btn {
            float: right;
        }

        #scroller {
            overflow: auto;
            margin: auto;
        }

        #orders_wrapper td, #orders_wrapper th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #orders_wrapper tr:nth-child(odd){background-color: #fafafa;}
        #orders_wrapper tr:nth-child(even){background-color: #f2f2f2;}

        /* #orders_wrapper tr:hover {background-color: #ddd;} */

        #orders_wrapper th {
        padding-top: 12px;
        padding-bottom: 12px;
        /* text-align: left; */
        background-color: #04AA6D;
        color: white;
        }

        tbody {
            font-size: 0.9em;
            text-align: center;
        }

        .food_details_content {
            text-align: start;
        }

        th, td {
            width: 125px;
            min-width: 125px;
        }

        th:first-of-type, td:first-of-type {
            width: 20px;
            min-width: 20px;
        }

        /* Styling stall update */
        #stall_update_wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-top: 50px;
            max-width: 770px;
        }

        #stall_update_wrapper textarea {
            width: 100%;
        }

        #stall_detail_title {
            font-weight: bold;
            font-size: 1.5em;
        }

        hr {
            width: 100%;
            border-top: solid black 2px;
        }

        #stall_update_wrapper section{
            margin: auto;
            margin-top: 30px;
            width: fit-content;
            /* display: ; */
        }

        #stall_update_wrapper form > header{
            margin: auto;
            text-align: center;
        }

        #open_status>* {
            display: inline;
        }

        .stall_detail_label {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Styling buttons */

        #logout_btn {
            /* width: 100%; */
            display: block; 
            /* height: 80px; */
        }

        #logout_btn>div  {
            display: grid;
            place-items: center;
            padding: 10px;
            font-size: 1.1em;
            text-align: center;
            margin: auto auto;
            width: 100%;
            border-right: black solid 1.6px;
            border-bottom: black solid 1.6px;
            border-radius: 20px;
            background-color: red;
            color: whitesmoke;
            box-shadow: 0 0 5px #333;
        }

        #logout_btn>div:hover {
            background-color: #DCDCDC;
        }

        .update_btn {
            background-color: #00C301;
            color: whitesmoke;
            display: block;
            height: 35px;
            padding: 5px;
            margin: auto;
            font-size: 1.2em;
            /* box-shadow: 0 0 5px #333; */
            border-radius: 20px;
        }

        .update_btn:hover {
            background-color: #DCDCDC;
            cursor: pointer;
        }

        #save_btn {
            margin: 30px auto 0px auto;
            background-color: green;
            color: whitesmoke;
            width: 60%;
            height: 50px;
            display: block;
            box-shadow: 0 0 5px #333;
            border-radius: 20px;
            font-size: 1.5em;
        }

        #save_btn:hover {
            background-color: #DCDCDC;
            cursor: pointer;
        }

        #update_btn_wrapper {
            width: 50px;
            height: 50px;
        }

        /*--------Styling page footer-----------*/
        footer {
            position: 'relative';
            bottom: 0px;
        } 


        
    </style>
</head>
<body>
    <?php 
    
        if(isset($_GET['isUpdateSuccess'])) {
            if($_GET['isUpdateSuccess']) 
                $msg = 'Update of selected order successful! An email has been sent to your customer';
                else
                    $msg = 'Failed to update database or email customer!';

            echo "<script type='text/javascript'>alert('" . $msg . "')</script>";

            $_GET['isUpdateSuccess'] = NULL;
        }

        if (isset($_GET['isUpdateStallDetailsSuccess'])) {
            // echo 'test';
            if($_GET['isUpdateStallDetailsSuccess'])
                $msg = 'Update of stall detail is successful!';
                else
                    $msg = 'Failed to update stall detail to database!';

            echo "<script type='text/javascript'>alert('" . $msg . "')</script>";

                    $_GET['isUpdateStallDetailsSuccess'] = NULL;
        }
    
    ?>
    <nav class="top_header">
        <a id="logo" href="<?php echo $dir ?>home/index.php"><img src="../common/img/bedok85_logo.png" alt="Bedok 85" width="94" height="56"></a>
        <h1 id="hawker_centre_title">Bedok 85 Hawker Centre</h1>
        <aside>
            <a href="../common/logout.php" id='logout_btn'>
                <div>Logout</div>
            </a>
        </aside>
    </nav>
    <main>
        <div id='stall_title'><?php echo $_SESSION['stall_name']; ?></div>
        <section id="orders_wrapper">
            <header>
                <div id='food_orders_title'>Food Orders</div>
                <div id='refresh_btn'><a href="admin.php"><img src='<?php echo $proj_dir?>common/img/refresh.png'  width="50" height="50"></a></div>
            </header>
            <div id='scroller'>
                <table>
                    <thead>
                        <?php 
                        $order = retrieveAllOrders();
                        // var_dump($order);
                        $stall_details = retrieveStallDetails();
                        // $order[0]['stall_details'];
                        // var_dump($_SESSION);
                        // var_dump($order);
                        
                        ?>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date/Time</th>
                            <th>Food Details</th>
                            <th>Collection Mode</th>
                            <th>Order Status</th>
                            <th>Update</th>
                            <th>Customer Name</th>
                            <th>Delivery Address</th>
                            <th>Email Address</th>
                            <th>Phone Number</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        for($i=0; $i<count($order); $i++) {

                            echo "
                            <tr>
                            <form action='update_status.php' method='GET' id='update_status_form'>
                                <input type='hidden' name='purpose' value='update_status'>
                                <input type='hidden' name='stall_id' value='" . $stall_details['stall_id'] . "'>
                                <input type='hidden' name='order_id' value='". $order[$i]['order_id'] . "'>
                                <td>". $order[$i]['order_id'] . "</td>
                                <td>". $order[$i]['order_datetime'] . "</td>
                                <td class='food_details_content'>". $order[$i]['food_details'] . "</td>
                                <td>". $order[$i]['collection_mode'] . "</td>
                                <td>
                                    <select class='order_status' name='order_status'>
                                        <option ";                                      
                                        if($order[$i]['order_status']=='Cooking') echo 'selected'; echo ">Cooking</option>
                                        <option ";
                                        if($order[$i]['order_status']=='Ready') echo 'selected';
                                        echo ">Ready</option>
                                        <option ";
                                        if($order[$i]['order_status']=='Collected') echo 'selected';
                                        echo ">Collected</option>
                                        <option ";
                                        if($order[$i]['order_status']=='Delivering') echo 'selected';
                                        echo ">Delivering</option>
                                        <option ";
                                        if($order[$i]['order_status']=='Delivered') echo 'selected';
                                        echo ">Delivered</option>
                                        <option ";
                                        if($order[$i]['order_status']=='Cancelled') echo 'selected';
                                        echo ">Cancelled</option>
                                    </select>
                                </td>
                                <td>
                                    <input type='submit' value='Update' class='update_btn'>
                                </td>
                                <td>" . $order[$i]['firstname'] . ' ' . $order[$i]['lastname'] . "</td>
                                <td>"; echo !empty($order[$i]['address'])? $order[$i]['address']: '—'; echo "</td>
                                <td>" . $order[$i]['e_mail'] ."</td>
                                <td>" . $order[$i]['mobile_no'] ."</td>
                                <td>
                                    <textarea class='remark' rows='3' cols='10' placeholder='Max characters: 1000' maxlength='1000' value='' name='remark'></textarea>
                                </td>
                            </form>
                        </tr>  
                            ";

                        }
                        
                        ?>
                        <!-- <tr>
                            <form action='update_status.php' method='GET' id='update_status_form'>
                                <input type='hidden' name='order_id' value='34'>
                                <td>1</td>
                                <td>15/9/2021</td>
                                <td class="food_details_content">X2 Bak Chor mee</td>
                                <td>Delivery</td>
                                <td>
                                    <select class='order_status' name='order_status'>
                                        <option>Cooking</option>
                                        <option>Ready</option>
                                        <option>Collected</option>
                                        <option>Delivering</option>
                                        <option>Delivered</option>
                                        <option>Cancelled</option>
                                    </select>
                                </td>
                                <td>
                                    <input type='submit' value='Update' class='update_btn'>
                                </td>
                                <td>Jannai</td>
                                <td>Nanyang Avenue</td>
                                <td>jheng016@e.ntu.edu.sg</td>
                                <td>81234567</td>
                                <td>
                                    <textarea class='remark' rows='3' cols='10' placeholder='Max characters: 1000' maxlength='1000' value='' name='remark'></textarea>
                                </td>
                            </form>
                        </tr> -->
                        <script type='text/javascript' src='adminR.js'></script>
                    </tbody>
                </table>
            </div>
        </section>
        <section id="stall_update_wrapper">
            <?php 
            // var_dump($stall_details);
             ?>
            <form action='update_status.php' method='GET' id='update_stall_details'>
                <input type='hidden' name='purpose' value='update_stall_details'>
                <input type='hidden' name='stall_id' value='<?php echo $stall_details['stall_id'];  ?>'>
                <header id='stall_detail_title'>Stall Details</header>
                <hr/>
                <section id='open_status'>
                    <div class='stall_detail_label'>Open Status:&nbsp;</div>
                    <select name='open_status'>
                        
                        <option <?php if(isset($stall_details['open_status']) && $stall_details['open_status'] == 1) echo 'selected';?>>Open</option>
                        <option <?php if(isset($stall_details['open_status']) && $stall_details['open_status'] == 0) echo 'selected';?>>Closed</option>
                    </select>
                </section>
                <section id='opening_hour'>
                    <div class='stall_detail_label'>Opening Hours:&nbsp;</div>
                    <textarea  rows='4' cols='30' placeholder='Max characters: 50' maxlength="50" name='opening_hour'><?php echo (isset($stall_details['opening_hour']))? $stall_details['opening_hour']:''; ?></textarea>
                </section>
                <section id='description'>
                    <div class='stall_detail_label'>Description:&nbsp;</div>
                    <textarea id='description' rows='10' cols='100' placeholder='Max characters: 1000' maxlength="1000" name='description'><?php echo (isset($stall_details['description']))? $stall_details['description']:''; ?></textarea>
                </section>
                <section id='announcement'>
                    <div class='stall_detail_label'>Announcement:&nbsp;</div>
                    <textarea id='announcement'  rows='10' cols='100' placeholder='Max characters: 1000' maxlength="1000" name='announcement'><?php echo (isset($stall_details['announcement']))? $stall_details['announcement']:''; ?></textarea>
                </section>
                <input id='save_btn' type="submit" value="Save">
            </form>
        </section>
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