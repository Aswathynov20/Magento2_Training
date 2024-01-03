<?php

namespace FormGrid\CustomerGrid\Model;

use Magento\Framework\Model\AbstractModel;
use FormGrid\CustomerGrid\Model\ResourceModel\Grid as ResourceModel;

class Grid extends AbstractModel
{
    /**
     * Constructor
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init(ResourceModel::class);
    }

    /**
     * Get Grid Id
     *
     * @return mixed
     */
    public function getGridId()
    {
        return $this->_getData('id');
    }

    /**
     * Set Grid Id
     *
     * @param int $Grid_id
     * @return Grids
     */
    public function setGridId($Grid_id)
    {
        return $this->setData('id', $Grid_id);
    }

    /**
     * Get Grid Name
     *
     * @return mixed
     */
    public function getGridName()
    {
        return $this->_getData('name');
    }

    /**
     * Set Grid Name
     *
     * @param int $name
     * @return Grids
     */
    public function setGridName($name)
    {
        return $this->setData('name', $name);
    }

    /**
     * Get Grid email
     *
     * @return mixed
     */

    public function getEmail()
    {
        return $this->_getData('email');
    }

    /**
     * Set Grid email
     *
     * @param string $email
     * @return Grids
     */
    public function setEmail($email)
    {
        return $this->setData('email', $email);
    }
}