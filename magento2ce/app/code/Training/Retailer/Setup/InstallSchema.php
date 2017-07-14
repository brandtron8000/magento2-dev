<?php
/**
 *********************************
 * @file: InstallSchema.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\Retailer\Setup;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable($setup->getTable('training_retailer'));
        $table->addColumn('retailer_id', Table::TYPE_INTEGER, null,
            [
                'auto_increment' => true,
                'primary' => true,
                'unsigned' => true,
                'nullable' => false,
            ]
        );
        $table->addColumn('name', Table::TYPE_TEXT, 255, ['nullable' => false]);
        $table->addColumn('street', Table::TYPE_TEXT, 255, ['nullable' => false]);
        $table->addColumn('city', Table::TYPE_TEXT, 255, ['nullable' => false]);
        $table->addColumn('postcode', Table::TYPE_TEXT, 10, ['nullable' => false]);

        $table->addColumn('region_id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false]);
        $table->addColumn('country_id', Table::TYPE_TEXT, 2, ['nullable' => false]);

        $table->addColumn('created_at', Table::TYPE_TIMESTAMP, null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT]);

        $idxName = $setup->getConnection()->getIndexName('training_retailer', ['name']);
        $table->addIndex($idxName, ['name']);

        $regionFkName = $setup->getConnection()->getForeignKeyName(
        'training_retailer',
        'region_id',
        'directory_country_region',
        'region_id'
        );

        $table->addForeignKey(
            $regionFkName,
            'country_id',
            $setup->getTable('directory_country_region'),
            'country_id',
            Table::ACTION_CASCADE
        );

        $countryFkName = $setup->getConnection()->getForeignKeyName(
            'training_retailer',
            'country_id',
            'directory_country',
            'country_id'
        );

        $table->addForeignKey(
            $countryFkName,
            'country_id',
            $setup->getTable('directory_country'),
            'country_id',
            Table::ACTION_CASCADE
        );

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}