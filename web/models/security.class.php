<?php 

class security {
    
    public $token;
    
    public function __construct() {
        $this->initiateToken();
        
        if (helper::POST()) $this->validateToken();
    }
        
    private function initiateToken() {
        if (!isset($_SESSION['token'])) $_SESSION['token'] = helper::generateKey(35);
        
        $this->token = $_SESSION['token'];
    }
    
    private function validateToken() {
        if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token'])
            die('Token mismatch');
    }
    
    private function getAPIkey() {
        return md5(md5(api_key . time()) . api_secret);
    }
}