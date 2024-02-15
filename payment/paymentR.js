// Registering collection radio buttons
var collection_radios = document.getElementsByClassName('collection_radio');
collection_radios[0].addEventListener('click', toggleAddressSection);
collection_radios[1].addEventListener('click', toggleAddressSection);

// Registering form
var order_btn = document.getElementById('to_payment');
order_btn.onsubmit = validateInput;