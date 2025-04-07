<?php
class Database {
    private static $host = 'localhost';
    private static $dbName = 'webprogramming';
    private static $dbPort = 3306;
    private static $username = 'root';
    private static $password = '1234'; 
    private static $connection = null;
    protected $table; 

    public static function connect() {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbName . ";port=" . self::$dbPort, 
                    self::$username, 
                    self::$password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Greška pri povezivanju: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
    

    protected function getConnection() {
        return self::$connection;
    }
}
?>
