<?php

namespace Training\Test\Plugin\Magento\Theme\Block\Html\Footer;

class Plugin
{
    public function aftergetCopyright(\Magento\Theme\Block\Html\Footer $subject, $result)
    {
        return $result = "Customized copyright!";
    }
}
