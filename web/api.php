<?php
define('softload', true);
require('autoload.php');

if (isset($_POST['api_key']) && $_POST['api_key'] == 'test') {
    if (validate::api()) {
        $db = baseController::getDB();
        $station = $db->select('stations', 'station_id = ' . $_POST['sensor_id'])[0];
        
        if (!empty($station['cctv_feed'])) {
            $image_id = md5(uniqid());
            file_put_contents('snaps/' . $image_id . '.jpg', file_get_contents($station['cctv_feed']));
        } 
        
        $x_coord = $_POST['x_coord'];
        $y_coord = $_POST['y_coord'];
            
        $db->insert('logs', array(
            'chip_number'   => $_POST['chip_number'],
            'sensor_id'     => $_POST['sensor_id'],
            'gps_location'  => $x_coord . '|' . $y_coord,
            'timestamp'     => time(),
            'log_type'      => $_POST['type'],
            'cctv_snap'     => empty($image_id) ?: $image_id
        ));
        
        if (!isset($_POST['disable_notification'])) {
            $bike = $db->select('registered_bikes', 'chip_number = ' . $_POST['chip_number']);
            
            $name = explode(' ', $bike[0]['full_name'])[0];
        
            
            $phone_number = $db->run("SELECT phone_number FROM garda_stations ORDER BY ABS('{$x_coord}'-x_coords) + ABS('{$y_coord}'-y_coords) LIMIT 1")[0]['phone_number'];
            $message      = "Hey {$name}, just letting you know your bike has been moved.\r\nIf this wasn't you, call the number below to contact the closest garda station.\r\n{$phone_number}\r\nThanks\r\nThe GYBB team.";

            //helper::sendSMS($bike[0]['mobile'], $message);
            mail($bike['email'], 'Your bike has been moved', $message);
        }
    } 
}
