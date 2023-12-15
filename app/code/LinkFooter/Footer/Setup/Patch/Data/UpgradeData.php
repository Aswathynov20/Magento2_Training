<?php

namespace LinkFooter\Footer\Setup\Patch\Data;

use Magento\Cms\Model\PageFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class UpgradeData implements DataPatchInterface, PatchRevertableInterface
{
    private $moduleDataSetup;
    private $pageFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageFactory $pageFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->pageFactory = $pageFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $this->createOrUpdateCmsPage();
        $this->moduleDataSetup->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function revert()
    {
        $this->moduleDataSetup->startSetup();
        // Revert logic if needed
        $this->moduleDataSetup->endSetup();
    }

    public function getAliases()
    {
        return [];
    }

    private function createOrUpdateCmsPage()
    {
        $identifier = 'cms-page-dummy-content';

        $cmsPage = $this->pageFactory->create()->load($identifier, 'identifier');
        if (!$cmsPage->getId()) {
            $cmsPage->setTitle('Hi ');
            $cmsPage->setIdentifier($identifier);
            $cmsPage->setContent('<div>Your CMS Page Content Goes Here</div>');
            $cmsPage->setIsActive(true);
            $cmsPage->setStores([0]); // Add your store IDs
            $cmsPage->save();
        }
    }
}