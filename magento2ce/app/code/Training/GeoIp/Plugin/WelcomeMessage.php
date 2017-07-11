<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/10/17
 * Time: 1:50 PM
 */

namespace Training\GeoIp\Plugin;

use Magento\Framework\Registry;
use Magento\Theme\Block\Html\Header;
use Training\GeoIp\Model\WelcomeLookupInterface;
use Training\GeoIp\Observer\CaptureLocationData;

class WelcomeMessage
{
    private $registry;
    /**
     * @var \Training\GeoIp\Model\WelcomeLookupInterface
     */
    private $welcomeLookup;

    /**
     * WelcomeMessage constructor.
     * @param Registry $registry
     * @param WelcomeLookupInterface $welcomeLookup
     */
    public function __construct(
        Registry $registry,
        WelcomeLookupInterface $welcomeLookup)
    {
        $this->registry = $registry;
        $this->welcomeLookup = $welcomeLookup;
    }

    public function afterGetWelcome(Header $subject, $result)
    {
            $locationData = $this->registry
                    ->registry(CaptureLocationData::LOCATION_DATA);


//        $msg = $this->welcomeLookup->getWelcomeMessage(
//            $locationData[GeoIpLookup::COUNTRY_CODE],
//            $locationData[GeoIpLookup::REGION_CODE]
//        );

            $msg = $this->welcomeLookup->getWelcomeMessage(
                $locationData['country_code'],
                $locationData['region_code']
            );

            return $msg;

    }

}