<?php
require_once 'db_hepler.php';

$error_db = new db_hepler('localhost', 'errorlog', 'root', '');
$errors = $error_db->fetchAll('errorstatment');

echo "<h2>Error Log</h2>";
echo "<pre>";
print_r($errors);
echo "</pre>";
?>
