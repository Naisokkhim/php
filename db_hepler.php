<?php
require_once 'db_conn.php';

class db_hepler extends db_conn {
    public function __construct($host, $dbname, $user, $pass) {
        parent::__construct($host, $dbname, $user, $pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // ✅ Set error mode
    }
    public function fetchAll($table) {
        try {
            $stmt = $this->conn->query("SELECT * FROM $table");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }

    public function insert($table, $data) {
        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));
            $stmt = $this->conn->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
            return $stmt->execute($data);
        } catch (PDOException $e) {
            $this->logError($e->getMessage());
            return false;
        }
    }

    public function logError($message) {
        try {
            $error_db = new db_hepler('localhost', 'errorlog', 'root', '');
            $error_db->insert('errorstatment', ['message' => $message, 'dateTime' => date('Y-m-d H:i:s')]);
        } catch (PDOException $e) {
            error_log("Error logging failed: " . $e->getMessage());
        }
    }
}
?>
