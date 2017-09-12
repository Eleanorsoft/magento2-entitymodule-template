<?php
namespace __Namespace__\__Module__\Controller\Adminhtml\Item;

use __Namespace__\__Module__\Model\ItemFactory;
use Magento\Framework\File\UploaderFactory;
use \Magento\Framework\Filesystem;

class Index extends \Magento\Backend\App\Action
{
	/**
	* @var \Magento\Framework\View\Result\PageFactory
	*/
	protected $_resultPageFactory;

	/**
	 * @var \Magento\Framework\View\Result\Page
	 */
	protected $_resultPage;

	/**
	 * @var \__Namespace__\__Module__\Model\ItemFactory
	 */
	protected $_itemFactory;

	/**
	 * @var \Magento\Framework\Registry
	 */
	protected $_coreRegistry;
	protected $fileSystem;
	protected $uploaderFactory;

	/**
	 * Constructor
	 *
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\Registry $coreRegistry,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		ItemFactory $itemFactory,
		Filesystem $fileSystem,
		UploaderFactory $uploaderFactory
	) {
		 parent::__construct($context);
		$this->_coreRegistry = $coreRegistry;
		 $this->_resultPageFactory = $resultPageFactory;
		$this->_itemFactory = $itemFactory;
		$this->fileSystem = $fileSystem;
		$this->uploaderFactory = $uploaderFactory;
	}

	public function execute()
	{
		//Call page factory to render layout and page content
		$this->_setPageData();
		return $this->getResultPage();
	}

	/*
	 * Check permission via ACL resource
	 */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('__Namespace_____Module__::__namespace_____module___manage');
	}

	/**
	 * @return \Magento\Framework\View\Result\Page
	 */
	public function getResultPage()
	{
		if (is_null($this->_resultPage)) {
			$this->_resultPage = $this->_resultPageFactory->create();
		}
		return $this->_resultPage;
	}

	protected function _setPageData()
	{
		$resultPage = $this->getResultPage();
		$resultPage->setActiveMenu('__Namespace_____Module__::__module___items');
		$resultPage->getConfig()->getTitle()->prepend((__('__config.plural__')));

		//Add bread crumb
		#$resultPage->addBreadcrumb(__('Lookbook'), __('Lookbook'));
		#$resultPage->addBreadcrumb(__('Hello World'), __('Manage Blogs'));

		return $this;
	}

}
?>