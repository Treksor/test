<?php
class PersonAd extends NewAd
{
    public $status = 'person';

    function __construct($ad = array())
    {
        parent::__construct($ad);
    }
}