<?php 

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

require '../config.php';

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
            $query = "SELECT
            u.email, u.contact_no, c.first_name, c.last_name, q3.datetime_ordered, q3.order_cost, q3.collection_mode, q3.order_id, q3.order_status, q3.food_details, q3.stall_comment, da.address
            FROM
            ( -- food details
                SELECT q2.customer_id, q2.datetime_ordered, q2.order_cost, q2.collection_mode, q2.order_id, q2.order_status, GROUP_CONCAT(item_details SEPARATOR '<br/>') food_details, q2.stall_comment
                FROM
                (
                    SELECT q1.customer_id, q1.datetime_ordered, q1.order_cost, q1.collection_mode, q1.order_id, q1.order_status, CONCAT(q1.quantity, 'x ', q1.food_name, '<br/>', q1.food_details, '<br/>-', q1.special_instruction, '<br/>') as item_details, q1.stall_comment
                    FROM
                    (
                        SELECT stall_food_id_query.customer_id, stall_food_id_query.datetime_ordered, stall_food_id_query.order_cost, stall_food_id_query.collection_mode, f_out.food_name, stall_food_id_query.order_id, stall_food_id_query.order_item_id, stall_food_id_query.quantity, stall_food_id_query.order_status, 
                        GROUP_CONCAT(CONCAT('-', ip.food_preference) SEPARATOR '<br/>') food_details, stall_food_id_query.special_instruction, stall_food_id_query.stall_comment
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
                        oi.special_instruction,
                        oi.stall_comment
                        FROM `order` o
                        INNER JOIN order_item oi
                        ON o.order_id = oi.order_id
                        INNER JOIN stall s
                        ON oi.stall_id = s.stall_id
                        AND oi.stall_id = " . $_SESSION['stall_id'] . "
                        INNER JOIN food f
                        ON oi.food_id = f.food_id
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
            
            $result = $db->query($query);

            if ($result) {
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    $order_adding['order_id'] = $row['order_id'];
                    $order_adding['order_datetime'] = $row['datetime_ordered'];
                    $order_adding['food_details'] = $row['food_details'];
                    $order_adding['collection_mode'] = $row['collection_mode'];
                    $order_adding['order_status'] = $row['order_status'];
                    $order_adding['firstname'] = $row['first_name'];
                    $order_adding['lastname'] = $row['last_name'];
                    $order_adding['address'] = $row['address'];
                    $order_adding['e_mail'] = $row['email'];
                    $order_adding['mobile_no'] = $row['contact_no'];
                    $order_adding['remark'] = $row['stall_comment'];
                        
                        array_push($order, $order_adding);
                    }

                    return $order;
                }
            } else {
                echo $db->error;
            }
    }

    // " . $_SESSION['stall_id'] . "

    function retrieveOrderByOrderID($order_id) {
        include '../common/connectDB.php';

        $stall_id = $_SESSION['stall_id'];

        $order = array(
            'order_id' => '',
            'order_datetime' => '',
            'total_cost' => '',
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
        $query = "SELECT sum(item_cost) AS sum_of_cost FROM order_item WHERE order_id = $order_id AND stall_id = $stall_id";
        $result = $db->query($query);
        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $order['total_cost'] = $row['sum_of_cost'];
        } else {
            return NULL;
        }

        $query = "SELECT
        u.email, u.contact_no, c.first_name, c.last_name, q3.datetime_ordered, q3.order_cost, q3.collection_mode, q3.order_id, q3.order_status, q3.food_details, q3.stall_comment, da.address
		FROM
        ( -- food details
            SELECT q2.customer_id, q2.datetime_ordered, q2.order_cost, q2.collection_mode, q2.order_id, q2.order_status, GROUP_CONCAT(item_details SEPARATOR '<br/><br/>') food_details, q2.stall_comment
            FROM
            (
                SELECT q1.customer_id, q1.datetime_ordered, q1.order_cost, q1.collection_mode, q1.order_id, q1.order_status, CONCAT(q1.quantity, 'x ', q1.food_name, '<br/>', q1.food_details, '<br/>-', q1.special_instruction) as item_details, q1.stall_comment
                FROM
                (
                    SELECT stall_food_id_query.customer_id, stall_food_id_query.datetime_ordered, stall_food_id_query.order_cost, stall_food_id_query.collection_mode, f_out.food_name, stall_food_id_query.order_id, stall_food_id_query.order_item_id, stall_food_id_query.quantity, stall_food_id_query.order_status, 
                    GROUP_CONCAT(CONCAT('-', ip.food_preference) SEPARATOR '<br/>') food_details, stall_food_id_query.special_instruction, stall_food_id_query.stall_comment
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
                    oi.special_instruction,
                    oi.stall_comment
                    FROM `order` o
                    INNER JOIN order_item oi
                    ON o.order_id = oi.order_id
                    INNER JOIN stall s
                    ON oi.stall_id = s.stall_id
                    AND s.stall_id = $stall_id
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

        $result = $db->query($query);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $order['order_id'] = $row['order_id'];
            $order['order_datetime'] = $row['datetime_ordered'];
            // $order['total_cost'] = $row['order_cost'];
            $order['food_details'] = $row['food_details'];
            $order['collection_mode'] = $row['collection_mode'];
            $order['order_status'] = $row['order_status'];
            $order['firstname'] = $row['first_name'];
            $order['lastname'] = $row['last_name'];
            $order['address'] = $row['address'];
            $order['e_mail'] = $row['email'];
            $order['mobile_no'] = $row['contact_no'];
            $order['remark'] = $row['stall_comment'];

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

        $customer_email = $order['e_mail'];
        $customer_name = $order['firstname'] . ' ' . $order['lastname'];
        $order_datetime = $order['order_datetime'];
        $formatted_food_details = $order['food_details'];
        $order_total_cost = $order['total_cost'];
        $order_status = $order['order_status'];
        $collection_mode = $order['collection_mode'];
        $delivery_address = $order['address'];
        $remark = $order['remark'];

        // code below formats the delimited order food details strings into a display string with new line
        // $order_food_details = explode('<br/>', $order_food_details);
        // $temp = $order_food_details;

        // $formatted_food_details = '';
        // for($i=0;$i<count($temp); $i++) {
        //     if (strpos($temp[$i], '.')) {
        //         $add_on_strings = explode('.', $temp[$i]);
        //         // var_dump($add_on_strings);
        //         for($j=0;$j<count($add_on_strings); $j++) {
        //             $formatted_food_details = $formatted_food_details . "\n-" . $add_on_strings[$j];
        //         }
        //     } else
        //         $formatted_food_details = $formatted_food_details . "\n" . $temp[$i];
        // }

        // ----============

        $subject = 'Bedok 85: ' . $stall_name . " Order Update";


        $message = "Your Order No. <b>". $order_id . "</b> status has been updated to <b>$order_status</b>.
        <br/>
        <br/><b>Customer Name:</b> $customer_name
        <br/><b>Order Date/Time:</b> " . $order_datetime . "
        <br/>
        <br/><u><b>Food Details</b></u><br/>
        " . $formatted_food_details . "
        <br/>
        <br/><b>Total Cost:</b> \$" . $order_total_cost . "
        <br/><b>Collection Mode: ";
        if ($collection_mode=='Delivery') {
            $message .= "Delivery - $delivery_address";
        } else
            $message .= "Self-pickup";

        $message .= "</b><br/><br/>";
        $message .= "<b>Stall Comment:</b><br/>";
        $message .= ($remark === NULL || $remark === '') ? "NIL" : $remark;

        // echo $message;

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_USERNAME;                     //SMTP username
            $mail->Password   = EMAIL_PASSWORD;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Sender
            $mail->setFrom(EMAIL_USERNAME);
            //Recipient(s)
            $mail->addAddress($customer_email);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            $_SESSION["emailCustomerOrderStatusResult"] = $mail->send();
            return true;
        } catch (Exception $e) {
            $_SESSION["emailCustomerOrderStatusResult"] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }

        // ----============
    }
    

    function updateDBOrderStatus($stall_id, $order_id, $updated_status, $updated_remark) {
        include '../common/initialize_all.php';
        include '../common/connectDB.php';

        $query = "UPDATE order_item
        SET order_status = '" . $updated_status ."', stall_comment = '" . $updated_remark . "'
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

        $query = "SELECT u.contact_no , s.* FROM stall s
        INNER JOIN admin a
        ON a.stall_id = s.stall_id
        INNER JOIN `user` u
        ON a.s_user_id = u.user_id
        WHERE s.stall_id = $stall_id";

        $result = $db->query($query);

        if ($result) {
            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $stall_details['stall_id'] = $row['stall_id'];
                $stall_details['stall_name'] = $row['stall_name'];
                $stall_details['announcement'] = $row['announcement'];
                $stall_details['description'] = $row['description'];
                $stall_details['opening_hour_start'] = (new DateTime($row['opening_hour_start']))->format("h:i:s");
                $stall_details['opening_hour_end'] = (new DateTime($row['opening_hour_end']))->format("h:i:s");
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

    function updateDBStallDetails($stall_id, $announcement, $description, $opening_hour_start, $opening_hour_end, $open_status) {
        include '../common/initialize_all.php';
        include '../common/connectDB.php';

        echo $stall_id . '<br/>';
        echo $announcement . '<br/>';
        echo $description . '<br/>';
        echo $opening_hour_start . '<br/>';
        echo $opening_hour_end . '<br/>';
        echo $open_status . '<br/>';


        if ($open_status == 'Open')
            $open_status_bit = 1;
            else
                $open_status_bit = 0;

        $query = "UPDATE stall set announcement = '$announcement', description = '$description', opening_hour_start = '$opening_hour_start', opening_hour_end = '$opening_hour_end', open_status = $open_status_bit WHERE stall_id = $stall_id;";

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