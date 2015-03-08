<?php 

class admin extends baseController {
    
    public function index() {
        
    }
    
    public function post() {
        $db = baseController::getDB();
        
        switch ($_POST['request_type']) {
            case 'add_station':
                $db->insert('stations', array(
                    'x_coord' => $_POST['x_coord'],
                    'y_coord' => $_POST['y_coord'],
                    'station_id' => $_POST['station_id']
                ));
                break;
        }
    }
}