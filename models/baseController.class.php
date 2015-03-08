<?php

class baseController {
    
    public static function getDB() {
       return new db('mysql:host=' . db_host . ';dbname=' . db_name, db_user, db_pass);
    }
}