<?php

namespace __Namespace__\__Module__\Model;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Item
 * @package __Namespace__\__Module__\Model
 *
 *
 * @method getImage()
 * @method getName()
 * @method getText()
 * @method getSubtitle()
 */
class Item extends AbstractModel
{
    public function _construct() {
        $this->_init('__Namespace__\__Module__\Model\Resource\Item');
    }
}