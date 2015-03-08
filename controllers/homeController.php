<?php
spl_autoload_unregister('autoload');

require(dirname(dirname(__FILE__)) . '/models/twitteroauth/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;

spl_autoload_register('autoload');

class home extends baseController {
    
 
    
    public function __construct() {
        
    }
    public function index() {
        
    }
    
    public function post() {
        $db = self::getDB();
        
        switch ($_POST['request_type']) {
            case 'register_bike':
                $upload_id = md5(uniqid());
                $image_types = array('image/jpeg', 'image/png', 'image/gif');
                
                if($_FILES['image']['size'] < 10240000 && in_array($_FILES['image']['type'], $image_types)) {
                    move_uploaded_file($_FILES['image']['tmp_name'], dirname(dirname(__FILE__)) . '/upload/' . $upload_id . '.jpg');
                    
                    $db->insert('registered_bikes', array(
                        'full_name'    => $_POST['full_name'],
                        'email'        => $_POST['email'],
                        'mobile'       => $_POST['mobile'],
                        'bike_picture' => $upload_id,
                        'bike_status'  => 0,
                        'chip_number'  => $_POST['chip_number'],
                    ));
                    helper::addMsg('Succesfully registered.');
                }
                break;
            case 'report_stolen':
      
                if (validate::reportStolen()) {
                    $current = $db->select('registered_bikes', 'chip_number = ' . $_POST['chip_number'])[0];

                    if ($current['bike_status'] == 0 && !empty($current['bike_picture'])) {
                        $db->update('registered_bikes', array('bike_status' => 1, 'stolen_date' => time()), 'chip_number = ' . $_POST['chip_number']);
                        
                        helper::addMsg('Succesfully reported.');
                        
                        if (!empty($_POST['twitter_share'])) {
                            $connection = new TwitterOAuth(
                                'ltbYbho4XyX3LGppAicEYjw1Z', 
                                'pWYW0Ur5i8Ceix7lZZDVWhwiKQ5TkLUD2o3OWgJmdWGzfSAF2H', 
                                '3078557524-ClYlH5fCyTXGyWv2yisr5XGlMpP81ZjTp3WPSOj', 
                                'w5cotA7kPjvCeqg5gnEoqgUl4aMK8dZSTO1GcveMWhuEl'
                            );
                            $media1 = $connection->upload('media/upload', array('media' => dirname(dirname(__FILE__)) . '/upload/' . $current['bike_picture'] . '.jpg'));

                            $result = $connection->post('statuses/update', array(
                                'status' => 'BIKE MISSING: Private message us or contact your local garda station if found.',
                                'media_ids' => implode(',', array($media1->media_id_string)),
                            ));
                        }
                    } else {
                        helper::addMsg('Bike has already been reported.');
                    }
                }
                break;
        }
    }
}