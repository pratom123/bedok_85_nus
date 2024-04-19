<?php 
session_start();
//include '../common/initialize_all';
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Bedok 85</title>
    <meta charset='utf-8'>
    <link rel='stylesheet' href='../common/externalCSS.css'>
    <link rel='stylesheet' href='../common/overlay.css'>
    <script type='text/javascript' src='../common/overlay.js'></script>
    <script type='text/javascript' src='event_listener.js'></script>
    <style>
        .path_directory {
            text-align: center;
            margin-top: 3%;
            margin-bottom: 5px;
            font-size: 1.5em;
        }

        main {
            width: 710px;
            min-width: 710px;
            margin: auto;
        }

        footer {
            position: 
            <?php echo (empty($_SESSION['cart']))? 'fixed; width: 100%;': 'relative;';?>;
            bottom: 0px;
        }   

        #order_items_wrapper {
            background-color: white;
            /* width: ; */
            width: 670px;
            min-width: 670px;
        }

        section img {
            border-radius: 20%;
        }

        #cart_title {
            text-align: center;
        }
        .item {
            border: solid #DADADA 2px;
            border-radius: 10px;
            box-shadow: 0 0 5px #333;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            padding: 20px 0px;
            background-color: whitesmoke;
            margin-bottom: 5%;
        }

        aside {
            margin: 0 10px;
        }

        .item_qty_wrapper {
            margin-top: 10px;
            text-align: center;
            /* font-weight: bold; */
            font-size: 2em;
        }

        .item_stall_name {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .item_dish_name {
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        .item_dish_pref {
            width: 240px;
            height: 150px;
            border: solid #DADADB 2px;
            border-radius: 10px;
            box-sizing: border-box;
            padding: 10px;
        }

        .item_price_action_wrapper {
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 200px;
        }

        .item_price_wrapper {
            margin-left: 60;
        }

        .dollar_sign {
            font-size: 1.5em;
        }

        input[type='text'] {
            font-size: 1.5em;
        }

        .item_action {
            /* padding: 5px;
            color: whitesmoke; */
            /* margin-left: 60%; */
            /* float: right;
            float: bottom; */
        }

        input[type='submit'] {
            color: #DADADB;
            font-size: 1.5em;
            width: 100px;
            border-radius: 20px;
            border:none;
            padding: 10px;
            box-shadow: 0 5px 5px -5px #333;
        }

        input[type='submit']:hover {
            cursor: pointer;
            background-color: #DCDCDC;
            color: whitesmoke;
        }

        .update_btn {
            background-color: green;
            display: block;
            margin-bottom: 20%;
        }
        .delete_btn {
            background-color: red;
            display: block;
            /* margin: 80% 0%; */
        }

        #order_wrapper footer {
            background-color: #EDF5E1;
            border-radius: 10px 10px 10px 10px;
            height: 100px;
            display: 
            <?php
            //show/hide wrapper depending whether cart is empty
            echo (!empty($_SESSION['cart']))? 'block': 'none';
            ?>
            ;

            box-shadow: 0 0 5px #333;
        }

        #order_price_label_wrapper {
            /* font-size: 1.5em; */
            display: flex;
            justify-content: space-between;
            margin: 0 10px;
            align-items: center;
        }

        #order_price_label {
            font-weight: bold;
            font-size: 1.5em;
        }

        #checkout_btn {
            background-color: green;
            color: whitesmoke;
            width: 100%;
            display: block;
            box-shadow: 0 0 5px #333;
            margin-top: 30px;
        }
        #checkout_btn:hover {
            background-color: #DCDCDC;
        }

        #empty_cart {
            text-align: center;
            font-size: 1.5em;
        }

        #home_btn {
            background-color: #3d9970;
            color: whitesmoke;
            width: 100%;
            display: block;
            box-shadow: 0 0 5px #333;
            margin-top: 20px;
        }

        #home_btn:hover {
            background-color: #DCDCDC;
        }
        
    </style>
</head>
<body>
<?php 
        // var_dump($_SESSION);
    // var_dump($_SESSION['cart']);
    
    if (!empty($_SESSION['cart'])) {
        $num_items = count($_SESSION['cart']);
        $cart = $_SESSION['cart'];
        // echo "<div>" . $num_items . " </div>";

        // calculate total cart price
        $total_price = 0;
        foreach($cart as $item_index => $items) {
            // echo $item_index;
            $total_price += floatval($cart[$item_index]['item_price']);
        }
        $total_price = number_format($total_price, 2);  //add 2 decimal places
        //echo $total_price;
    }
?>
    <!-- overlay is the sidepanel for navigation links -->
    <?php include '../common/overlay.php' ?>
    <?php include '../common/top_header.php' ?>
    
    <div class='path_directory'>
        <!-- path directory -->
    <a href='../home/index.php'>Home</a>&nbsp;&rarr;&nbsp;<a href=''>Cart</a>
    </div>
    <main>
        <div id='order_wrapper'>
            <header>
                <h2 id='cart_title'>Basket</h2>
            </header>
            <main id='order_items_wrapper'>
                <!-- dish preferences are here -->

                <?php 

                if (empty($_SESSION['cart'])) {
                    echo "
                    <div id='empty_cart'>Basket is empty</div>
                    <form action='../home/index.php'>
                    <input id='home_btn' type='submit' name='' value='Go Home'>
                    </form> 
                    ";
                }

                $img_dir = 'http://54.162.72.241/bedok_85_nus/common/img/'; //item dish img parent folder

                if (!empty($num_items)) {
                    for($i=0;$i<$num_items;$i++) {
                        // echo $cart[$i]['item_dish_img_name'];
                        
                        echo "
                        <section class='item'>
                            <aside class='item_img'>
                                <img src='" . $img_dir . $cart[$i]['item_dish_img_name'] . "' width='100px' height='100px'>
                                <div class='item_qty_wrapper'>
                                    <span class='item_qty'>" . $cart[$i]['item_qty'] . "</span>
                                    <span>x</span>
                                </div>
                            </aside>
                            <aside class='item_detail'>
                                <div class='item_stall_name'>" . $cart[$i]['item_stall_name'] . "</div>
                                <div class='item_dish_name'>" . $cart[$i]['item_dish_name'] . "</div>
                                <div class='item_dish_pref'>" ?>
                                <?php 
                                // item preferences has nested arrays, so it needs to be formatted properly first
                                $item_pref_temp = $cart[$i]['item_pref'];
                                $item_pref_temp = array_values($item_pref_temp);
                                foreach ($item_pref_temp as $item_pref) {
                                    if (!empty($item_pref)) {
                                        if (gettype($item_pref) == 'array') {
                                            // add_on preference detected, because it is a nested array
                                            foreach($item_pref as $add_on) {
                                                if (!empty($add_on))
                                                    echo '- ' . $add_on . '<br>';
                                            }
                                        } else
                                            echo '- ' . $item_pref . '<br>';
                                    }
                                }
                                ?>
                                <!-- resume echo below -->
                                <?php echo "   
                                </div>
                            </aside>
                            <aside class='item_price_action_wrapper'>
                                <div item_price_wrapper>
                                    <span class='dollar_sign'>$</span>
                                    <input type='text' value='" . $cart[$i]['item_price'] . "' onfocus='blur()' size='1'>
                                </div>
                                <div class='item_action'>
                                    <form action='" ?>
                                    <?php 
                                    // In order to update current item, echo the link of the food dish page
                                    $proj_dir = 'http://54.162.72.241/bedok_85_nus/'; //parent folder of the stalls' food dish
                                    switch($cart[$i]['item_dish_name']) {
                                        // mapping dish name to dish page link
                                        case 'Bak Chor Mee (Small)' : echo $dir . 'xjrcm/bcm_small/bcm_small.php';
                                            break;
                                        case 'Bak Chor Mee (Large)' : echo $dir . 'xjrcm/bcm_large/bcm_large.php';
                                            break;
                                        case 'BBQ Wings' : echo $dir . 'sbbq/bbq_wings/bbq_wings.php';
                                            break;
                                        case 'Satay' : echo $dir . 'sbbq/satay/satay.php';
                                            break;
                                    }
                                    ?>
                                    <?php echo "
                                    ' method='GET'>
                                    <input type='hidden' name='purpose' value='update_item'>
                                    <input type='hidden' name='cart_item_index_to_be_updated' value='" . $i . "'>
                                    <input class='update_btn' type='submit' name='item_action' value='Update'>
                                    </form>
                                    <form action='../common/process_cart.php' method='GET'>
                                    <input type='hidden' name='purpose' value='delete_item'>
                                    <input type='hidden' name='cart_item_index_to_be_deleted' value='" . $i . "'>
                                    <input class='delete_btn' type='submit' name='item_action' value='Delete'>
                                    </form>
                                </div>
                            </aside>
                        </section> "
                        ; } //end of for loop
                }
                ?>
            </main>
            <footer>
                <div id='order_price_label_wrapper'>
                    <span id='order_price_label'>Total:</span>
                    <span><span class='dollar_sign'>$</span>&nbsp;<input type='text' id='order_price_display' onfocus='blur()' value='<?php echo $total_price ?>' size='1'></span>
                </div>
                <form action='../payment/payment.php'>
                    <input id='checkout_btn' type='submit' name='' value='Checkout'>
                </form>
            </footer>
            <script type='text/javascript' src='event_listenerR.js'></script>
        </div>
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