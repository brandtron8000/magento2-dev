<?php
/**
 *********************************
 * @file: UpgradeSchema.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\Retailer\Setup;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(), '0.1.1', '<')){
            $setup->startSetup();

            $table = $setup->getConnection()->newTable($setup->getTable('training_vendor2order'));

            $table->addColumn('id', Table::TYPE_INTEGER, null,
                [
                    'auto_increment' => true,
                    'primary' => true,
                    'unsigned' => true,
                    'nullable' => false,
                ]
            );

            $table->addColumn('vendor_id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false]);
            $table->addColumn('order_id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false]);

            $vendorFkName = $setup->getConnection()->getForeignKeyName(
                'training_vendor2order',
                'vendor_id',
                'training_vendor',
                'vendor_id'
            );

            $table->addForeignKey(
                $vendorFkName,
                'vendor_id',
                $setup->getTable('training_vendor'),
                'vendor_id',
                Table::ACTION_CASCADE
            );

            $orderFkName = $setup->getConnection()->getForeignKeyName(
                'training_vendor2order',
                'order_id',
                'sales_order',
                'entity_id'
            );

            $table->addForeignKey(
                $orderFkName,
                'order_id',
                $setup->getTable('sales_order'),
                'entity_id',
                Table::ACTION_CASCADE
            );

            $setup->getConnection()->createTable($table);

            $setup->endSetup();
        }
    }
}