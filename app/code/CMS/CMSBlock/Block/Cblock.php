<?php
namespace CMS\CMSBlock\Block;

use Magento\Framework\View\Element\Template;

class Cblock extends Template
{
    public function getCustomContent()
    {
        // Your PHP logic here
        $result = "Hello, this is your custom content!";
        return $result;
    }
}
