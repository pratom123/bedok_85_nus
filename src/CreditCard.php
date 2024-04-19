<?php

final class CreditCard {
    private $credit_card_id;
    private $c_user_id;
    private $credit_card_no;
    private $card_name;
    private $cv2;
    private $expiry_date;

    public function __construct($c_user_id, $credit_card_no, $card_name, $cv2, $expiry_date) {
        $this->c_user_id = $c_user_id;
        $this->credit_card_no = $credit_card_no;
        $this->card_name = $card_name;
        $this->cv2 = $cv2;
        $this->expiry_date = $expiry_date;
    }


    // Getter and setter methods for private properties
    
    public function getCreditCardId() {
        return $this->credit_card_id;
    }
    
    public function setCreditCardId($credit_card_id) {
        $this->credit_card_id = $credit_card_id;
    }
    
    public function getCUserId() {
        return $this->c_user_id;
    }
    
    public function setCUserId($c_user_id) {
        $this->c_user_id = $c_user_id;
    }
    
    public function getCreditCardNo() {
        return $this->credit_card_no;
    }
    
    public function setCreditCardNo($credit_card_no) {
        $this->credit_card_no = $credit_card_no;
    }
    
    public function getCardName() {
        return $this->card_name;
    }
    
    public function setCardName($card_name) {
        $this->card_name = $card_name;
    }
    
    public function getCV2() {
        return $this->cv2;
    }
    
    public function setCV2($cv2) {
        $this->cv2 = $cv2;
    }
    
    public function getExpiryDate() {
        return $this->expiry_date;
    }
    
    public function setExpiryDate($expiry_date) {
        $this->expiry_date = $expiry_date;
    }
}