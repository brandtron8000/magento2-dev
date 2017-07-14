<?php
/**
 *********************************
 * @file: Retailer.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\Retailer\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Retailer extends AbstractDb
{

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        // initialize table name and primary key
        $this->_init('training_retailer', 'retailer_id');
    }

    public function getAssociatedProductIds($retailerId)
    {
        $conn = $this->getConnection();
        $select = $conn->select()
            ->from('training_retailer2product')
            ->where('retialer_id=?', $retailerId);

        $rows = $conn->fetchAssoc($select);
        $ids = [];
        foreach ($rows as $row){
            $ids[] = $row['product_id'];
        }
        return $ids;
    }

    public function loadByName($name){
        $select = $this->getConnection()->select()
            ->from($this->getMainTable())
            ->where('name=:name');
        $result = $this->getConnection()->fetchRow($select, ['name' => $name]);

        if (!$result) {
            return[];
        }
    }
}