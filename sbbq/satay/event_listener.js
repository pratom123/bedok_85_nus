// function calculateSumOfAddOnCost() {
//     add_on_checkboxes = document.getElementsByClassName('add_on_checkboxes');

//     var sum_of_add_on_cost = 0;
//     for (var i=0;i<add_on_checkboxes.length;i++) {
//         if (add_on_checkboxes[i].checked) {
//             // get add on cost
//             add_on_cost_string = add_on_checkboxes[i].parentElement.nextElementSibling.children[1].innerHTML;
//             add_on_cost = parseFloat(add_on_cost_string);
//             sum_of_add_on_cost += add_on_cost;
//         }
//     }
//     return sum_of_add_on_cost;
// }

function calculatePrice() {
    base_price = parseFloat(document.getElementById('base_price').innerHTML);
    // sum_of_add_on_cost = calculateSumOfAddOnCost();
    qty = parseInt(document.getElementById('qty_display').value);

    console.log("base_price: ", base_price);
    // console.log("sum_of_add_on_cost: ", sum_of_add_on_cost);
    console.log("qty: ", qty);

    return base_price*qty;
}

function updatePrice(event) {
    input_clicked = event.currentTarget;
    console.log(input_clicked);

    price_display = document.getElementById('price_display');
    current_qty = parseInt(qty_display.value);
    qty_display = document.getElementById("qty_display");
    current_price = parseFloat(price_display.value);

    if (input_clicked.type == "checkbox") {
        console.log("checkbox selected");

    } else {
        console.log("quantity button selected");

        // update quantity display
        if (input_clicked.innerHTML == "-") {
            //  minus button clicked
            if (current_qty >= 2) {
                // minus current quantity
                updated_qty = current_qty - 1;
            }
        } else {
            // plus button clicked, add current quantity
             updated_qty = current_qty + 1;
        }
        // update qty display value
        qty_display.value = updated_qty;
    }

    recalculated_price = calculatePrice();

    price_display.value = recalculated_price.toFixed(2);
}

function validateInput(event) {

    console.log("Form submission detected, validating form...");
    radios = document.getElementsByClassName("radios");

    // check if a radio is checked in noodle type preference
    if(!radios[0].checked && !radios[1].checked) {
        // display noodle type preference error message
        document.getElementsByClassName("dish_pref")[0]
            .getElementsByClassName("invalid_input_msg")[0]
                .style.display = "block";
                
        window.scrollTo(0,0); //scroll to top of page
        return false;   //stop form submission
    } else {
        // hide noodle type preference error message
        document.getElementsByClassName("dish_pref")[0]
        .getElementsByClassName("invalid_input_msg")[0]
            .style.display = "none";
    }

    // check if a radio is checked in noodle type preference
    if(!radios[2].checked && !radios[3].checked) {
        // display dry/soup preference error message
        document.getElementsByClassName("dish_pref")[1]
        .getElementsByClassName("invalid_input_msg")[0]
            .style.display = "block";

        window.scrollTo(0,0); //scroll to top of page
        return false;    //stop form submission
    } else {
        // hide dry/soup preference error message
        document.getElementsByClassName("dish_pref")[1]
        .getElementsByClassName("invalid_input_msg")[0]
            .style.display = "none";
    }

    return true;    //submit form
        
}