<?php
namespace __Namespace__\__Module__\Model\Resource\Item;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('__Namespace__\__Module__\Model\Item', '__Namespace__\__Module__\Model\Resource\Item');
    }
}