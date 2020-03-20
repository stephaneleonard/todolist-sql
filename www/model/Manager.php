<?php

namespace StephaneLeonard\TODOLIST\Model;

define('WHERE', " WHERE ");

class Manager
{
    protected function dbConnect()
    {
        return new \PDO('mysql:host=db:3306;dbname=todolist;charset=utf8', 'root', 'password');
    }
    protected function getDatas($table, $variable = [], $condition  = [], $orderBy = null, $asc = null, $limit = null)
    {
        if (empty($variable)) {
            $var = "*";
        } else {
            $var = "";
            foreach ($variable as $key => $value) {
                if ($key == count($variable) - 1) {
                    $var = $var . $value;
                } else {
                    $var = $var . $value . ", ";
                }
            }
        }
        $firstPart = "SELECT $var";
        $table = " FROM $table";
        $cond = "";
        if (!empty($condition)) {
            $cond = $cond .  WHERE;
        }
        foreach ($condition as $value) {
            $cond = $cond . $value;
        }
        $order = $orderBy ? " ORDER BY $orderBy " : "";
        $sort = $asc ? $asc : "";
        $lim = $limit ? " LIMIT $limit" : "";
        $sql = $firstPart . $table . $cond . $order . $sort . $lim;
        $db = $this->dbConnect();
        return $db->query($sql);
    }

    protected function setDatas($var, $param = [], $value  = [])
    {
        //sql example INSERT INTO `shows`(`id`, `title`, `performer`, `date`, `showTypesId`, `firstGenresId`, `secondGenreId`, `duration`, `startTime`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9])
        $firstPart = "INSERT INTO $var ";
        //get all param in a ()
        if (count($param) != count($value)) {
            throw new \UnexpectedValueException('error in number of parameters');
        } else {
            $p = "(" . implode(',', $param) . ") ";
        }
        //get all value in a ()
        $v = "(" . str_repeat(" ? , ", count($value) - 1) . " ? )";

        //bind value to param


        //create SQL request
        $sql = $firstPart . $p . "VALUES " . $v;
        $db = $this->dbConnect();
        $prep = $db->prepare($sql);
        return $prep->execute($value);
    }
    protected function updateDatas($var, $param = [], $value  = [], $condition  = [])
    {
        //sql UPDATE `clients` SET `id`=[value-1],`lastName`=[value-2],`firstName`=[value-3],`birthDate`=[value-4],`card`=[value-5],`cardNumber`=[value-6] WHERE 1
        $firstPart = "UPDATE $var SET ";
        if (count($param) != count($value)) {
            throw new \UnexpectedValueException('error in number of parameters');
        }
        $p = "";
        foreach ($param as $key => $data) {
            if ($key == count($param) - 1) {
                $p = $p . $data . "= ?";
            } else {
                $p = $p . $data . "= ? ,  ";
            }
        }
        $cond = "";
        if (!empty($condition)) {
            $cond = $cond . WHERE;
        }
        foreach ($condition as $d) {
            $cond = $cond . $d;
        }
        $sql = $firstPart . $p . $cond;
        $db = $this->dbConnect();
        $prep = $db->prepare($sql);
        return $prep->execute($value);
    }
    protected function deleteDatas($var, $condition  = [])
    {
        //sql DELETE FROM `clients` WHERE 0
        $firstPart = "DELETE FROM $var ";
        $cond = "";
        if (!empty($condition)) {
            $cond = $cond . WHERE;
        }
        foreach ($condition as $d) {
            $cond = $cond . $d;
        }
        $sql = $firstPart . $cond;
        $db = $this->dbConnect();
        $prep = $db->prepare($sql);
        return $prep->execute();
    }
}
