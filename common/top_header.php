<?php 
    // session_start();
    // $_SESSION["isLoggedIn"] = true;
    // include 'initialize_all';

    $dir = 'http://localhost/bedok_85_nus/'; //project directory
?>

<!-- this is the main nav bar for all pages -->

<nav class="top_header">
    <a id="logo" href="<?php echo $dir ?>home/index.php"><img src="<?php echo $dir ?>common/img/bedok85_logo.png" alt="Bedok 85" width="94" height="56"></a>
    <h1 id="hawker_centre_title">Bedok 85 Hawker Centre</h1>
    <aside>
        <ul>
            <li>
                <a href="<?php echo $dir ?>home/index.php">
                    <img id="nav_hawker_centre"src="<?php echo $dir ?>common/img/home_logo.png" alt="Bedok 85" width="35px" height="35px">
                </a>
            </li>
            <li>
                <a href="<?php echo $dir ?>cart/cart.php">
                <img id="nav_cart"src="<?php echo $dir ?>common/img/cart.png" alt="Bedok 85" width="35px" height="35px">
                <span id="cart_qty"><?php echo (!empty($_SESSION["cart"]))? '+' . count($_SESSION["cart"]):""; ?></span>
                </a>
            </li>
            <li id="nav_option">
                <strong id="option">&#8801</strong>
            </li>
            <script type="text/javascript" src="<?php echo $dir ?>common/overlayR.js"></script>
        </ul>
    </aside>
</nav>