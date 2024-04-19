<?php 
    if(!isset($_SESSION))
        session_start();
    // $_SESSION["isLoggedIn"] = true;
    // include 'initialize_all';

    if (isset($_SESSION['isAtFoodPage']) && $_SESSION['isAtFoodPage'] == true) {
        $dir = '../../';
    } else
        $dir = '../'; //project directory
?>

<div class="overlay_background" id="overlay_background">
</div>

<div class="overlay" id="overlay">
    <header>
        <a href="javascript:void(0)" class="closebtn" onclick="closeOverlay()">&times;</a>
    </header>
    <div id="nav_option_wrapper">
        <div class="nav_link">
            <ul>
                <li>
                    <?php 
                    echo (isset($_SESSION["account_id"]))? 
                    "<a href='" . $dir . "profile_detail/profile_details.php'>Profile Details</a>": 
                    "<a href='" . $dir. "login/login.php'>Login</a>"; ?>
                </li>
                <li>
                    <a href="<?php echo $dir ?>about_us/about_us.php">About Us</a>
                </li>
                <li>
                    <?php echo (isset($_SESSION['account_id']))? "<a href='" . $dir . "common/logout.php'>Log out</a>":''; ?>
                </li>
            </ul>
            
        </div>
    </div>
</div>