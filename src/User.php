<?php 

final class User {

    private $user_id;
    private $username;
    private $password;
    private $contact_no;
    private $email;
    private $address;
    private $user_type;
    private $credit_card;

    public function __construct($user_id,$username, $password, $contact_no, $email, $address, $user_type, $credit_card) {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->password = $password;
        $this->contact_no = $contact_no;
        $this->email = $email;
        $this->address = $address;
        $this->user_type = $user_type;
        $this->credit_card = $credit_card;
    }


    // Getter methods
    public function getUserId() {
        return $this->user_id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getContactNo() {
        return $this->contact_no;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getUserType() {
        return $this->user_type;
    }

    public function getCreditCard() {
        return $this->credit_card;
    }

    // Setter methods
    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setContactNo($contact_no) {
        $this->contact_no = $contact_no;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setUserType($user_type) {
        $this->user_type = $user_type;
    }

    public function setCreditCard($credit_card) {
        $this->credit_card = $credit_card;
    }

}