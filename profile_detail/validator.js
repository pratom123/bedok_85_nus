function hideAllErrorMsg() {


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

	error_msg_element = document.getElementById('e_mail_section').getElementsByClassName('invalid_error_msg_email')[0];
    error_msg_element.style.display = 'none';  //hide error message

	error_msg_element = document.getElementById('phone_section').getElementsByClassName('invalid_error_msg_phoneno')[0];
    error_msg_element.style.display = 'none';  //hide error message


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

    card_name = document.getElementById('card_name');
    
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

function validatePhoneNum() {

    card_num = document.getElementById('phoneno');
    
    reg = /^\d+$/  //numbers with 4 digits, hyphens and spaces in between are valid
    isValid = reg.test(card_num.value);

    if (!isValid) {
        // locate card num error msg element
        error_msg_element = document.getElementById('phone_section').getElementsByClassName('invalid_error_msg_phoneno')[0];
        error_msg_element.style.display = 'block';
        return false;
    }
    return true;
}

function validateEmail() {

    card_num = document.getElementById('email');
    
    reg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/  //numbers with 4 digits, hyphens and spaces in between are valid
    isValid = reg.test(card_num.value);

    if (!isValid) {
        // locate card num error msg element
        error_msg_element = document.getElementById('e_mail_section').getElementsByClassName('invalid_error_msg_email')[0];
        error_msg_element.style.display = 'block';
        return false;
    }
    return true;
}


function validateInput(event) {
    // event.preventDefault();
    hideAllErrorMsg();

	var isEmailValid = validateEmail();
	var isPhoneNumValid = validatePhoneNum();
    var isCardNumValid = validateCardNum();
    var isCardNameValid = validateCardName();
    var isExpiryDateValid = validateExpiryDate();
    var isSecurityCodeValid = validateSecurityCode();

	
	if((document.getElementById('card_num').value) || (document.getElementById('card_name').value) || (document.getElementById('expiry_date').value) || (document.getElementById('security_code').value)) {
		if(!isCardNumValid || !isCardNameValid || !isExpiryDateValid || !isSecurityCodeValid) {
			return false;
		}
	}
	if(document.getElementById('phoneno').value) {
			
			if(!isPhoneNumValid){

        	return false;
		}
	}

	if(document.getElementById('email').value){	
		if(!isEmailValid){

			return false;
		}
	}


	

	

    // if (!isAddressValid) {
    //     console.log('invalidated2');
    //     return false;
    // }
    
    return true;    // if all inputs are valid, submit the form
}

