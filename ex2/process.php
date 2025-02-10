<?php
require_once 'db_hepler.php';

$user_db = new db_hepler('localhost', 'user', 'root', '');
$error_db = new db_hepler('localhost', 'errorlog', 'root', '');

$name = $_POST['name'] ?? '';
$sex = $_POST['sex'] ?? '';

try {
    
    $user_db->insert('custome', ['name' => $name, 'sex' => $sex]);  
    echo "User inserted successfully!";
} catch (Exception $e) {
    $error_db->logError($e->getMessage());
    echo "Oops! Something went wrong. Please try again.";
}
?>
