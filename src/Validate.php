<?php 

final class Validate {

    public static function validateCardNum($card_num) {
        $reg = '/^[0-9]{4}[- ]?[0-9]{4}[- ]?[0-9]{4}[- ]?[0-9]{4}$/'; // numbers with 4 digits, hyphens, and spaces in between are valid
        $isValid = preg_match($reg, $card_num);
        
        if (!$isValid) {
            // Error message
            return false;
        }
        return true;
    }

    public static function validateCardName($card_name) {
        $reg = '/^(([a-zA-Z] )|([a-zA-Z]))+[a-zA-Z]+$/'; // Only Alphabets with spaces in between allowed
        $isValid = preg_match($reg, $card_name);

        return $isValid;
    }

    

}
