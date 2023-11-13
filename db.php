<?php
class Database {
    private $host = 'localhost';
    private $username = 'ren';
    private $password = '122846';
    private $database = 'school_db';
    private $conn;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database}";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }


    public function getConnection() {
        // echo 'Connected';
        return $this->conn;
    }
}


?>