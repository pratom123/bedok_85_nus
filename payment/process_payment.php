

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Page Title Goes Here</title>
    <meta charset="utf-8">
    <?php 
include '../common/initialize_all.php';
include 'function_definition.php';
ini_set('display_errors', 1);
session_start();
$proj_dir = 'http://54.162.72.241/bedok_85_nus/';
?>
</head>
<body>
    <?php
    // Called from payment.php

if (isset($_SESSION['account_id']) && !empty($_SESSION['account_id']) && isset($_SESSION['cart']) && !empty($_SESSION['cart']) && isset($_GET['collection']) && !empty($_GET['collection'])) {
    // user is logged in, cart is filled, collection mode is specified

    include '../common/connectDB.php';

    $time_now = date("Y-m-d h:i:s");

    $cart = $_SESSION['cart'];

    // var_dump($cart);
    // echo count($cart);

    $total_price = 0;
    for ($i=0;$i<count($cart); $i++) {
        // calculate total price of cart order
        $total_price += $cart[$i]['item_price'];
    }
    // -----------------------Insert orders table first---------------------------
    $collection = $_GET['collection'];
    // add customer_id, datetime_ordered, datetime_ended (NULL), collection mode
    //ucfirst means set first character of string to uppercase
    $query = "INSERT INTO `order` VALUES(null, '" . $_SESSION['account_id'] . "', '" . $time_now . "', null,'". $total_price . "', '" . ucfirst($collection) . "')";

    $result = $db->query($query);

    if (!$result) {
        // echo "<script type='text/javascript'>alert('Failed to insert order!')</script>";
        echo 'Error<br>' . $db->error;
        // header("Location: " . $proj_dir . "cart/cart.php");
    }

    //-------------------Next, insert into delivery address table

    if ($collection == 'Delivery') {
        if (isset($_GET['address']))
            $delivery_address = trim($_GET['address']);
            else
            $delivery_address = '';
        $query = "INSERT INTO delivery_address VALUES(null, (SELECT max(order_id) FROM `order`), '". $delivery_address . "')";

        $result = $db->query($query);

        if (!$result) {
            // echo "<script type='text/javascript'>alert('Failed to insert delivery address!')</script>";
            echo 'Error<br>' . $db->error;
            // header("Location: " . $proj_dir . "cart/cart.php");
        }
    }
    // -----------------------Insert into order items table next--------------------------
        $hasItemInsertionError = false; //flag to indicate if there is any failure in inserting items
        $hasItemPrefInsertionError = false;
    for($i=0;$i<count($cart);$i++) {
        $account_id = $_SESSION['account_id'];
        $dish_id = $cart[$i]['item_dish_id'];
        $stall_id = $cart[$i]['item_stall_id'];
        $item_quantity = $cart[$i]['item_qty'];
        $item_price = $cart[$i]['item_price'];
        $item_pref_temp = $cart[$i]['item_pref'];
        $special_instruction = trim($item_pref_temp['si']);    //remove white spaces front and back of text from special instructions
        
        $query = "INSERT INTO order_item VALUES (null, (SELECT max(order_id) as max_order_id FROM `order`), '" . $dish_id . "', '" . $stall_id . "', '" . $item_quantity . "', '" . $item_price . "', '" . $special_instruction . "', 'Pending', null);";

        $result = $db->query($query);

        if(!$result) {
            $hasItemInsertionError = true;
            break;
        }

        // format item's dish preference first before inserting to database

        // var_dump($special_instruction);
        // echo "<br/>";

        unset($item_pref_temp['si']); // remove special_instruction from item pref array

        // Get latest order item id
        $query = "SELECT max(order_item_id) as order_item_id FROM order_item;";

        $result = $db->query($query);

        if(!$result) {
            $hasItemInsertionError = true;
            break;
        }

        $order_item_id = $result->fetch_assoc()['order_item_id'];

        // echo "<br/>";
        // echo "<br/>";


        // $item_pref_array = array();


        // $item_pref_delimited = implode('.', $item_pref_array);  //delimits array elements with '.'
        // var_dump($item_pref_delimited); echo '<br>';

        $item_pref_temp = array_values($item_pref_temp);

        // var_dump($item_pref_temp);


        $item_pref_array = array();
        foreach ($item_pref_temp as $item_pref) {
            if (!empty($item_pref)) {
                if (gettype($item_pref) == 'array') {
                    // add_on preference detected, because it is a nested array
                    foreach($item_pref as $add_on) {
                            $hasItemPrefInsertionError = insertItemPreference($order_item_id, $add_on);    //append each add_on into array

                            if($hasItemPrefInsertionError)
                                break;
                    }
                } else {
                    $hasItemPrefInsertionError = insertItemPreference($order_item_id, $item_pref);
                    if($hasItemPrefInsertionError)
                        break;
                }
            }
        }

    }   //end of for loop of order item insertion

    if($hasItemInsertionError || $hasItemPrefInsertionError)
            echo 'Error<br>' . $db->error;

            else {
                echo "Success<br/><br/>";
                // ============================= TODO =====================================

                // ---------------------- At this point, all insertions into database tables are successful-------------------
                // get order no. from db
                $query = 'SELECT max(order_id) as order_id FROM `order`;';
                $result = $db->query($query);
    
                if ($result) {
                    // query successful
                    if ($result->num_rows == 1) {
                       $row = $result->fetch_assoc();
                       $max_order_id = $row['order_id'];   //get order id of latest order
    
                        // ---------------------- Next, email customer of the receipt-------------------------------------------------
                        
                       $isEmailSuccess = emailCustomerReceipt($max_order_id);
                        // // $isEmailSuccess = true;
                        if ($isEmailSuccess) {
                            // clear cart
                            unset($_SESSION['cart']);
                            
                            echo 'Order placed successfully! Please check your email for order receipt!';
                            echo "<script type='text/javascript'>
                                alert('Your order placement is successful! Your order no. is " . $max_order_id .". Please check your email for your order updates!');
                                console.log('" . $proj_dir . "home/index.php');
                                location.href = '" . $proj_dir . "home/index.php';
                                </script>";
                        } else {
                            echo 'Order placement or email of order receipt failed!';
                            echo "<script type='text/javascript'>
                            alert('Your order placement or email of order receipt failed! Error:" . $isEmailSuccess . "');
                            console.log('" . $proj_dir . "cart/cart.php');
                            location.href = '" . $proj_dir . "cart/cart.php';
                            </script>";
                        }
                    }
                } else {
                    echo 'query order id error!';
                }
            }



        }
    
    ?>
</body>
</html>