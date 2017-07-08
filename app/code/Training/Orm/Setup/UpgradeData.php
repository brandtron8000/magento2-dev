<?php
namespace Training\Orm\Setup;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Setup\CategorySetup;
use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Store\Model\StoreManagerInterface as StoreManager;
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var CategorySetupFactory
     */
    private $catalogSetupFactory;
    /**
     * @var StoreManager
     */
    private $storeManager;
    public function __construct(
        CategorySetupFactory $categorySetupFactory,
        StoreManager $storeManager
    ) {
        $this->catalogSetupFactory = $categorySetupFactory;
        $this->storeManager = $storeManager;
    }
    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup,
                            ModuleContextInterface $context
    ) {
        $dbVersion = $context->getVersion();
        if (version_compare($dbVersion, '2.0.5', '<')) {
            $admin = $this->storeManager->getStore('admin')->getId();
            $default = $this->storeManager->getStore('default')->getId();
            /** @var CategorySetup $catalogSetup */
            $catalogSetup = $this->catalogSetupFactory->create(['setup' => $setup]);
            $catalogSetup->addAttribute(Product::ENTITY, 'example_multiselect', [
                'label' => 'Example Multi-Select',
                'input' => 'multiselect',
                'backend' => ArrayBackend::class,
                'visible_on_front' => 1,
                'required' => 0,
                'option' => [
                    'order' => ['option1' => 10, 'option2' => 20],
                    'value' => [
                        'option1' => [
                            $admin => 'Admin Label 1',
                            $default => 'Frontend Label 1'
                        ],
                        'option2' => [
                            $admin => 'Admin Label 2',
                            $default => 'Frontend Label 2'
                        ],
                    ]
                ]
            ]);
        }
        if (version_compare($dbVersion, '2.0.6', '<')) {
            /** @var CategorySetup $catalogSetup */
            $catalogSetup = $this->catalogSetupFactory->create(['setup' => $setup]);
            $catalogSetup->updateAttribute(
                Product::ENTITY,
                'example_multiselect',
                [
                    'frontend_model' =>
                        \Training\Orm\Entity\Attribute\Frontend\HtmlList::class,
                    'is_html_allowed_on_front' => 1,
                ]
            );
        }
    }
}
