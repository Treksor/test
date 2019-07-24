<?php
class AdFactory
{
    public static function createAd($POST,$status)
    {
        $className=ucfirst($status.'Ad');
        if (!class_exists($className)){
            die('нет такого класса');
        }
        return new $className($POST);

    }
}