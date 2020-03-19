<?php

namespace StephaneLeonard\TODOLIST\Model;

require_once 'Manager.php';

class TodoManager extends Manager
{

    public function getTodoDatas($variable = [], $condition  = [], $orderBy = null, $asc = null, $limit = null)
    {
        return parent::getDatas('todos' , $variable, $condition, $orderBy, $asc, $limit);
    }
}
