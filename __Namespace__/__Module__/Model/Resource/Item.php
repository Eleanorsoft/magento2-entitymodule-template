<?php

namespace __Namespace__\__Module__\Model\Resource;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Item extends  AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        /* Custom Table Name */
        $this->_init('__namespace_____module__','id');
    }
}