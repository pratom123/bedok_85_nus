// Registering add-on checkboxes
add_on_checkboxes = document.getElementsByClassName('add_on_checkboxes');
for (var i=0;i<add_on_checkboxes.length;i++)
    add_on_checkboxes[i].addEventListener("click", updatePrice);

//Registering quantity buttons
document.getElementsByClassName('qty_btn')[0].addEventListener("click", updatePrice);
document.getElementsByClassName('qty_btn')[1].addEventListener("click", updatePrice);

// Resgistering submit button
document.getElementById("add_update_item").onsubmit = validateInput;



