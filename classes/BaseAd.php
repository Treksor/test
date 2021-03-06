<?php
//namespace classes;
class BaseAd
{
    public $user_name,$user_email,$checkbox=1,$phone_number,$city,$category,$add_name,$add_description,$price;
    public $status='person';
    public $id;

    function __construct($ad=array())
    {
        BaseAd::fillObject($ad);
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

    public function getId()
    {
        return $this->id;
    }

    public function getAddName()
    {
        return $this->add_name;
    }

    public function getPrice()
    {
        return $this->price;
    }

       public function getUserName()
    {
        return $this->user_name;
    }

        public function getAddDescription()
    {
        return $this->add_description;
    }

    public static function findAd($id)
    {
        $db = DBconnect::connectDB();
        $result=$db->selectrow('SELECT * FROM adds WHERE id=?', $id);
        $ad=AdFactory::createAd($result,$result['status']);
        return $ad;

    }

//    public static function getAds()
//    {
//        $db = DBconnect::connectDB();
//        $result = $db->select("SELECT * FROM adds");
//        foreach ($result as $ad)
//        {
//            $a[$ad['id']]=new BaseAd($ad);
//        }
//        return $a;
//    }

    public function fillObject($data)
    {
        if (array_key_exists('phone_number',$data))
        {
            $data['phone_number']=preg_replace('~\D+~','',$data['phone_number']);
        }

        if (isset($data['status']))
        {
            unset($data['status']);
        }

        foreach ($data as $key=>$value)
        {
            if (property_exists($this,$key)){
                $this->$key=$data[$key];
            }
        }
    }

    public function saveAd()
    {
        $db = DBconnect::connectDB();
        $a=get_object_vars($this);
        $db->query("REPLACE INTO `adds` (?#) VALUES (?a)",array_keys($a),array_values($a));
    }

//    public function updateAd($data,$tablename)
//    {
//
//        BaseAd::fillObject($data);
//        $db = DBconnect::connectDB();
//        $ad=get_object_vars($this);
//        $db->query("UPDATE `$tablename` SET ?a WHERE  `$tablename`.`id` =?",$ad,$this->id);
//    }

    public function deleteAd()
    {
        $db = DBconnect::connectDB();
        $db->select("DELETE FROM `adds` WHERE `adds`.`id`=?d", $this->id);
        echo "<div class=\"alert alert-warning\">ID# $this->id Deleted.</div>";
    }
//        $db = DBconnect::connectDB();
//        $db->select("DELETE FROM `adds` WHERE `adds`.`id`=?",$this->id);

}

