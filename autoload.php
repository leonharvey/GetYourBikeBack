<?php
session_start();

define('ROOT', dirname(__FILE__));

define('api_secret', 'g4h3oihjwrgnol5');
define('api_key', 'ERH!£"Dj67*(LO*>OWREG$YK(*LOLDFGQW%£U');

define('db_host', '127.0.0.1');
define('db_name', 'gmbb');
define('db_user', 'leonharvey');
define('db_pass', '');

spl_autoload_register('autoload');

if (!defined('softload')) {
    $security   = new security;
    $controller = new controller;
    $view       = new view($security->token);
}

function autoload($class) {
   require("models/{$class}.class.php"); 
}