<?php

namespace ErrorLog\ErrorLog404\Model;

use Magento\Framework\Model\AbstractModel;

class Log404 extends AbstractModel
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'ErrorLog_Error404';

    protected function _construct()
    {
        $this->_init(\ErrorLog\ErrorLog404\Model\ResourceModel\Log404::class);
    }

    public function incrementHitCount()
    {
        $this->setData('hit_count', $this->getData('hit_count') + 1);
        $this->save();
    }
}