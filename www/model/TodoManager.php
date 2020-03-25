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
        return parent::updateDatas(TODO, ["checked", RANKING], [$value, $ranking], ["id = $id"]);
    }

    public function addTodo($param = [], $value  = [])
    {
        return parent::setDatas(TODO, $param, $value);
    }

    public function getLastRankTodo($checked)
    {
        return parent::getDatas(TODO, [RANKING], ["checked = $checked"], RANKING, ' DESC', 1);
    }

    public function updateRankingDatas($newValue, $oldValue, $checked, $id)
    {
        try {


            $bdd = parent::dbConnect();
            $bdd->beginTransaction();
            $sql = "UPDATE todos SET ranking =  ? WHERE ranking = ? and checked = ?";
            $stmt = $bdd->prepare($sql);
            $stmt->execute(
                array(
                    $newValue,
                    $oldValue,
                    $checked
                )
            );
            if ($newValue < $oldValue) {
                $sql = "UPDATE todos SET ranking =  ranking +1 WHERE ranking >= ?  and ranking <= ? and checked = ? and id != ?";
                $stmt = $bdd->prepare($sql);
                $stmt->execute(
                    array(
                        $newValue,
                        $oldValue,
                        $checked,
                        $id
                    )
                );
            }
            else if($newValue > $oldValue) {
                $sql = "UPDATE todos SET ranking =  ranking -1 WHERE ranking <= ? and ranking >= ? and checked = ? and id != ?";
                $stmt = $bdd->prepare($sql);
                $stmt->execute(
                    array(
                        $newValue,
                        $oldValue,
                        $checked,
                        $id
                    )
                );
            }
            //We've got this far without an exception, so commit the changes.
            $bdd->commit();
        } catch (\Exception $e) {
            //An exception has occured, which means that one of our database queries
            //failed.
            //Print out the error message.
            echo $e->getMessage();
            //Rollback the transaction.
            $bdd->rollBack();
        }
    }
}
