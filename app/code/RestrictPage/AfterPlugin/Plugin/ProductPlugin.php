<?php
// File: app/code/YourNamespace/YourModule/Plugin/ProductPlugin.php

namespace RestrictPage\AfterPlugin\Plugin;

use Magento\Catalog\Model\Product;

class ProductPlugin
{
    /**
     * @param Product $subject
     * @param string $result
     * @return string
     */
    public function afterGetName(Product $subject, $result)
    {
        $websiteName = $this->getWebsiteName($subject); // Pass $subject to getWebsiteName

        // Append the website name before the product name
        $result = $websiteName . ' ' . $result;

        return $result;
    }

    /**
     * Implement a method to get the website name
     * @param Product $subject
     * @return string
     */
    private function getWebsiteName(Product $subject)
    {
        // You can customize this method to get the website name
        // For example, you might want to get it from store configuration
        // For demonstration purposes, returning a static value "My Website"
        return 'Product Name :';
    }
}