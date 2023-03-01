<?php

Class Blog_Database {
    
    private static $dsn = 'mysql:host=localhost;dbname=blog';
    private static $username = 'mgs_user';
    private static $password = 'pa55word';
    private static $db;

    private function __contruct() {
        
    }

    public static function getDB() {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$username, self::$password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                exit();
            }
        }
        return self::$db;
    }
  
}
