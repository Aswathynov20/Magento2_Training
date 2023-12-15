<?php

namespace LinkFooter\Footer\Block;

use Magento\Framework\View\Element\Template;

class Link extends Template
{
    public function getLinkUrl()
    {
        return $this->getUrl('module/index/index');
    }

    public function getLinkLabel()
    {
        return __('Create New CMS Page');
    }
}