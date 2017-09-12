<?php
namespace __Namespace__\__Module__\Controller\Adminhtml\Item;

class Edit extends Index
{
    /**
     */
    public function execute()
    {
        $itemId = $this->getRequest()->getParam('id');
        /** @var \Atak\Events\Model\Item $model */
        $model = $this->_itemFactory->create();

        if ($itemId) {
            $model->load($itemId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        // Restore previously entered form data from session
        $data = $this->_session->getItemData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('__module___item', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('__Namespace_____Module__::__module___items');
        $resultPage->getConfig()->getTitle()->prepend(__('__config.plural__ Item'));

        return $resultPage;
    }
}