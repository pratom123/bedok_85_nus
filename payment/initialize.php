<?php
    include '../common/initialize_all.php';
    include 'function_definition.php';
    include '../common/connectDB.php';
    
    checkForOrder($db);

    $prices = retrievePrices($db);

    mysqli_close($db);
?>