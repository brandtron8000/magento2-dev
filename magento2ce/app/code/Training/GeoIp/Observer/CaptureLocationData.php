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
use Magento\Framework\Registry;
use Training\GeoIp\Model\GeoIpLookupInterface;

class CaptureLocationData implements ObserverInterface
{

    /**
     * @var GeoIpLookupInterface
     */
    private $geoIpLookup;

    /**
     * @var Registry
     */
    private $registry;

    const LOCATION_DATA = 'geoip_location_data';


    /**
     * CaptureLocationData constructor.
     *
     * @param GeoIpLookupInterface $geoIpLookup
     * @param Registry $registry
     */
    public function __construct(GeoIpLookupInterface $geoIpLookup, Registry $registry)
    {
        $this->geoIpLookup = $geoIpLookup;
        $this->registry = $registry;
    }


    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$this->registry->registry(self::LOCATION_DATA)) {
            $locationData = $this->geoIpLookup->getLocationData();
            $this->registry->register(self::LOCATION_DATA, $locationData);
        }

    }
}