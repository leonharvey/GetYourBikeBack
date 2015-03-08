<?php
define('softload', true);
require('autoload.php');

if (isset($_POST['api_key']) && $_POST['api_key'] == 'test') {
    if (validate::api()) {
        $db = baseController::getDB();
        $db->insert('logs', array(
            'chip_number'   => $_POST['chip_number'],
            'sensor_id'     => $_POST['sensor_id'],
            'gps_location'  => $_POST['gps_location'],
            'timestamp'     => time(),
            'log_type'      => $_POST['type'],
        ));
        
        if (!isset($_POST['disable_notification'])) {
            $bike = $db->select('registered_bikes', 'chip_number = ' . $_POST['chip_number'])[0];
            $name = explode(' ', $bike['full_name'])[0];
            
            $phone_number = $db->run("SELECT phone_number FROM garda_stations ORDER BY ABS('{$x_coord}'-x_coords) + ABS('{$y_coord}'-y_coords) LIMIT 1")[0]['phone_number'];
            $message      = "Hey {$name}, just letting you know your bike has been moved.\r\nIf this wasn't you, call the number below to contact the closest garda station.\r\n{$phone_number}\r\nThanks\r\nThe GYBB team.";

            helper::sendSMS($bike['mobile'], $message);
            mail($bike['email'], 'Your bike has been moved', $message);
        }
    } 
}