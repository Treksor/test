<?php
class CompanyAd extends NewAd
{
    public $status = 'company';

    function __construct($ad = array())
    {
        parent::__construct($ad);
    }
}