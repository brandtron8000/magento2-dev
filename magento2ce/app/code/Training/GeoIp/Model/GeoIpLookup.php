<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/10/17
 * Time: 3:02 PM
 */

namespace Training\GeoIp\Model;


interface GeoIpLookup
{
    /**
     * @return []
     */
    public function getLocationData();

}