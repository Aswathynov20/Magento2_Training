<?php

namespace AdminGrid\Gridmodule\Model\ResourceModel;

class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context)
    {
        parent::__construct($context);
    }
    protected function _construct()
    {
        $this->_init('logdb_log404', 'id');
    }
}