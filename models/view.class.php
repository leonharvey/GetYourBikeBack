<?php

class view {
    
    private $token;
    
    public function __construct($security_token) {
        $this->token = $security_token;
        
        include ROOT . '/views/header.php';
    }   
    
    public function load($view) {
        include ROOT . "/views/{$view}.php";
    }
    
    public function __destruct() {
        include ROOT . '/views/footer.php';
    }
}