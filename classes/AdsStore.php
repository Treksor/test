<?php
class AdsStore
{
    private static $instance=NULL;
    protected $ads = array();

    public static function instance()
    {
        if (self::$instance == NULL)
        {
            self::$instance = new AdsStore();
        }
        return self::$instance;
    }

//    public function getAdById($adNumber)
//    {
//        $db = DBconnect::connectDB();
//        $result=$db->selectRow("SELECT * FROM `adds` WHERE `id`=?",$adNumber);
//        return $result;
//    }

    public function addAds(NewAd $ad)
    {
        if (!($this instanceof AdsStore))
        {
            die('нельзя использовать этот метод в конструкторах классов');
        }
        $this->ads[$ad->getId()]=$ad;
    }

    public function getAllAdsFromDb()
    {
        $db = DBconnect::connectDB();
        $allAds = $db->select("SELECT * FROM `adds`");
        foreach ($allAds as $value)
        {
            $ad=AdFactory::createAd($value,$value['status']);
            self::addAds($ad);
        }
    }

    public function outputAds()
    {
        global $smarty;
        $row='';
        foreach ($this->ads as $value)
        {
            $smarty->assign('ad',$value);
            $row.=$smarty->fetch('table_row.tpl');
        }
        $smarty->assign('ads_rows',$row);
    }


}