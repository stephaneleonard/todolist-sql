<?php

require_once('model/TodoManager.php');

function getTodoPage(){
    $arr = displayTodo();
    $unchecked = $arr[0];
    $checked = $arr[1];
    if(!$unchecked || !$checked){
        throw new UnexpectedValueException('unable to get data from database');
    }
    require 'view/todoView.php';
}

function displayTodo(){
    $todoManager = new StephaneLeonard\TODOLIST\Model\TodoManager();
    $unchecked =   $todoManager->getUncheckedTodoDatas();
    $checked =   $todoManager->getCheckedTodoDatas();
    return [$unchecked , $checked];
}