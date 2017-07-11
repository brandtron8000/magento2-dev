<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/11/17
 * Time: 9:13 AM
 */

namespace Training\GeoIp\Model;


class WelcomeLookupSimple implements WelcomeLookupInterface
{

    public function getWelcomeMessage($country, $location = null)
    {
        $msg = 'Welcome Simple';
        if ($country == 'US') {
            if ($location && $location == 'CA') {
                $msg = 'Welcome CA Simple';
            }
            else {
                $msg = 'Welcome US Simple';
            }
        }
        elseif ($country == 'GB') {
            if ($location && $location == 'London') {
                $msg = 'Welcome London Simple';
            }
            else {
                $msg = 'Welcome GB Simple';
            }
        }

        return $msg;
    }
}