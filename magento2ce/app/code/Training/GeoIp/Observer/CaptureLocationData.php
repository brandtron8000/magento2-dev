<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/10/17
 * Time: 2:33 PM
 */

namespace Training\GeoIp\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Training\GeoIp\Model\GeoIpLookup;

class CaptureLocationData implements ObserverInterface
{
    /**
     * @var GeoIpLookup
     */
    private $geoIpLookup;

    public function __construct(GeoIpLookup $geoIpLookup)
    {
        $this->geoIpLookup = $geoIpLookup;
    }


    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $ip = $this->geoIpLookup->getLocationData();
        print_r($ip);

    }
}