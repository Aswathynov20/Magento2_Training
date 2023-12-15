<?php

namespace LogDb\LogDb404Page\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Log404 extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('logdb_log404', 'id');
    }
}