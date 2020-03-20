<?php
require_once('../model/TodoManager.php');
define('CONTENT', 'content');
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
$res =   $todoManager->addTodo(['todo', 'checked'], [$result[CONTENT], 0]);
if (!$res) {
    echo 'error';
} else {
    print_r($data);
}
