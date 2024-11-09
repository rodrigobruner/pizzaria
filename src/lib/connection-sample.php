<?php
/**
 * Connection class
 * Manage the connection to the database
 * 
 * @autor: Rodrigo Bruner
 */

class Connection {

    // Database settings
    private static $host = '[SERVER]';
    private static $database = '[DATABASE]';
    private static $username = '[USERNAME]';
    private static $password = '[PASSWORD]';

    //Connection
    private static $conn;

    // create or get connection
    public static function getConnection() {
        try{
            if (!isset(self::$conn)) {
                self::$conn = new mysqli(
                    self::$host, 
                    self::$username, 
                    self::$password, 
                    self::$database
                );

                if (self::$conn->connect_error) {
                    die("Connection failed: " . self::$conn->connect_error);
                }
            }

            return self::$conn;
        } catch (Exception $e) {
            die('Caught exception: Databse connection failed, please check your settings or contact the administrator.');
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