<!-- Purpose of this script is to add/update/delete to cart via Sessions -->

<?php 
session_start(); 
$proj_dir = 'http://localhost/bedok_85_nus/';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include $proj_dir . 'common/initialize_all.php';?>
</head>
<body>
    <?php
    // check GET request
    if (!isset($_GET["purpose"])) {
        echo "no purpose found";
        exit();
    }


    if ($_GET["purpose"] == "add_item") {
        // Check current cart and add item to session's cart

        // get items from get method
        $item_adding = array(
            // Take note: this array is zero-indexed
            "item_stall_id" => $_GET["item_stall_id"],
            "item_stall_name" => $_GET["item_stall_name"],
            "item_dish_id" => $_GET["item_dish_id"],
            "item_dish_name" => $_GET["item_dish_name"],
            "item_dish_img_name" => $_GET['item_dish_img_name'],
            "item_pref" => $_GET["item_pref"],    // Take note: item_pref is an array
            "item_qty" => $_GET["item_qty"],
            "item_price" => $_GET["item_price"]
        );

        if(!isset($_SESSION["cart"])) {
            // cart not set yet
            $_SESSION["cart"] = array($item_adding);

            echo "<br><b>New cart:</b><br>";

        } else {
            // update cart
            // append the item array(currently adding) to the end of the current session's cart items array
            array_push($_SESSION["cart"], $item_adding);
            echo "<br><b>Updated cart:</b><br>";
        }
        // echo "<br><br><br><br><br><br><br>";
        // var_dump($_SESSION["cart"]);

        header("Location: " . $proj_dir . "home/index.php");
    } else if ($_GET["purpose"] == "update_item") {
        
        // get items from get method
        $item_updating = array(
            // array here is similar to the above item adding
            "item_stall_id" => $_GET["item_stall_id"],
            "item_stall_name" => $_GET["item_stall_name"],
            "item_dish_id" => $_GET["item_dish_id"],
            "item_dish_name" => $_GET["item_dish_name"],
            "item_dish_img_name" => $_GET['item_dish_img_name'],
            "item_pref" => $_GET["item_pref"],    // Take note: item_pref is an array
            "item_qty" => $_GET["item_qty"],
            "item_price" => $_GET["item_price"]
        );

        $item_index_to_be_updated = $_GET['cart_item_index_to_be_updated'];    //Session cart index to be updated
        $_SESSION['cart'][$item_index_to_be_updated] = $item_updating;



        header("Location: " . $proj_dir . "cart/cart.php");

    } else if ($_GET["purpose"] == "delete_item") {
        $item_index_to_be_deleted = $_GET["cart_item_index_to_be_deleted"];
        unset($_SESSION["cart"][$item_index_to_be_deleted]);    //deletion of item happens here
        $_SESSION["cart"] = array_values($_SESSION["cart"]); //re-index item index
        echo "<br>----------------------------<br>";
        var_dump($_SESSION["cart"]);
        header("Location: " . $proj_dir . "cart/cart.php");
    }
    ?>
</body>
</html>