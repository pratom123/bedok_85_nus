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
    include 'function_definition.php';

    if(isset($_GET['purpose'])) {
        if ($_GET['purpose'] == 'update_status') {
            $stall_id = $_GET['stall_id'];
            $order_id = $_GET['order_id'];
            echo $updated_status = $_GET['order_status'];
            $updated_remark = $_GET['remark'];
            
            $isUpdateSuccess = updateDBOrderStatus($stall_id, $order_id, $updated_status, $updated_remark);

            if ($isUpdateSuccess)
                header("Location: admin.php?isUpdateSuccess=true");  //reload page
                else
                    header("Location: admin.php?isUpdateSuccess=false");
                    echo "<script type='text/javascript'>alert('Failed to update database or email customer!')</script>";

                    
        } else if ($_GET['purpose'] == 'update_stall_details') {
            $stall_id = $_GET['stall_id'];
            // $stall_name = $_GET['stall_name'];
            $announcement = $_GET['announcement'];
            $description = $_GET['description'];
            $opening_hour_start = date("Y-m-d H:i:s", strtotime(date("Y-m-d") . " " . $_GET['opening_hour_start']));
            $opening_hour_end = date("Y-m-d H:i:s", strtotime(date("Y-m-d") . " " . $_GET['opening_hour_end']));
            // $contact_no = $_GET['contact_no'];
            // $unit_no = $_GET['unit_no'];
            $open_status = $_GET['open_status'];

            $isUpdateStallDetailsSuccess = updateDBStallDetails($stall_id, $announcement, $description, $opening_hour_start, $opening_hour_end, $open_status);

            if($isUpdateStallDetailsSuccess)
                header("Location: admin.php?isUpdateStallDetailsSuccess=true");
                else
                    header("Location: admin.php?isUpdateStallDetailsSuccess=false");

        }
    }
    
    
    ?>
</body>
</html>
<?php

function getDateTimeNow() {
    return date('Y-m-d H:i:s');
}

?>