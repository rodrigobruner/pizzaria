<?php
/**
 * Connection class
 * Manage the connection to the database
 * 
 * @autor: Rodrigo Bruner
 */

class Connection {

    // Database settings
    private static $host = 'localhost';
    private static $database = 'pizzaria';
    private static $username = 'root';
    private static $password = 'root';

    //Connection
    private static $conn;

    // create or get connection
    public static function getConnection() {
        try {
            if (!isset(self::$conn)) {
                $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$database;
                self::$conn = new PDO($dsn, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            return self::$conn;
        } catch (PDOException $e) {
            die('Caught exception: Database connection failed, please check your settings or contact the administrator. Error: ' . $e->getMessage());
        }
    }

    // close connection
    public static function closeConnection() {
        if (isset(self::$conn)) {
            self::$conn->close();
        }
    }


    // Prevents the creation of new instances of the class
    public function __clone() {}

    // Prevents the creation of new instances of the class
    public function __wakeup() {}

}

?>