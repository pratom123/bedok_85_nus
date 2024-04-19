<?php

final class StallRepository {

    private $db; // Assuming you have a database connection

    public function __construct($db) {
        $this->db = $db;
    }

    public function findById($user_id) {
        $query = "SELECT * FROM stall WHERE stall_id = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param('i', $user_id);
        $statement->execute();
        $result = $statement->get_result();
        $stall = $result->fetch_assoc();
        if ($stall) {
            return new User($user['user_id'], $user['username'], $user['password'], $user['contact_no'], $user['email'], $user['address'], $user['user_type']);
        } else {
            return null;
        }
    }


}