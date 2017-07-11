<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/10/17
 * Time: 1:50 PM
 */

namespace Training\GeoIp\Plugin;


class WelcomeMessage
{
    public function afterGetWelcome(\Magento\Theme\Block\Html\Header $subject, $result)
    {
        return 'HelloooOOoo';
    }

}