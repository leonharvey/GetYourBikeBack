<?php 

class helper {
    
    public static function generateKey($length, $charset = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890') {
        $rtn = null;
        for($i = 0; $i < $length; $i++) $rtn .= $charset{rand(0, $length - 1)};
        
        return $rtn;
    }
    
    public static function POST() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') return true;
    }
    
    public static function addMsg($msg) {
        $_SESSION['msg'] = $msg;
    }
    
    public static function getMsg() {
        if (isset($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
            unset($_SESSION['msg']);
            return $msg;
        }
    }
    
    public static function sendSMS($number, $message) {
        file_get_contents('https://rest.nexmo.com/sms/json?api_key=aaa5c631&api_secret=5b4f2d3e&from=GYBBR&to=353' . $number . '&text=' . urlencode($message));
    
        echo 'https://rest.nexmo.com/sms/json?api_key=aaa5c631&api_secret=5b4f2d3e&from=GYBBR&to=353' . $number . '&text=' . urlencode($message);
    }
}