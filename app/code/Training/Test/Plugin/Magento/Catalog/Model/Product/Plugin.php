<?php

namespace Training\Test\Plugin\Magento\Catalog\Model\Product;

class Plugin
{
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result - $result + 666;
    }
}
