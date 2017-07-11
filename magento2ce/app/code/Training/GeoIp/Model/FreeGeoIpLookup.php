<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/10/17
 * Time: 3:06 PM
 */

namespace Training\GeoIp\Model;


use Magento\Framework\HTTP\ClientFactory;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

class FreeGeoIpLookup implements GeoIpLookup
{

    /**
     * @var RemoteAddress
     */
    private $remoteAddress;

    const FREE_GEOIP_URL = 'http://freegeoip.net/json/';
    /**
     * @var ClientFactory
     */
    private $clientFactory;


    /**
     * FreeGeoIpLookup constructor.
     *
     * @param RemoteAddress $remoteAddress
     */
    public function __construct(
        RemoteAddress $remoteAddress,
        ClientFactory $clientFactory
    )
    {
        $this->remoteAddress = $remoteAddress;
        $this->clientFactory = $clientFactory;
    }


    /**
     * @return []
     */
    public function getLocationData()
    {
        $ip = $this->remoteAddress->getRemoteAddress();
        $ip = '66.135.202.198';

        $url = self::FREE_GEOIP_URL . $ip;
        $client = $this->clientFactory->create();
        $client->get($url);

        $response = json_decode($client->getBody(), true);

        return [
            'country_code' => $response['country_code'],
            'region_code' => $response['region_code'],
        ];
    }
}