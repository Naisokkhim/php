<?php
require_once '../../db_hepler.php';
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$db_task = new db_hepler("localhost", "task_mg", "root", "");
function getTask(){

    try{
        
    $task = $db_task->fetchAll("task");
    
    if($task){
        echo json_encode($task);
    }else{
        echo json_encode(" No Task yet");
    }
}catch(PDOException $e){
    die("Error: " . $e->getMessage());
}
}
function addTask($data){

    try{
        $task = $db_task->insert("task", $data);
        if($task){
            echo json_encode("Task added successfully");
        }else{
            echo json_encode("Task not added");
        }
    }catch(PDOException $e){
        die("Error: " . $e->getMessage());
    }
}


?>