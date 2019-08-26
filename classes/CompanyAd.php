<?php
class CompanyAd extends BaseAd
{
    public $status = 'company';

    function __construct($ad = array())
    {
        parent::__construct($ad);
    }
}