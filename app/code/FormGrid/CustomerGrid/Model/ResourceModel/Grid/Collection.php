<?php

/**
 * CustomerGrid CustomerGrid Collection.
 * @category    FormGrid
 * @author      FormGrid Software Private Limited
 */

namespace FormGrid\CustomerGrid\Model\ResourceModel\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('FormGrid\CustomerGrid\Model\Grid', 'FormGrid\CustomerGrid\Model\ResourceModel\Grid');
    }
}