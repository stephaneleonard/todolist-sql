<?php

namespace StephaneLeonard\TODOLIST\Model;

define('TODO', 'todos');
define('RANKING', 'ranking');


require_once 'Manager.php';

class TodoManager extends Manager
{

    public function getTodoDatas($variable = [], $condition  = [], $orderBy = null, $asc = null, $limit = null)
    {
        return parent::getDatas(TODO, $variable, $condition, $orderBy, $asc, $limit);
    }

    public function getTodoData($todo, $orderBy = null, $asc = null, $limit = null)
    {
        return parent::getDatas(TODO, [], ["todo = '$todo'"], null, null, null);
    }

    public function getUncheckedTodoDatas($variable = [], $limit = null)
    {
        return parent::getDatas(TODO, $variable, ["checked = 0"], RANKING, ' ASC', $limit);
    }

    public function getCheckedTodoDatas($variable = [], $limit = null)
    {
        return parent::getDatas(TODO, $variable, ["checked = 1"], RANKING, ' ASC', $limit);
    }

    public function updateTodoDatas($param = [], $value  = [], $condition  = [])
    {
        return parent::updateDatas(TODO, $param, $value, $condition);
    }

    public function TogleCheckedDatas($id, $value)
    {
        $ranking = (int) $this->getLastRankTodo($value)->fetchAll()[0][RANKING] + 1;
        return parent::updateDatas(TODO, ["checked" , "ranking"], [$value , $ranking], ["id = $id"]);
    }

    public function addTodo($param = [], $value  = [])
    {
        return parent::setDatas(TODO, $param, $value);
    }

    public function getLastRankTodo($checked)
    {
        return parent::getDatas(TODO, [RANKING], ["checked = $checked"], RANKING, ' DESC', 1);
    }
}
