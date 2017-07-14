<?php
/**
 *********************************
 * @file: InstallData.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\Retailer\Setup;


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
        $retailers = [
            [
                'name' => 'Retailer 1',
                'street' => '123 Fake St.',
                'city' => 'Los Angeles',
                'postcode' => '90032',
                'region_id' => 12,
                'country_id' => 'US'
            ],
            [
                'name' => 'Retailer 2',
                'street' => '123 Brooklyn Ave.',
                'city' => 'Brooklyn',
                'postcode' => '10018',
                'region_id' => 43,
                'country_id' => 'US'
            ],
            [
                'name' => 'Retailer 3',
                'street' => '123 Pittsburgh Pl.',
                'city' => 'Pittsburgh',
                'postcode' => '15668',
                'region_id' => 51,
                'country_id' => 'US'
            ],
        ];

        foreach ($retailers as $retailer) {
            $setup->getConnection()->insertForce(
                $setup->getTable('training_retailer'),
                $retailer
            );
        }
    }
}