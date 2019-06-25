<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);
//$project_root=$_SERVER['DOCUMENT_ROOT'];
//require_once $project_root."/dbsimple/config.php";
//require_once $project_root."/dbsimple/DbSimple/Generic.php";

class NewAd
{
    public $status,$user_name,$user_email,$checkbox,$phone_number,$city,$category,$add_name,$add_description,$price;
    public $id;

    function __construct($ad)
    {
        if (!empty($ad['status']))
        {
            $this->status = $ad['status'];
        }
        else
            {
                $this->status='person';
            }
        $this->user_name=$ad['user_name'];
        $this->user_email=$ad['user_email'];

        if (!empty($ad['checkbox']))
        {
            $this->checkbox=1;
        }
        else
        {
            $this->checkbox=0;
        }

        $this->phone_number=preg_replace('~\D+~','',$ad['phone_number']);
        $this->city=$ad['city'];
        $this->category=$ad['category'];
        $this->add_name=$ad['add_name'];
        $this->add_description=$ad['add_description'];
        $this->price=$ad['price'];
        $this->id=$ad['id'];
    }

    public static function getAds()
    {
        $db = Database::connectDB();
        $result = $db->select("SELECT * FROM adds");
        foreach ($result as $ad)
        {
            $a[$ad['id']]=new NewAd($ad);
        }
        return $a;
    }

    public static function getOptions($col,$table)
    {
        $db = Database::connectDB();
        $result=$db->selectCol("SELECT $col FROM $table");
        return $result;
    }

    public function saveAd($tablename)
    {
        $db = Database::connectDB();
        $a=get_object_vars($this);
        $db->query("INSERT INTO `$tablename` (?#) VALUES (?a)",array_keys($a),array_values($a));
    }

    public function updateAd($data,$tablename)
    {
        foreach ($this as $key=>$value)
        {
            if (array_key_exists($key,$data)){
                $this->$key=$data[$key];
            }
        }
        $db = Database::connectDB();
        $ad=get_object_vars($this);
        $db->query("UPDATE `$tablename` SET ?a WHERE  `$tablename`.`id` =?",$ad,$this->id);
    }

    public function deleteAd(){
        $db = Database::connectDB();
        $db->select("DELETE FROM `adds` WHERE `adds`.`id`=?",$this->id);
    }
}

