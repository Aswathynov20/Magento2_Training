<?php

namespace FormGrid\CustomerGrid\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Grid extends AbstractDb
{
    /**
     * Constructor For initializing table
     */
    protected function _construct()
    {
        $this->_init('formgrid_customergrid', 'id');
    }
}