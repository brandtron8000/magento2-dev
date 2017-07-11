<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/11/17
 * Time: 9:11 AM
 */

namespace Training\GeoIp\Model;


interface WelcomeLookupInterface
{
    public function getWelcomeMessage($country, $location = null);

}