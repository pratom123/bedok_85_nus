<?php 

final class Stall {

    private $stall_id;
    private $stall_name;
    private $unit_no;
    private $open_status;
    private $announcement;
    private $description;
    private $opening_hour_start;
    private $opening_hour_end;
    

    // Getter methods
    public function getStallId() {
        return $this->stall_id;
    }

    public function getStallName() {
        return $this->stall_name;
    }

    public function getUnitNo() {
        return $this->unit_no;
    }

    public function getOpenStatus() {
        return $this->open_status;
    }

    public function getAnnouncement() {
        return $this->announcement;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getOpeningHourStart() {
        return $this->opening_hour_start;
    }

    public function getOpeningHourEnd() {
        return $this->opening_hour_end;
    }

    // Setter methods
    public function setStallName($stall_name) {
        $this->stall_name = $stall_name;
    }

    public function setUnitNo($unit_no) {
        $this->unit_no = $unit_no;
    }

    public function setOpenStatus($open_status) {
        $this->open_status = $open_status;
    }

    public function setAnnouncement($announcement) {
        $this->announcement = $announcement;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setOpeningHourStart($opening_hour_start) {
        $this->opening_hour_start = $opening_hour_start;
    }

    public function setOpeningHourEnd($opening_hour_end) {
        $this->opening_hour_end = $opening_hour_end;
    }
}