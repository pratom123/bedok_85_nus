<?php
require_once '../common/bridge/Email.php';
require_once '../common/bridge/CustomerReceiptRenderer.php';

function retrieveDataFromDb() {
    if (isset($_SESSION['account_id']) && !empty($_SESSION['account_id'])) {
        include '../common/connectDB.php';

        // Collect customer address and credit card
        $query = "SELECT user_id, `address` FROM `user` WHERE user_id = " . $_SESSION['account_id'] . ";";

        // $query = "SELECT * FROM Account_information WHERE account_id = '" . $_SESSION['account_id'] . "';";

        $result = $db->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $data = array (
            'account_id' => $row['user_id'],
            'Address1' => $row['address'],
            'Address2' => '',
            'Address3' => '',
            );
        }

        $query = "SELECT * FROM `credit_card` WHERE c_user_id = " . $_SESSION['account_id'] . ";";

        $result = $db->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $data += array (
            'credit_card' => $row['credit_card_no'],
            'card_name' => $row['card_name'],
            'cv2' => $row['cv2'],
            'expirydate' => $row['expiry_date'],
            );
        }

        // get order no. from db
        $query = 'SELECT max(order_id) as max_order_id FROM `order`;';
        $result = $db->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $max_order_id = $row['max_order_id'];

            if (is_null($max_order_id)) {
                // returning null means that the orders table from db has no records
                $order_id = 1; //so set order id as 1 because current order will be the first order
            } else
                $order_id = $max_order_id + 1;
        }
        
        return $data += array('order_id' => $order_id);  
    }
}

function displayCartItems() {
    include '../common/initialize_all.php';
    // session_start();
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        
        $cart = $_SESSION['cart'];
        $num_items = count($_SESSION['cart']);
        echo '<tbody><tr>';

        $total_price = 0;
        for ($i=0; $i<$num_items;$i++) {
            $item_qty = $cart[$i]['item_qty'];
            $item_dish_name = $cart[$i]['item_dish_name'];
            $item_price = $cart[$i]['item_price'];
            $total_price += $item_price;

            echo "<td class='qty'>" . $item_qty . "</td>";
            echo "<td>" . $item_dish_name . "</td>";
            echo "<td class='price'>" . number_format($item_price, 2) . "</td>";
            echo '</tr>';
        }
        
        echo "</tbody><tfoot>
                <tr>
                    <td colspan='2' id='price_label'><strong>Total:</strong></td>
                    <td colspan class='price'><strong>". number_format($total_price, 2) . "</strong></td>
                </tr>
            </tfoot>";
    }
}

function retrievePrices($_db) {

    $query = "SELECT single_price.coffee_id, name, single_price.price AS single_price, double_price.price AS double_price FROM single_price,java_jam_coffee, double_price WHERE (single_price.coffee_id = java_jam_coffee.coffee_id and double_price.coffee_id = java_jam_coffee.coffee_id) ORDER BY coffee_id ASC;";
    $result = $_db->query($query);

    $prices = array("jj" => array("coffee_id" => NULL, "single_price" => NULL), 
                    "cal" => array("coffee_id" => NULL, "single_price" => NULL, "double_price" => NULL),
                    "ic" => array("coffee_id" => NULL, "single_price" => NULL, "double_price" => NULL));

    // Saves retrieved SQL data into multidimension associative array
    // echo $result->num_rows;
    if ($result->num_rows) {
        $row_counter = 0;
        while ($row = $result->fetch_assoc()) {
            switch ($row_counter) {
                case 0 : $prices["jj"]["single_price"] = $row["single_price"];
                         $prices["jj"]["coffee_id"] = $row["coffee_id"];
                         break;
                         
                case 1 : $prices["cal"]["single_price"] = $row["single_price"];
                         $prices["cal"]["double_price"] = $row["double_price"];
                         $prices["cal"]["coffee_id"] = $row["coffee_id"];
                         break;

                case 2 : $prices["ic"]["single_price"] = $row["single_price"];
                         $prices["ic"]["double_price"] = $row["double_price"];
                         $prices["ic"]["coffee_id"] = $row["coffee_id"];
                         break;
            }
            $row_counter++;
        }
    }

    // foreach($prices as $coffee => $coffeePrice) {
    //     foreach($coffeePrice as $priceType => $value) {
    //         echo "Key: " . $priceType . " Value: " . $value . "<br/>";
    //     }
    // }

    return $prices;
}

function insertItemPreference($order_item_id, $item_pref) {
    include '../common/connectDB.php';
    $query = "INSERT INTO item_preference VALUES ($order_item_id, '" . $item_pref . "');";

    $result = $db->query($query);

    if(!$result) {
        return true;
    }
    return false;
}

function checkForOrder($_db) {
    if (isset($_GET['order'])) {
        //There is an order request from user
        $order = $_GET['order'];
        // $order contains order details with extra variable total Price e.g.
        // array(4) { ["jj"]=> array(2) { ["quantity"]=> string(1) "1" ["price"]=> string(1) "3" } ["cal"]=> array(3) { ["priceType"]=> string(12) "single_price" ["quantity"]=> string(0) "" ["price"]=> string(1) "0" } ["ic"]=> array(3) { ["priceType"]=> string(12) "single_price" ["quantity"]=> string(0) "" ["price"]=> string(1) "0" } ["totalPrice"]=> string(1) "3" } string(1) "1"

        $totalCost = (float) $order['totalPrice'];
        $dateTimeNow = getDateTimeNow();
        // echo $dateTimeNow;

        $query = "INSERT INTO java_jam_order VALUES(NULL, '$dateTimeNow', $totalCost); ";

        $result = $_db->query($query);

                if (!$result)
                    echo "<script type='text/javascript'>alert('Order insertion failed! Error message: $_db->error')</script>";       

        unset($order['totalPrice']);    //need to unset total price from $order so that it can iterate properly in the foreach loop

        $hasError = false;
        foreach ($order as $coffeeType => $details) {
            // echo '<br>' . $coffeeType . '<br>';
            // echo '<br>' . $details['quantity'] . '<br>';

            if (!empty($details['quantity'])) {
                //format to standardardized database names
                $coffeeName = getCoffeeName($coffeeType);
                $priceType = (isset($details['priceType'])) ? $details['priceType'] : 'single_price';
                $quantity = (int) $details['quantity'];
                $cost = (float) $details['price'];

                // echo '<br>coffeeName: ' . $coffeeName . '<br>';
                // echo '<br>priceType: ' . $priceType . '<br>';
                // echo '<br>quantity: ' . $quantity . '<br>';
                // echo '<br>cost: ' . $cost . '<br>';
                
                $query = "INSERT INTO java_jam_order_items VALUES(NULL, (SELECT coffee_id FROM java_jam_coffee WHERE name = '$coffeeName'), '$priceType', (SELECT price FROM $priceType WHERE coffee_id = (SELECT coffee_id FROM java_jam_coffee WHERE name = '$coffeeName')), (SELECT last_updated FROM $priceType WHERE coffee_id = (SELECT coffee_id FROM java_jam_coffee WHERE name = '$coffeeName')), $quantity, $cost, (SELECT MAX(order_id) FROM java_jam_order)); ";

                // echo $query . "<br><br>";

                $result = $_db->query($query);

                if(!$result) {
                    $hasError = true;
                    break;
                }
            }
        }

        if ($hasError)
            echo "<script type='text/javascript'>alert('Order item insertion failed! Error message: $_db->error')</script>";
                else
                    echo "<script type='text/javascript'>alert('All order item(s) insertion is/are successful!')</script>";
                        
    }
}

function getCoffeeName($_coffeeType) {
    switch($_coffeeType) {
        case 'jj': return 'Just Java';
            
        case 'cal': return 'Cafe au Lait';
            
        case 'ic': return 'Iced Cappuccino';
            
    }
}

function getDateTimeNow() {
    return date('Y-m-d H:i:s');
}


function emailCustomerReceipt($order_id) {
    include '../common/connectDB.php';

    $query = "SELECT
    u.email, c.first_name, c.last_name, q3.datetime_ordered, q3.order_cost, q3.collection_mode, q3.order_id, q3.order_status, q3.food_details, da.address
    FROM
    ( -- food details
        SELECT q2.customer_id, q2.datetime_ordered, q2.order_cost, q2.collection_mode, q2.order_id, q2.order_status, GROUP_CONCAT(item_details SEPARATOR '<br/>') food_details
        FROM
        (
            SELECT q1.customer_id, q1.datetime_ordered, q1.order_cost, q1.collection_mode, q1.order_id, q1.order_status, CONCAT(q1.quantity, 'x ', q1.food_name, '<br/>', q1.food_details, '<br/>-', q1.special_instruction, '<br/>') as item_details
            FROM
            (
                SELECT stall_food_id_query.customer_id, stall_food_id_query.datetime_ordered, stall_food_id_query.order_cost, stall_food_id_query.collection_mode, f_out.food_name, stall_food_id_query.order_id, stall_food_id_query.order_item_id, stall_food_id_query.quantity, stall_food_id_query.order_status, 
                GROUP_CONCAT(CONCAT('-', ip.food_preference) SEPARATOR '<br/>') food_details, stall_food_id_query.special_instruction
                FROM food f_out

                INNER JOIN 
                (SELECT
                o.customer_id,
                o.datetime_ordered,
                o.order_cost,
                o.collection_mode,
                oi.stall_id,
                oi.food_id,
                oi.order_item_id,
                oi.quantity,
                oi.order_status,
                oi.order_id,
                oi.special_instruction
                FROM `order` o
                INNER JOIN order_item oi
                ON o.order_id = oi.order_id
                INNER JOIN stall s
                ON oi.stall_id = s.stall_id
                INNER JOIN food f
                ON oi.food_id = f.food_id
                WHERE o.order_id = $order_id
                GROUP BY oi.food_id, oi.stall_id) stall_food_id_query
                ON f_out.stall_id = stall_food_id_query.stall_id
                AND f_out.food_id = stall_food_id_query.food_id

                INNER JOIN item_preference ip
                on ip.order_item_id = stall_food_id_query.order_item_id
                GROUP BY stall_food_id_query.order_item_id, stall_food_id_query.order_status) q1
            ) q2
            GROUP BY q2.order_id
        ) q3
    INNER JOIN customer c
    ON q3.customer_id = c.c_user_id 
    INNER JOIN `user` u
    ON c.c_user_id = u.user_id
    LEFT JOIN delivery_address da
    ON q3.order_id = da.order_id;";

    // get user and customer email, first name and last name
    // get order order_datetime, total_price, collection_mode, delivery address (if any)
    // get order item food name, quantity, order_status, special instruction, and item preference

    $result = $db->query($query);

    if ($result && $result->num_rows == 1) {
        // retrieval of latest order info from database is successful
        $order = $result -> fetch_array(MYSQLI_ASSOC);  //fetch the entire row from mysql as an associative array
        $order += array('order_id' => $order_id);
        //===== TODO HERE ===========
        $customerReceiptRenderer = new CustomerReceiptRenderer();
        $email = new Email($customerReceiptRenderer, $order);
        $email->setContent();
        return $email->send();
    } else
        return "Error adding order into database";

}

?>