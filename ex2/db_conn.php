<?php

class db_conn {
    protected $conn;

    public function __construct($host, $dbname, $username, $password) {
        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4"; // ✅ Set UTF-8 charset
            $this->conn = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // ✅ Throw exceptions on errors
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // ✅ Fetch results as associative arrays
                PDO::ATTR_EMULATE_PREPARES => false // ✅ Use real prepared statements for security
            ]);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage()); // ✅ Allow error handling elsewhere
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
