<?php
require_once('../model/TodoManager.php');
$json = file_get_contents("php://input");
$data = json_decode($json, true);
$todoManager = new StephaneLeonard\TODOLIST\Model\TodoManager();
$res =   $todoManager->TogleCheckedDatas($data['id'], $data['checked']);
if (!$res) {
    echo 'error';
} else {
    print_r($data);
}
