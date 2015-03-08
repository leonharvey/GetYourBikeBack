<?php
//Validation Rules

class validate {
    
    public static function reportStolen() {
        return true;
    }
    
    public static function api() {
        if (isset($_POST['type']) && isset($_POST['gps_location']) && isset($_POST['sensor_id']) && isset($_POST['chip_number'])) {
            if (ctype_digit($_POST['chip_number']) && in_array($_POST['type'], array('check_in', 'check_out'))) {
                return true;
            }
        }
    }
}