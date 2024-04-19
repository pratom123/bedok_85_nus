<?php
interface DatabaseInterface {
    public function bind_param($types, ...$params);
    public function prepare();
    public function execute();
    public function get_result();
    public function fetch_assoc();
    

}

class MySQLiWrapper implements DatabaseInterface {
    private $mysqli;

    public function __construct(mysqli $mysqli) {
        $this->mysqli = $mysqli;
    }

    public function bind_param($types, ...$params) {
        return '';
    }

    public function prepare() {
        return true;
    }

    public function execute() {
        return '';
    }

    public function get_result() {
        return '';
    }

    public function fetch_assoc() {
        return '';
    }

    // Other methods as needed
}
