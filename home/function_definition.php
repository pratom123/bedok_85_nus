<?php 

function retrieveStallDetails($stall_id) {
    // include '../common/initialize_all.php';
    include '../common/connectDB.php';

    $query = "SELECT * FROM stall WHERE stall_id = $stall_id";

    $result = $db->query($query);

    if($result && $result->num_rows==1) {
        $stall_details = $result->fetch_array(MYSQLI_ASSOC);    //Fetch the associative array from the database stalls table row
        
    }

    // Find stall contact no
    $query = "SELECT user.contact_no FROM `user`, (SELECT s_user_id FROM admin WHERE stall_id = $stall_id) subquery
    WHERE `user`.user_id = subquery.s_user_id";

    $result = $db->query($query);

    if($result && $result->num_rows==1) {
        $contact_no = $result->fetch_array(MYSQLI_ASSOC);

        $stall_details += $contact_no;

        // var_dump($stall_details);

        return $stall_details;
    }

    return NULL;
}

?>