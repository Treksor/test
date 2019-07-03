<?php
//namespace classes;
class Options_categories
{
    public static function getOptions($col,$table)
    {
        $db = DB_connect::connectDB();
        $result=$db->selectCol("SELECT $col FROM $table");
        return $result;
    }

}