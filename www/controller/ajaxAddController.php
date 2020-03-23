<?php
require_once('../model/TodoManager.php');
define('CONTENT', 'content');
define('RANKING', 'ranking');
//Sanatize
$options = [
    CONTENT => FILTER_SANITIZE_STRING,
];
$result = filter_input_array(INPUT_POST, $options);
foreach ($result as $key) {
    $result[$key] = trim($result[$key]);
}

//insert

$todoManager = new StephaneLeonard\TODOLIST\Model\TodoManager();
$ranking = (int)$todoManager->getLastRankTodo(0)->fetchAll()[0][RANKING] +1; 
$res =   $todoManager->addTodo(['todo', 'checked' , 'ranking'], [$result[CONTENT], 0 , $ranking]);
if (!$res) {
    echo 'error';
} else {
    $todo = $todoManager->getTodoData($result[CONTENT]);
    if($todo){
        $json = json_encode($todo->fetchAll()); 
        echo $json;
    }
    else{
        echo 'error';
    }
}
