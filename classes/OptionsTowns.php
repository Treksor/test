<?php
//namespace classes;
class OptionsTowns
{
    public static function getOptions($col,$table)
    {
        $db = DBconnect::connectDB();
        $result=$db->selectCol("SELECT $col FROM $table");
        return $result;
    }
}