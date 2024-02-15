<?php 

session_start();

include '../common/initialize_all.php';

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    
    function retrieveAllOrders() {
        include '../common/connectDB.php';
        $hasError = false;

        $order = array();
        $order_adding = array(
            'order_id' => '',
            'order_datetime' => '',
            'food_details' => '',
            'collection_mode' => '',
            'order_status' => '',
            'firstname' => '',
            'lastname' => '',
            'address' => '',
            'e_mail' => '',
            'mobile_no' => '',
            'remark' => ''
        );
            // filter items through stall_id
            $query = "SELECT DISTINCT * FROM
            (SELECT order_items.order_id, orders.order_datetime, stalls.stall_id, food_details_table.food_details, order_items.collection_mode,  order_items.order_status, Account_information.firstname, Account_information.lastname, delivery_address.address, Account_information.e_mail, Account_information.mobile_no, order_items.remark
                    FROM order_items
                    
                    INNER JOIN
                    
                    (SELECT order_id, GROUP_CONCAT( item_details SEPARATOR '<br/><br/>' ) AS food_details FROM (
                        SELECT * , CONCAT( item_quantity, 'x ', (SELECT dish_name FROM dishes WHERE order_items.dish_id = dishes.dish_id), '<br/>', item_pref) AS item_details FROM order_items WHERE stall_id = " . $_SESSION['stall_id'] . ")subquery
                        GROUP BY subquery.order_id
                    ) food_details_table
                    
                    ON order_items.order_id = food_details_table.order_id
                    
                    INNER JOIN orders ON orders.order_id = order_items.order_id
                    INNER JOIN Account_information ON Account_information.account_id = order_items.account_id
                    INNER JOIN delivery_address ON delivery_address.order_id = order_items.order_id
                    INNER JOIN stalls ON stalls.stall_id = order_items.stall_id) subquery2
            
                    WHERE subquery2.stall_id = " . $_SESSION['stall_id'] . "
            
                    ORDER BY subquery2.order_id DESC;";
            
            $result = $db->query($query);

            if ($result) {
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    $order_adding['order_id'] = $row['order_id'];
                    $order_adding['order_datetime'] = $row['order_datetime'];
                    $order_adding['food_details'] = $row['food_details'];
                    $order_adding['collection_mode'] = $row['collection_mode'];
                    $order_adding['order_status'] = $row['order_status'];
                    $order_adding['firstname'] = $row['firstname'];
                    $order_adding['lastname'] = $row['lastname'];
                    $order_adding['address'] = $row['address'];
                    $order_adding['e_mail'] = $row['e_mail'];
                    $order_adding['mobile_no'] = $row['mobile_no'];
                    $order_adding['remark'] = $row['remark'];
                        
                        array_push($order, $order_adding);
                    }

                    return $order;
                }
            } else {
                echo $db->error;
            }
    }

    function retrieveOrderByOrderID($order_id) {
        include '../common/connectDB.php';

        $stall_id = $_SESSION['stall_id'];

        $order = array(
            'order_id' => '',
            'order_datetime' => '',
            'total_price' => '',
            'food_details' => '',
            'collection_mode' => '',
            'order_status' => '',
            'firstname' => '',
            'lastname' => '',
            'address' => '',
            'e_mail' => '',
            'mobile_no' => '',
            'remark' => ''
        );
        // get price of the specified order no. from a stall
        $query = "SELECT sum(item_price) AS sum_of_price FROM order_items WHERE order_id = $order_id AND stall_id = $stall_id";
        $result = $db->query($query);
        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $order['total_price'] = $row['sum_of_price'];
        } else {
            return NULL;
        }

        $query = "SELECT DISTINCT * FROM
        (SELECT order_items.order_id, orders.order_datetime, stalls.stall_id, order_items.collection_mode, order_items.order_status, Account_information.firstname, Account_information.lastname, delivery_address.address, Account_information.e_mail, Account_information.mobile_no, order_items.remark, food_details_table.food_details
                FROM order_items
                
                INNER JOIN
                
                (SELECT order_id, GROUP_CONCAT( item_details SEPARATOR '<br/><br/>' ) AS food_details FROM (
                    SELECT * , CONCAT( item_quantity, 'x ', (SELECT dish_name FROM dishes WHERE order_items.dish_id = dishes.dish_id), '<br/>', item_pref) AS item_details FROM order_items WHERE stall_id = $stall_id)subquery
                    GROUP BY subquery.order_id
                ) food_details_table
                
                ON order_items.order_id = food_details_table.order_id
                
                INNER JOIN orders ON orders.order_id = order_items.order_id
                INNER JOIN Account_information ON Account_information.account_id = order_items.account_id
                INNER JOIN delivery_address ON delivery_address.order_id = order_items.order_id
                INNER JOIN stalls ON stalls.stall_id = order_items.stall_id) subquery2
        
                WHERE subquery2.stall_id = $stall_id AND subquery2.order_id = $order_id
        
                ORDER BY subquery2.order_id DESC;";

        $result = $db->query($query);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $order['order_id'] = $row['order_id'];
            $order['order_datetime'] = $row['order_datetime'];
            // $order['total_price'] = $row['total_price'];
            $order['food_details'] = $row['food_details'];
            $order['collection_mode'] = $row['collection_mode'];
            $order['order_status'] = $row['order_status'];
            $order['firstname'] = $row['firstname'];
            $order['lastname'] = $row['lastname'];
            $order['address'] = $row['address'];
            $order['e_mail'] = $row['e_mail'];
            $order['mobile_no'] = $row['mobile_no'];
            $order['remark'] = $row['remark'];

            return $order;
        } else {
            echo 'Error: ' . $db->error;
        }
    }

    function emailCustomerOrderStatus($order_id) {
        $stall_name = $_SESSION['stall_name'];
        include '../common/connectDB.php';

        $order = retrieveOrderByOrderID($order_id);

        if (!$order)    //error, return false
            return false;

        $customer_name = $order['firstname'] . ' ' . $order['lastname'];
        $order_datetime = $order['order_datetime'];
        $order_food_details = $order['food_details'];
        $order_total_price = $order['total_price'];
        $order_status = $order['order_status'];
        $collection_mode = $order['collection_mode'];
        $delivery_address = $order['address'];
        $remark = $order['remark'];

        // code below formats the delimited order food details strings into a display string with new line
        $order_food_details = explode('<br/>', $order_food_details);
        $temp = $order_food_details;

        $formatted_food_details = '';
        for($i=0;$i<count($temp); $i++) {
            if (strpos($temp[$i], '.')) {
                $add_on_strings = explode('.', $temp[$i]);
                // var_dump($add_on_strings);
                for($j=0;$j<count($add_on_strings); $j++) {
                    $formatted_food_details = $formatted_food_details . "\n-" . $add_on_strings[$j];
                }
            } else
                $formatted_food_details = $formatted_food_details . "\n" . $temp[$i];
        }
        $to = 'f32ee@localhost';
        $subject = 'Bedok 85: ' . $stall_name;
        $message = "Thank you for ordering from $stall_name!
        \nCustomer Name: $customer_name
        \nOrder ID: ". $order_id . "
        \nOrder Date/Time: " . $order_datetime . "
        \nFood Details:
        " . $formatted_food_details . "
        \nCost: \$" . $order_total_price . "
        \nOrder Status ";
        if ($collection_mode=='Delivery') {
            $message .= "(Delivery: $delivery_address):\n";
        } else
            $message .= "(Self-pickup):\n";
        $message .= $order_status . ".\n\n";
        $message .= "Remark:\n$remark";
        $header = 'From:f32ee@localhost'. "\r\n".
        'Reply-To:f32ee@localhost' . "\r\n".
        'X-Mailer:PHP/' . phpversion();

        $isMailSuccess = mail($to,$subject,$message,$header,'-ff32ee@localhost');

        return $isMailSuccess;
    }
    

    function updateDBOrderStatus($stall_id, $order_id, $updated_status, $updated_remark) {
        include '../common/initialize_all.php';
        include '../common/connectDB.php';

        $query = "UPDATE order_items
        SET order_status = '" . $updated_status ."', remark = '" . $updated_remark . "'
        WHERE order_id = " . $order_id . " AND stall_id = " . $stall_id . ";";

        $result = $db->query($query);

        if ($result) {
            return emailCustomerOrderStatus($order_id); //return false if there is error in the function
        } else {
            echo 'Error: ' . $db->error;
            return false;
        }
    }

    // ------------------- Stall details query -------------------------------

    function retrieveStallDetails() {
        include '../common/initialize_all.php';
        $stall_id = $_SESSION['stall_id'];
        include '../common/connectDB.php';

        

        $stall_details = array(
            'stall_id' => '',
            'stall_name' => '',
            'announcement' => '',
            'description' => '',
            'opening_hour' => '',
            'contact_no' => '',
            'unit_no' => '',
            'open_status' => ''
        );

        $query = "SELECT * FROM stalls WHERE stall_id = $stall_id";

        $result = $db->query($query);

        if ($result) {
            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $stall_details['stall_id'] = $row['stall_id'];
                $stall_details['stall_name'] = $row['stall_name'];
                $stall_details['announcement'] = $row['announcement'];
                $stall_details['description'] = $row['description'];
                $stall_details['opening_hour'] = $row['opening_hour'];
                $stall_details['contact_no'] = $row['contact_no'];
                $stall_details['unit_no'] = $row['unit_no'];
                $stall_details['open_status'] = $row['open_status'];
                // var_dump($stall_details);

                return $stall_details;
            }
        }
        echo 'Error: ' . $db->error;
        return NULL;
    }

    function updateDBStallDetails($stall_id, $announcement, $description, $opening_hour, $open_status) {
        include '../common/initialize_all.php';
        include '../common/connectDB.php';

        echo $stall_id . '<br/>';
        echo $announcement . '<br/>';
        echo $description . '<br/>';
        echo $opening_hour . '<br/>';
        echo $open_status . '<br/>';


        if ($open_status == 'Open')
            $open_status_bit = 1;
            else
                $open_status_bit = 0;

        $query = "UPDATE stalls set announcement = '$announcement', description = '$description', opening_hour = '$opening_hour', open_status = $open_status_bit WHERE stall_id = $stall_id;";

        $result = $db->query($query);

        if($result) {
            return true;
        }
        echo 'Error: ' . $db->error;
        return false;
    }
    
    ?>
</body>
</html>