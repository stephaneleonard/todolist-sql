<?php

namespace StephaneLeonard\TODOLIST\Model;

define('TODO', 'todos');

require_once 'Manager.php';

class TodoManager extends Manager
{

    public function getTodoDatas($variable = [], $condition  = [], $orderBy = null, $asc = null, $limit = null)
    {
        return parent::getDatas(TODO, $variable, $condition, $orderBy, $asc, $limit);
    }

    public function getUncheckedTodoDatas($variable = [], $condition  = [], $orderBy = null, $asc = null, $limit = null)
    {
        return parent::getDatas(TODO, $variable, ["checked = 0"], $orderBy, $asc, $limit);
    }

    public function getCheckedTodoDatas($variable = [], $condition  = [], $orderBy = null, $asc = null, $limit = null)
    {
        return parent::getDatas(TODO, $variable, ["checked = 1"], $orderBy, $asc, $limit);
    }
}
