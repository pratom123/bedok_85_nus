<?php

require('CreditCard.php');

final class UserRepository {
    private $db; // Assuming you have a database connection

    public function __construct($db) {
        $this->db = $db;
    }

    public function findById($user_id) {
        $query = "SELECT * from user
        INNER JOIN credit_card
        WHERE user_id = ? 
        AND c_user_id = user_id" ;
        $statement = $this->db->prepare($query);
        $statement->bind_param('i', $user_id);
        $statement->execute();
        $result = $statement->get_result();
        $user = $result->fetch_assoc();
        if ($user) {
            return new User($user['user_id'], $user['username'], $user['password'], $user['contact_no'], $user['email'], $user['address'], $user['user_type'], $user['credit_card'] = new CreditCard($user['c_user_id'],$user['credit_card_no'],$user['card_name'],$user['cv2'],$user['expiry_date']));
        } else {
            return null;
        }
    }

    public function findByUsername($username) {
        $query = "SELECT * from user
        INNER JOIN credit_card
        WHERE username = ? 
        AND c_user_id = user_id" ;
        $statement = $this->db->prepare($query);
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result();
        $user = $result->fetch_assoc();
        if ($user) {
            return new User($user['user_id'], $user['username'], $user['password'], $user['contact_no'], $user['email'], $user['address'], $user['user_type'], $user['credit_card'] = new CreditCard($user['c_user_id'],$user['credit_card_no'],$user['card_name'],$user['cv2'],$user['expiry_date']));
        } else {
            return null;
        }
    }

    public function save(User $user) {
        if ($user->getUserId()) {
            // Update existing user
            $query = "UPDATE user SET ";
            $setValues = [];
            if ($user->getUsername()) {
                $setValues[] = "username = '" . $user->getUsername() . "'";
            }
            if ($user->getPassword()) {
                $setValues[] = "password = '" . $user->getPassword() . "'";
            }            
            if ($user->getContactNo()) {
                $setValues[] = "contact_no = '" . $user->getContactNo() . "'";
            }
            if ($user->getEmail()) {
                $setValues[] = "email = '" .  $user->getEmail() . "'";
            }
            if ($user->getAddress()) {
                $setValues[] = "address = '" . $user->getAddress() . "'";
            }
            if ($user->getUserType()) {
                $setValues[] = "user_type = '" . $user->getUserType() . "'";
            }
            $query .= implode(", ", $setValues) . " WHERE user_id = " . $user->getUserId();
            $statement = $this->db->prepare($query);
            $statement->execute();
        }

        // need to update credit card info



        // if ($user->getId()) {
        //     // Update existing user
        //     $query = "UPDATE user SET username = ?, password = ?, contact_no = ?, email = ?, address = ?, user_type = ? WHERE user_id = ?";
        // } else {
        //     // Insert new user
        //     $query = "INSERT INTO user (username, password, contact_no, email, address, user_type) VALUES (?, ?, ?, ?, ?, ?)";
        // }
        // $statement = $this->db->prepare($query);
        // $statement->bind_param('ssisssi', $usr->getUsername(), $user->getPassword(), $user->getContactNo(), $user->getEmail(), $user->getAddress(), $user->getUserType(), $user->getId());
        // $statement->execute();
        // if (!$user->getId()) {
        //     $user->setId($this->db->insert_id);
        // }
    }

    public function delete($user_id) {
        $query = "DELETE FROM user WHERE user_id = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param('i', $user_id);
        $statement->execute();
    }
}
