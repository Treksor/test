<?php
class PersonAd extends BaseAd
{
    public $status = 'person';

    function __construct($ad = array())
    {
        parent::__construct($ad);
    }
}