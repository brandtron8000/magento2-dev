<?php
/**
 *********************************
 * @file: Retailer.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\Retailer\Model;


use Magento\Framework\Model\AbstractModel;

class Retailer extends AbstractModel
{
    protected function _construct()
    {
        // initialize resource model
        $this->_init(\Training\Retailer\Model\ResourceModel\Retailer::class);
    }

    public function getAssociatedProductIds()
    {
        return $this->getResource()->$this->getAssociatedProductIds($this->getId());

    }

    public function loadByName($name) {
        $this->addData($this->getResource()->loadByName($name));

        return $this;
    }

}