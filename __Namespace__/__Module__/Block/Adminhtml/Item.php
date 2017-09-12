<?php

namespace __Namespace__\__Module__\Block\Adminhtml;

class Item extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_item';
        $this->_blockGroup = '__Namespace_____Module__';
        $this->_headerText = __('__config.plural__');
        $this->_addButtonLabel = __('Create New __config.singular__');
        parent::_construct();
    }
}