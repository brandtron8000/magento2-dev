<?php
/**
 *********************************
 * @file: Details.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\OrderInfo\Block;


use Magento\Framework\View\Element\Template;

class Details extends Template
{
    public function getOrderId()
    {
        return $this->getRequest()->getParam('order_id');
    }

    public function getStatus()
    {
        return $this->getRequest()->getParam('status');
    }

}