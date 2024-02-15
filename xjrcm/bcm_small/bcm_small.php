<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Bedok 85</title>
    <meta charset='utf-8'>
    <link rel='stylesheet' href='../../common/externalCSS.css'>
    <link rel='stylesheet' href='../../common/overlay.css'>
    <link rel='stylesheet' href='../../common/dish_pref.css'>
    <script type='text/javascript' src='../../common/overlay.js'></script>
    <script type='text/javascript' src='event_listener.js'></script>
    <style>
    </style>
</head>
<body>
    <?php include '../../common/check_login.php' ?>
    <!-- overlay is the sidepanel for navigation links -->
    <?php include '../../common/overlay.php' ?>
    <?php include '../../common/top_header.php' ?>
    
    <div class='path_directory'>
        <!-- path directory -->
    <a href='../../home/index.php'>Home</a>&nbsp;&rarr;&nbsp;Xing Ji Rou Cuo Mian&nbsp;&rarr;&nbsp;<a href=''>Bak Chor Mee (Small)</a>
    </div>
    <main>
        <div id='dish_wrapper'>
            <!-- both add item and update item will be sent to process cart.php -->
            <form action='../../common/process_cart.php' method='GET' id='add_update_item'>
                <?php 
                $img_name = 'bcm.jpg';

                if(isset($_GET["purpose"]) && $_GET["purpose"] == "update_item") {
                    //GET requested from cart to update item
                    $cart = $_SESSION['cart'];
                    $i = $_GET['cart_item_index_to_be_updated'];
                    // var_dump($cart[$i]);
                    echo "
                    <input type='hidden' name='purpose' value='update_item'>
                    <input type='hidden' name='cart_item_index_to_be_updated' value='" . $i . "'>";
                } else {
                    // adding item into cart
                    echo "
                    <input type='hidden' name='purpose' value='add_item'>
                    "; 
                }
                ?>

                    <input type='hidden' name='item_stall_id' value='1'>
                    <input type='hidden' name='item_stall_name' value='Xing Ji Rou Cuo Mian'>
                    <input type='hidden' name='item_dish_name' value='Bak Chor Mee (Small)'>
                    <input type='hidden' name='item_dish_id' value='1'>
                    <input type='hidden' name='item_dish_img_name' value='<?php echo $img_name ?>'>

                <header>
                    <div class='dish_img'>
                        <img src='../../common/img/<?php echo $img_name ?>' width='100' height='100'>
                    </div>
                    <aside>
                        <div class='stall_name'>Xing Ji Rou Cuo Mian</div>
                        <div class='row_start_end'>
                            <span class='dish_name'>Bak Chor Mee (Small)</span>
                            <div class='dish_price'>
                            <span>$</span>
                            <span id='base_price'>3.00</span>
                            </div>
                        </div>
                    </aside>
                </header>
                <main>
                    <!-- dish preferences are here -->
                    <!-- The echoes here by php are made to auto-fill the inputs -->
                    <section class='dish_pref'>
                        <div class='dish_pref_label'>Type of Noodle</div>
                        <div class='dish_pref_input'>
                        <p><label id='radio_1'><input type='radio' class='radios' name='item_pref[noodle_type]' id='radio_1' value='Mee Kia' <?php 
                        echo (isset($i) && $cart[$i]['item_pref']['noodle_type'] == 'Mee Kia')? 'checked': '';?>><span class="input_label">&nbsp;Mee Kia</span></label></p>
                        <p><label id='radio_2'><input type='radio' class='radios' name='item_pref[noodle_type]' id='radio_2' value='Mee Pok' <?php 
                        echo (isset($i) && $cart[$i]['item_pref']['noodle_type'] == 'Mee Pok')? 'checked': '';?>><span class="input_label">&nbsp;Mee Pok</span></label></p>
                        <p class='invalid_input_msg'>Please select a noodle type!</p>
                        </div>
                    </section>
                    <section class='dish_pref'>
                        <div class='dish_pref_label'>Dry/Soup</div>
                        <div class='dish_pref_input'>
                        <p><label id='radio_3'><input type='radio' class='radios' name='item_pref[dry_soup]' id='radio_3' value='Dry' <?php 
                        echo (isset($i) && $cart[$i]['item_pref']['dry_soup'] == 'Dry')? 'checked': '';?>><span class="input_label">&nbsp;Dry</span></label></p>
                        <p><label id='radio_4'><input type='radio' class='radios' name='item_pref[dry_soup]' id='radio_4' value='Soup' <?php 
                        echo (isset($i) && $cart[$i]['item_pref']['dry_soup'] == 'Soup')? 'checked': '';?>><span class="input_label">&nbsp;Soup</span></label></p>
                        <p class='invalid_input_msg'>Please select Dry or Soup!</p>
                        </div>
                    </section>
                    <section class='dish_pref'>
                        <div class='dish_pref_label'>Add-ons</div>
                        <div class='dish_pref_input'>
                            <div class='row_start_end'>
                                <span>
                                    <input type='checkbox' class='add_on_checkboxes' id='checkbox_1' name='item_pref[add_on][]' value='Add Mee Pok' <?php
                                        //Additional check: checks if the string is in the add on array. If it is, mark as checked
                                    echo (isset($i) && isset($cart[$i]['item_pref']['add_on']) && in_array('Add Mee Pok', $cart[$i]['item_pref']['add_on']))? 'checked': '';?>>
                                    <label for='checkbox_1'><span class="input_label">&nbsp;Add Mee Pok</span></label>
                                </span>
                                <div>
                                    <span>$</span>
                                    <span>0.50</span>
                                </div>
                            </div>
                            <div class='row_start_end'>
                                <span>
                                    <input type='checkbox' class='add_on_checkboxes' id='checkbox_2' name='item_pref[add_on][]'  value='Add Mee Kia' <?php
                                    echo (isset($i) && isset($cart[$i]['item_pref']['add_on']) && in_array('Add Mee Kia', $cart[$i]['item_pref']['add_on']))? 'checked': '';?>>
                                    <label for='checkbox_2'><span class="input_label">&nbsp;Add Mee Kia</span></label>
                                </span>
                                <div>
                                    <span>$</span>
                                    <span>0.50</span>
                                </div>
                            </div>
                            <div class='row_start_end'>
                                <span>
                                    <input type='checkbox' class='add_on_checkboxes' id='checkbox_3' name='item_pref[add_on][]' value='Add Meat' <?php
                                    echo (isset($i) && isset($cart[$i]['item_pref']['add_on']) && in_array('Add Meat', $cart[$i]['item_pref']['add_on']))? 'checked': '';?>>
                                    <label for='checkbox_3'><span class="input_label">&nbsp;Add Meat</span></label>
                                </span>
                                <div>
                                    <span>$</span>
                                    <span>1.00</span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class='dish_pref'>
                        <div class='dish_pref_label'>Special instructions</div>
                        <div class='dish_pref_input'>
                        <textarea rows='4' cols='30' placeholder='E.g. Less salt' name='item_pref[si]' maxlength='100'><?php 
                                    echo (isset($i) && !empty($cart[$i]['item_pref']['si']))? $cart[$i]['item_pref']['si']: '';?></textarea>
                        <p class='invalid_input_msg'>Only alphanumeric characters!</p>
                        </div>
                    </section>
                </main>
                <footer class='row_start_end'>
                    <div id='qty_wrapper'>
                        <span class='qty_btn'>-</span>
                        <input type='text' id='qty_display' name='item_qty' value='<?php 
                                    echo (isset($i) && !empty($cart[$i]['item_qty']))? $cart[$i]['item_qty']: '1';?>' onfocus='blur()'/>
                        <span class='qty_btn'>+</span>
                    </div>
                    <div id='price_submit_wrapper'>
                        <div>
                            <strong>Total Price ($):</strong>
                            <input type='text' id='price_display' name='item_price' onfocus='blur()' value='<?php 
                                    echo (isset($i) && !empty($cart[$i]['item_price']))? $cart[$i]['item_price']: '3.00';?>'>
                        </div>
                        <input id='submit' type='submit' value='<?php echo (isset($_GET['purpose']) && $_GET['purpose'] == 'update_item')? 'Update basket':'Add to basket'; ?>'>
                    </div>
                </footer>
                
                <script type='text/javascript' src='event_listenerR.js'></script>
            </form>
        </div>
    </main>
    <footer>
        <small>
            <i>Copyright &copy; Bedok 85
                <a href='mailto:\\192.168.56.2\f32ee'>bedok85@f32ee.com</a>
            </i>
        </small>
    </footer>
</body>
</html>