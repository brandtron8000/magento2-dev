<?php
/**
 *********************************
 * @file: Collection.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\Retailer\Model\ResourceModel\Retailer;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        // initialize Model and Resource Model Mapping for Collection
       $this->_init(
           \Training\Retailer\Model\Retailer::class,
           \Training\Retailer\Model\ResourceModel\Retailer::class
       );
    }

}