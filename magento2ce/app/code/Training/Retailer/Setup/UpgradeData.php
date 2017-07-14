<?php
/**
 *********************************
 * @file: UpgradeData.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\Retailer\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(), '0.1.1', '<')){
            $setup->startSetup();

            $vendors = [
                [
                    'vendor_id' => 1,
                    'order_id' => 2,
                ],
                [
                    'vendor_id' => 3,
                    'order_id' => 1,
                ],
            ];

            foreach($vendors as $vendor) {
                $setup->getConnection()->insertForce(
                    $setup->getTable('training_vendor2order'),
                    $vendor
                );
            }



            $setup->endSetup();
        }
    }
}