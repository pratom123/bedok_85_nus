<?php 

function retrieveStallDetails($stall_id) {
    // include '../common/initialize_all.php';
    include '../common/connectDB.php';

    $query = "SELECT * FROM stalls WHERE stall_id = $stall_id";

    $result = $db->query($query);

    if($result && $result->num_rows==1) {
        $stall_details = $result->fetch_array(MYSQLI_ASSOC);    //Fetch the associative array from the database stalls table row
        return $stall_details;
    }
    return NULL;
}

?>