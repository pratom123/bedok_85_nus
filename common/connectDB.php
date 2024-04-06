<?php
    // Displays error messages
    ini_set('display_errors', 1);

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "bedok_85_nus";
    
    $db = new mysqli($server, $username, $password, $database);

    if ($db->connect_errno) {
        echo 'Failed to connect to MySQL database';
        exit();
    }
?>