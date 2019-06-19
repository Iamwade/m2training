<?php

namespace Training\CustomerPersonalSite\Setup\Patch\Data;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

/**
 * Class InstallDefaultCategories data patch.
 *
 * @package Magento\Catalog\Setup\Patch
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class CreateCustomerAttribute implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function apply()
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $attributeName = 'personal_site';
        $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, $attributeName, [
                'type' => 'static',
                'label' => 'Personal site Url',
                'input' => 'text',
                //add url validation rule twice in different format for utilizing by different forms
                'validate_rules' => '{"max_text_length":250,"input_validation":"url","validate-url":true}',
                'required' => false,
                'system' => false,
                'user_defined' => true,
                'group' => 'General',
                'unique' => true,
                'sort_order' => 300,
                'position' => 300
            ]
        );
        $attributeId = $customerSetup->getAttributeId(\Magento\Customer\Model\Customer::ENTITY, $attributeName);
        $this->moduleDataSetup->getConnection()
            ->insertMultiple($this->moduleDataSetup->getTable('customer_form_attribute'), [
                ['form_code' => 'adminhtml_customer', 'attribute_id' => $attributeId],
                ['form_code' => 'customer_account_create', 'attribute_id' => $attributeId],
                ['form_code' => 'customer_account_edit', 'attribute_id' => $attributeId],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

    public function revert()
    {

    }
}
