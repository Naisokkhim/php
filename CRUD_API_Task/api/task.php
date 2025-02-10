<?php
require_once '../../ex2/db_hepler.php';

// Set headers
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Initialize database connection
$db_task = new db_hepler("localhost", "task_mg", "root", "");

// Handle GET request
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    getTask($db_task);
}

// Handle POST request (Add Task)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    addTask($db_task, $data);
}

// Function to fetch tasks
function getTask($db_task) {
    try {
        $task = $db_task->fetchAll("task");

        if ($task) {
            echo json_encode($task);
        } else {
            echo json_encode(["message" => "No Task yet"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}

// Function to add a task
function addTask($db_task, $data) {
    try {
        $task = $db_task->insert("task", $data);

        if ($task) {
            echo json_encode(["message" => "Task added successfully"]);
        } else {
            echo json_encode(["error" => "Task not added"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}
?>
