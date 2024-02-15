function hideAllErrorMsg() {
    // hide address text error msgs
    var address_radio = document.getElementsByClassName('address_radio');
    for(var i=0; i<address_radio.length;i++) {
        document.getElementsByClassName('address_text')[i].parentElement.nextElementSibling.style.display = 'none'; //Hide error messages
    }

    //hide card number error message
    error_msg_element = document.getElementById('card_num_section').getElementsByClassName('invalid_error_msg')[0];
    error_msg_element.style.display = 'none';

    //hide card name error message
    error_msg_element = document.getElementById('card_name_section').getElementsByClassName('invalid_error_msg')[0];
    error_msg_element.style.display = 'none';  //hide error message

    // hide expiry date error message
    error_msg_element = document.getElementById('expiry_section').getElementsByClassName('invalid_error_msg')[0];
    error_msg_element.style.display = 'none';  //hide error message

    // hide security code error message
    error_msg_element = document.getElementById('security_section').getElementsByClassName('invalid_error_msg')[0];
    error_msg_element.style.display = 'none';  //hide error message
}

function toggleAddressSection(event) {

    radio_clicked = event.currentTarget;

    var inputs = document.getElementById('address_section').getElementsByTagName('input');

    console.log(radio_clicked.value);
    if (radio_clicked.id == 'self_pickup') {
        for(var i=0; i<inputs.length;i++) {
            // disable each inputs in address section
            inputs[i].disabled = true;
        }
    } else if (radio_clicked.id == 'delivery') {
        // enable each inputs in address section
        for(var i=0; i<inputs.length;i++) {
            // enable each inputs in address section
            inputs[i].disabled = false;
        }
    }
}

function validateAddress() {
    var address_radio = document.getElementsByClassName('address_radio');

    console.log(address_radio);

    var isAddressRadioChecked = false;  // flag to check if a radio button is selected

    for(var i=0; i<address_radio.length;i++) {
        // check which radio button is checked
        if (address_radio[i].checked) {
            isAddressRadioChecked = true;
            //get the address text box corresponding to the radio checked
            var address_text = document.getElementsByClassName('address_text')[i];
            address_radio[i].value = address_text.value;    //set the checked radio button value to the address text, so that address value can be sent to php
            console.log(address_text);
        }
    }

    if (!isAddressRadioChecked) {
        // address radio button not selected
        error_msg_element = document.getElementById('address_1_error_msg');
        error_msg_element.innerHTML = 'Please select an address!';
        error_msg_element.style.display = 'block';  //Show error message
        return false;
    }

    // Check if address text is empty
    if (address_text.value == '') {
        // locate the error msg element relative to the address_text node
        error_msg_element = address_text.parentElement.nextElementSibling;
        error_msg_element.innerHTML = 'Address selected is empty!';
        error_msg_element.style.display = 'block';  //Show error message
        console.log('aksndasnakn');
        return false;
    }

    // validate the address
    reg = /^[a-zA-Z0-9\#\,\- ]+$/;
    isValid = reg.test(address_text.value);
    console.log(isValid);
    if(!isValid) {
        error_msg_element = address_text.parentElement.nextElementSibling;
        error_msg_element.innerHTML = 'words, numbers, \'#\' only! ';
        error_msg_element.style.display = 'block';
        return false;
    }

    // Validation passed

    return true;
}

function validateCardNum() {

    card_num = document.getElementById('card_num');
    
    reg = /^[0-9]{4}[- ]?[0-9]{4}[- ]?[0-9]{4}[- ]?[0-9]{4}$/  //numbers with 4 digits, hyphens and spaces in between are valid
    isValid = reg.test(card_num.value);

    if (!isValid) {
        // locate card num error msg element
        error_msg_element = document.getElementById('card_num_section').getElementsByClassName('invalid_error_msg')[0];
        error_msg_element.style.display = 'block';
        return false;
    }
    return true;
}

function validateCardName() {

    card_num = document.getElementById('card_name');
    
    reg = /^(([a-zA-Z] )|([a-zA-Z]))+[a-zA-Z]+$/  //Only Alphabets with spaces in between allowed
    isValid = reg.test(card_name.value);

    // locate card name error msg element
    error_msg_element = document.getElementById('card_name_section').getElementsByClassName('invalid_error_msg')[0];
    if (!isValid) {
        error_msg_element.style.display = 'block';
        return false;
    }
    return true;
}

function validateExpiryDate() {
    console.log(error_msg_element);

    // locate card num error msg element
    error_msg_element = document.getElementById('expiry_section').getElementsByClassName('invalid_error_msg')[0];
    reg = /^[\d]{2}\/[\d]{2}$/  //2 digits, then '/', then 2 digits
    isValid = reg.test(expiry_date.value);

    if (!isValid) {
        error_msg_element.style.display = 'block';
        return false;
    }
    return true;
}

function validateSecurityCode() {
    console.log(error_msg_element);

    security_code = document.getElementById('security_code');
    reg = /^[\d]{3}$/  // Must have exactly 3 digits
    isValid = reg.test(security_code.value);

    // locate card num error msg element
    error_msg_element = document.getElementById('security_section').getElementsByClassName('invalid_error_msg')[0];
    if (!isValid) {
        error_msg_element.style.display = 'block';
        return false;
    }
    return true;
}


function validateInput(event) {
    // event.preventDefault();

    hideAllErrorMsg();

    var isCardNumValid = validateCardNum();
    var isCardNameValid = validateCardName();
    var isExpiryDateValid = validateExpiryDate();
    var isSecurityCodeValid = validateSecurityCode();

    if(!isCardNumValid || !isCardNameValid || !isExpiryDateValid || !isSecurityCodeValid) {
        console.log('invalidated');
        return false;
    }

    if(document.getElementById('delivery').checked) {
        console.log('tst');
        // delivery radio button is checked, meaning address section is enabled.
        var isAddressValid = validateAddress();  //Check which address radio is selected and validate its corresponding address text
        return isAddressValid;
    }

    // if (!isAddressValid) {
    //     console.log('invalidated2');
    //     return false;
    // }
    
    return true;    // if all inputs are valid, submit the form
}