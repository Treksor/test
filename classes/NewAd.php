<?php
//namespace classes;
class NewAd
{
    public $status='person',$user_name,$user_email,$checkbox=1,$phone_number,$city,$category,$add_name,$add_description,$price;
    public $id;

    function __construct($ad=array())
    {
        NewAd::fillObject($ad);
////        if (!empty($ad['status']))
////        {
//            $this->status = $ad['status'];
////        }
////        else
////            {
////                $this->status='person';
////            }
//        $this->user_name=$ad['user_name'];
//        $this->user_email=$ad['user_email'];
//
//        if (!empty($ad['checkbox']))
//        {
//            $this->checkbox=1;
//        }
//        else
//        {
//            $this->checkbox=0;
//        }
//
//        $this->phone_number=preg_replace('~\D+~','',$ad['phone_number']);
//        $this->city=$ad['city'];
//        $this->category=$ad['category'];
//        $this->add_name=$ad['add_name'];
//        $this->add_description=$ad['add_description'];
//        $this->price=$ad['price'];
//        $this->id=$ad['id'];
    }

    public static function findAd($id)
    {
        $db = DB_connect::connectDB();
        $result=$db->selectrow('SELECT * FROM adds WHERE id=?', $id);
        $ad=new NewAd($result);
        return $ad;

    }

    public static function getAds()
    {
        $db = DB_connect::connectDB();
        $result = $db->select("SELECT * FROM adds");
        foreach ($result as $ad)
        {
            $a[$ad['id']]=new NewAd($ad);
        }
        return $a;
    }

    public function fillObject($data)
    {
        if (array_key_exists('phone_number',$data))
        {
            $data['phone_number']=preg_replace('~\D+~','',$data['phone_number']);
        }

        foreach ($data as $key=>$value)
        {
            if (property_exists($this,$key)){
                $this->$key=$data[$key];
            }
        }
    }

    public function saveAd($tablename)
    {
        $db = DB_connect::connectDB();
        $a=get_object_vars($this);
        $db->query("INSERT INTO `$tablename` (?#) VALUES (?a)",array_keys($a),array_values($a));
    }

    public function updateAd($data,$tablename)
    {

        NewAd::fillObject($data);
        $db = DB_connect::connectDB();
        $ad=get_object_vars($this);
        $db->query("UPDATE `$tablename` SET ?a WHERE  `$tablename`.`id` =?",$ad,$this->id);
    }

    public function deleteAd(){
        $db = DB_connect::connectDB();
        $db->select("DELETE FROM `adds` WHERE `adds`.`id`=?",$this->id);
    }
}

