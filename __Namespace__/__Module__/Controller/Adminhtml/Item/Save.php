<?php

namespace __Namespace__\__Module__\Controller\Adminhtml\Item;

use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends Index
{
    /**
     * @return void
     */
    public function execute()
    {
        $isPost = $this->getRequest()->getPost();

        if ($isPost) {
            $newsModel = $this->_itemFactory->create();
            $newsId = $this->getRequest()->getParam('id');

            $destination = $this->fileSystem->getDirectoryWrite(DirectoryList::MEDIA)->getAbsolutePath('__config.media_directory__');

            
            $formData = $this->getRequest()->getParam('item');
            if (isset($formData['id'])) {
                $newsModel->load($formData['id']);
                $oldImage = $newsModel->getImage();
            }
            $newsModel->setData($formData);
            
            $imageFields = ['image'];

            foreach ($imageFields as $field) {
                $oldImage = '';
                if (isset($formData['id'])) { $oldImage = $newsModel->getImage(); }
                if (isset($_FILES[$field]) and $_FILES[$field]['size'] > 0) {
                    try {
                        $uploader = $this->uploaderFactory->create(['fileId' => $field]);
                        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                        $uploader->setAllowRenameFiles(true);
                        $uploader->setFilesDispersion(true);
                        $uploader->setAllowCreateFolders(true);
                        if ($result = $uploader->save($destination)) {
                            $newsModel->setData($field, '__config.media_directory__' . $result['file']);
                        } else {
                            $newsModel->setData($field, $oldImage);
                        }

                    } catch (\Exception $e) {
                        $this->messageManager->addError(
                            __($e->getMessage())
                        );
                        $newsModel->setData($field, $oldImage);
                    }
                } else {
                    $newsModel->setData($field, $oldImage);
                }
            }

            if (!$newsModel->getId()) {
                $newsModel->setCreatedAt(date('Y-m-d H:i:s'));
            }

            try {
                // Save news
                $newsModel->save();

                // Display success message
                $this->messageManager->addSuccess(__('The item has been saved.'));

                // Check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', ['id' => $newsModel->getId(), '_current' => true]);
                    return;
                }

                // Go to grid page
                $this->_redirect('*/*/');
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }

            $this->_getSession()->setFormData($formData);
            $this->_redirect('*/*/edit', ['id' => $newsId]);
        }
    }
}
