<?php

namespace ErrorLog\ErrorLog404\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Log404 extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('ErrorLog_Error404', 'id');
    }
}