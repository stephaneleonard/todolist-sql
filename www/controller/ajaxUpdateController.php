<?php
require_once('../model/TodoManager.php');
$json = file_get_contents("php://input");
$data = json_decode($json, true);
$newRank = htmlspecialchars($data['newRank']);
$oldRank = htmlspecialchars($data['oldRank']);
$checked = htmlspecialchars($data['checked']);
$id = htmlspecialchars($data['id']);
var_dump($id);
$todoManager = new StephaneLeonard\TODOLIST\Model\TodoManager();
$res =   $todoManager->updateRankingDatas($newRank , $oldRank , $checked , $id);
if (!$res) {
    echo 'error';
} else {
    print_r($data);
}
