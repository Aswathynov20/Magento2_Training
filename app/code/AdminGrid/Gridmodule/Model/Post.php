<?php

namespace AdminGrid\Gridmodule\Model;

use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('AdminGrid\Gridmodule\Model\ResourceModel\Post');
    }
}