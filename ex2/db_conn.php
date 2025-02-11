<?php

class db_conn {
    protected $conn;

    public function __construct($host, $dbname, $username, $password) {
        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4"; 
            $this->conn = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
                PDO::ATTR_EMULATE_PREPARES => false 
            ]);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage()); 
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
