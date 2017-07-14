<?php
/**
 *********************************
 * @file: UpgradeSchema.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\Vendor\Setup;


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

            $table = $setup->getConnection()->newTable($setup->getTable('training_retailer2product'));

            $table->addColumn('id', Table::TYPE_INTEGER, null,
                [
                    'auto_increment' => true,
                    'primary' => true,
                    'unsigned' => true,
                    'nullable' => false,
                ]
            );

            $table->addColumn('retailer_id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false]);
            $table->addColumn('product_id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false]);

            $retailerFkName = $setup->getConnection()->getForeignKeyName(
                'training_retailer2product',
                'retailer_id',
                'training_retailer',
                'retailer_id'
            );

            $table->addForeignKey(
                $retailerFkName,
                'retailer_id',
                $setup->getTable('training_retailer'),
                'retailer_id',
                Table::ACTION_CASCADE
            );

            $productFkName = $setup->getConnection()->getForeignKeyName(
                'training_retailer2product',
                'product_id',
                'catalog_product_entity',
                'entity_id'
            );

            $table->addForeignKey(
                $productFkName,
                'product_id',
                $setup->getTable('catalog_product_entity'),
                'entity_id',
                Table::ACTION_CASCADE
            );

            $setup->getConnection()->createTable($table);

            $setup->endSetup();
        }
    }
}