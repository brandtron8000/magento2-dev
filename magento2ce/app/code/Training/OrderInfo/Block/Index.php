<?php
/**
 *********************************
 * @file: Index.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\OrderInfo\Block;


use Magento\Framework\View\Element\Template;

class Index extends Template
{
    /**
     * @return string
     */
    public function getFormAction() {
        return $this->getUrl('*/*/process');
    }

    public function getOrderInfoId() {

    }

}