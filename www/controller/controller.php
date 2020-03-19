<?php

require_once('model/TodoManager.php');

function getTodoPage(){
    $res = displayTodo();
    if(!$res){
        throw new UnexpectedValueException('unable to get data from database');
    }
    require 'view/todoView.php';
}

function displayTodo(){
    $todoManager = new StephaneLeonard\TODOLIST\Model\TodoManager();
    return  $todoManager->getTodoDatas();
}