<?php
/**
 *********************************
 * @file: InstallData.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\Vendor\Setup;


use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $vendors = [
            [
                'name' => 'Vendor 1',
                'country_id' => 'US',
            ],
            [
                'name' => 'Vendor 2',
                'country_id' => 'CA',
            ],
            [
                'name' => 'Vendor 3',
                'country_id' => 'GB',
            ],
            [
                'name' => 'Vendor 4',
                'country_id' => 'NZ',
            ],
            [
                'name' => 'Vendor 5',
                'country_id' => 'US',
            ],
            [
                'name' => 'Vendor 6',
                'country_id' => 'US',
            ],
            [
                'name' => 'Vendor 7',
                'country_id' => 'BR',
            ],
            [
                'name' => 'Vendor 8',
                'country_id' => 'FR',
            ],
            [
                'name' => 'Vendor 9',
                'country_id' => 'GB',
            ],
            [
                'name' => 'Vendor 10',
                'country_id' => 'CA',
            ],
        ];

        foreach($vendors as $vendor) {
            $setup->getConnection()->insertForce(
                $setup->getTable('training_vendor'),
                $vendor
            );
        }
    }
}