<?php

// File: LogDb\LogDb404Page\Model\Log404.php

namespace LogDb\LogDb404Page\Model;

use Magento\Framework\Model\AbstractModel;

class Log404 extends AbstractModel
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'logdb_log404';

    protected function _construct()
    {
        $this->_init(\LogDb\LogDb404Page\Model\ResourceModel\Log404::class);
    }

    // public function incrementHitCount()
    // {
    //     $this->setData('count', $this->getData('count') + 1);
    //     $this->save();
    //     return $this;
    // }
}