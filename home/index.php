<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bedok 85</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../common/externalCSS.css">
    <link rel="stylesheet" href="../common/overlay.css">
    <script type="text/javascript" src="../common/overlay.js"></script>
    <script type="text/javascript" src="scrollToStallSection.js"></script>
    <script type="text/javascript" src="checkOpenStatus.js"></script>
    <?php 
    session_start();
    // session_unset();
    // $_SESSION["account_id"] = true;
    // session_unset($_SESSION["cart"]);
    ?>
    <style>
        body {
            min-width: 1500px;
        }
        .stall_link {
            height: 30px;
            width: 700px;
            position: sticky;
            top: 70px;
            margin-left: auto;
            margin-right: auto;
        }

        .stall_link ul {
            margin-top: 0;
            background-color: azure;
            padding: 0;
             border-bottom: solid black 2px;
             box-shadow: 0px 15px 10px -15px #111;
             border-radius: 0px 0px 50px 50px;
        }

        .stall_link li {
            cursor: pointer;
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 30px;
            margin-right: 30px;
            text-align: center;
            font-size:  1.5em;
            color: #0024C3;
        }

        .stall_link li span:hover {
            color: orange;
        }

        #welcome {
            /* margin-top: 5%; */
        }

        #bedok85_background{
            display: block;
            margin-left: auto;
            margin-right: auto;
            border:azure solid 5px;
        }

        #main_title{
            text-align: center;
        }

        .stall {
            background-color: whitesmoke;
            padding: 30px;
            border-radius: 30px;
            display: block;
            margin-bottom: 3%;
            min-width: 1400px;
        }

        .stall_detail_top {
            min-width: 1400px;
        }

        .stall_detail {
            padding: 20px;
            border-top: thistle solid 2px;
            box-shadow: 5px 0 5px -5px #333;   /* left */
            box-shadow: 5px 5px 5px -5px #333; /* bottom */
            background-color: rgba(255, 229, 180, 0.2);
            border-radius: 20px;
            width: 450px;
            height: 300px;
            float: left;
            /* margin-left: 3%; */
        }

        .stall_detail dt {
                font-weight: bold;
                margin-top: 10px;
        }

        .stall_img {
            /* border: black solid 3px; */
            margin-left: 36%;
            /* padding: 20px; */
            height: 340px;
            width: 900px;
            min-width: 900px;
        }

        .stall_img img {
            display: block;
            min-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .stall_dishes {
            display: flex;
            justify-content: space-evenly;
            margin-top: 2%;
            padding: 10px 0px;
            background-color: rgba(211,211,211, 0.5);
            border-radius: 20px;
        }

        .stall_dishes a{
            all: unset;
        }

        .stall_dish {
            /* border: black solid 3px; */
            box-shadow: 0 0 5px #333;
            border-radius: 20px;
            /* padding: 30px 5px 5px 5px; */
            width: 350px;
            height: 150px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: whitesmoke;
        }

        .stall_dish:hover {
            background-color:rgba(211,211,211, 0.5);
        }

        .stall_dish_img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .stall_dish_img img {
            /* border: black solid 3px; */
            margin-top: 2%;
            margin-left: 7%;
            border-radius: 20%;
            /* float: left; */
        }

        .stall_dish_detail {
            border-left: #DADADA solid 2px;
            margin: 0 5%;
            width: 155px;
            height: 125px;
            /* margin-left: 50%; */
            padding: 0px 10px;

            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: start;
        }

        .stall_dish_detail .dish_name {
            font-weight: bold;
            font-size: 1.3em;
        }


        .stall_dish #plus_img {
            margin-right: 5%;
        }

    </style>
</head>
<body>
    <!-- overlay is the sidepanel for navigation links -->
    <?php include '../common/overlay.php' ?>
    <!-- top_header.php is the main navigation bar, nav bars must be placed directly under body tag for position: sticky to work -->
    <?php include '../common/top_header.php'?>
    <?php include 'function_definition.php'?>
    <?php 
    // retrieve stall data from database
        $stall_1 = retrieveStallDetails(1); //For Xing Ji Ruo Cuo Mian
        $stall_2 = retrieveStallDetails(2); //For Sin BBQ
    ?>

    <header>
        <img id="welcome" src="../common/img/welcome_logo.png" alt="Welcome to Bedok 85" width="100%" height="110">
        <img id="bedok85_background" src="../common/img/bedok85_background.jpg" alt="Welcome to Bedok 85" width="700" height="445">
    </header>
    <nav class="stall_link">
            <b>
                <ul>
                    <li><span id="stall_link_xjrcm">Xing Ji Rou Cuo Mian</span></li>
                    <li><span id="stall_link_sbbq">Sin BBQ</span></li>
                    <script type="text/javascript" src="scrollToStallSectionR.js"></script>
                </ul>
            </b>
    </nav>
    <main class="stalls">
        <p><h1 id="main_title">Food Stalls</h1></p>
        <!-- Xing Ji Rou Cuo Mian Stall section here -->
        <section class="stall" id="stall_section_xjrcm">
            <?php 
                echo (isset($stall_1['open_status']))? "<input type='hidden' name='open_status' value='" . $stall_1['open_status'] . "'>":'';
            ?>
            <div class="stall_detail_top">
                <aside class="stall_detail"><h2>Xing Ji Rou Cuo Mian</h2>
                    <dl>
                        <dt>Description:</dt><dd><?php echo $stall_1['description']; ?></dd>
                        <dt>Announcement:</dt><dd><?php echo $stall_1['announcement']; ?></dd>
                        <dt>Opening Hours:</dt><dd><?php echo $stall_1['opening_hour']; ?></dd>
                        <dt>Contact Number:</dt><dd><?php echo $stall_1['contact_no']; ?></dd>
                        <dt>Unit Number:</dt><dd><?php echo $stall_1['unit_no']; ?></dd>
                    </dl>
                </aside>
            <aside class="stall_img"><img src="../common/img/xjrcm_stall1.jpg" alt="Bedok 85" width="900" height="340"></aside>
            </div>
            <section class="stall_dishes">
                <?php
                if (isset($stall_1) && $stall_1['open_status'] == 1) {
                    // stall is opened
                    if (isset($_SESSION['account_id']))
                        echo "<a href='../xjrcm/bcm_small/bcm_small.php'>";
                        else 
                        echo "<a href='../login/login.php'>";
                } else echo '<a>';
                ?>
                    <div class="stall_dish" id="dish_1">
                        <div class="stall_dish_img">
                            <img src="../common/img/bcm.jpg" alt="Bak Chor Mee (Small)" width="100" height="100">
                        </div>
                        <div class="stall_dish_detail">
                            <div class="dish_name">Bak Chor Mee (Small)</div>
                            <div>&bull;&nbsp;Noodle</div>
                            <div>$3.00</div>
                        </div>
                        <img id="plus_img" src="../common/img/plus.png" width="30px" height="30px">
                    </div>
                </a>
                <?php
                if (isset($stall_1) && $stall_1['open_status'] == 1) {
                    // stall is opened
                    if (isset($_SESSION['account_id']))
                        echo "<a href='../xjrcm/bcm_large/bcm_large.php'>";
                        else 
                        echo "<a href='../login/login.php'>";
                } else echo '<a>';
                ?>
                    <div class="stall_dish" id="dish_2">
                        <div class="stall_dish_img">
                            <img src="../common/img/bcm.jpg" alt="Bak Chor Mee (Large)" width="100" height="100">
                        </div>
                        <div class="stall_dish_detail">
                            <div class="dish_name">Bak Chor Mee (Large)</div>
                            <div>&bull;&nbsp;Noodle</div>
                            <div>$4.00</div>
                        </div>
                        <img id="plus_img" src="../common/img/plus.png" width="30px" height="30px">
                    </div>
                </a>
            </section>
            <script type="text/javascript" src="../common/overlayR.js"></script>
        </section>
        <!-- Sin BBQ section here -->
        <section class="stall" id="stall_section_sbbq">
            <?php 
                echo (isset($stall_2['open_status']))? "<input type='hidden' name='open_status' value='" . $stall_2['open_status'] . "'>":'';
            ?>
            <div class="stall_detail_top">
                <aside class="stall_detail"><h2>Sin BBQ</h2>
                    <dl>
                    <dt>Description:</dt><dd><?php echo $stall_2['description']; ?></dd>
                        <dt>Announcement:</dt><dd><?php echo $stall_2['announcement']; ?></dd>
                        <dt>Opening Hours:</dt><dd><?php echo $stall_2['opening_hour']; ?></dd>
                        <dt>Contact Number:</dt><dd><?php echo $stall_2['contact_no']; ?></dd>
                        <dt>Unit Number:</dt><dd><?php echo $stall_2['unit_no']; ?></dd>
                    </dl>
                </aside>
                <aside class="stall_img"><img src="../common/img/sbbq_stall1.jpg" alt="Bedok 85" width="900" height="340"></aside>
            </div>
            <section class="stall_dishes">
                <?php 
                if (isset($stall_2) && $stall_2['open_status'] == 1) {
                    // stall is opened
                    if (isset($_SESSION['account_id']))
                        echo "<a href='../sbbq/bbq_wings/bbq_wings.php'>";
                        else 
                        echo "<a href='../login/login.php'>";
                } else echo '<a>';
                ?>
                    <div class="stall_dish" id="dish_1">
                        <div class="stall_dish_img">
                            <img src="../common/img/bbq_wings.jpg" alt="BBQ Wings" width="100" height="100">
                        </div>
                        <div class="stall_dish_detail">
                            <div class="dish_name">BBQ Wings</div>
                            <div>&bull;&nbsp;Chicken</div>
                            <div>$1.40</div>
                        </div>
                        <img id="plus_img" src="../common/img/plus.png" width="30px" height="30px">
                    </div>
                </a>
                <?php
                if (isset($stall_2) && $stall_2['open_status'] == 1) {
                    // stall is opened
                    if (isset($_SESSION['account_id']))
                        echo "<a href='../sbbq/satay/satay.php'>";
                        else 
                        echo "<a href='../login/login.php'>";
                } else echo '<a>';
                ?>
                    <div class="stall_dish" id="dish_2">
                        <div class="stall_dish_img">
                            <img src="../common/img/satay.jpg" alt="BBQ Satay" width="100" height="100">
                        </div>
                        <div class="stall_dish_detail">
                            <div class="dish_name">Satay</div>
                            <div>&bull;&nbsp;Chicken&nbsp;&bull;&nbsp;Mutton</div>
                            <div>$0.80</div>
                        </div>
                        <img id="plus_img" src="../common/img/plus.png" width="30px" height="30px">
                    </div>
                </a>
            </section>
            <script type="text/javascript" src="../common/overlayR.js"></script>
        </section>
        <script type="text/javascript" src="checkOpenStatusR.js"></script>
    </main>
    <footer>
        <small>
            <i>Copyright &copy; Bedok 85
                <a href="mailto:\\192.168.56.2\f32ee">bedok85@f32ee.com</a>
            </i>
        </small>
    </footer>
</body>
</html>