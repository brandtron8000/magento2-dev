<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/11/17
 * Time: 4:06 PM
 */

namespace Training\Converter\Model;

use Magento\Framework\HTTP\ClientFactory;


class GoogleConverter implements ConverterInterface
{
    /**
     * @var ClientFactory
     */
    private $clientFactory;

    const CONVERT_URL = 'https://www.google.com/finance/converter?';

    /**
     * GoogleConverter constructor.
     * @param ClientFactory $clientFactory
     */
    public function __construct(
        ClientFactory $clientFactory
    )
    {
        $this->clientFactory = $clientFactory;
    }

    /**
     * @param $amount
     * @param $from
     * @param $to
     * @return array
     */
    public function convert($amount, $from, $to)
    {

        $url = self::CONVERT_URL . "a=" . $amount . "&from=" . $from . "&to=" . $to;
        $client = $this->clientFactory->create();
        $client->get($url);
        $response = $client->getBody();

        if (preg_match("%<span class=bld>(\d+\.\d+).*?</span>%", $response, $m)) {
            $ret_value = $m[1];
            $ret = [
                'amount' => $amount,
                'from' => $from,
                'to' => $to,
                'result' => $ret_value
            ];
        }

        return $ret;
    }

}