<?php


namespace Voicyou\Carousel\Controller\Adminhtml\Carousel;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class DeleteCarousel extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    protected $product;
    protected $option;
    protected $attributeModel;
    protected $productAction;
    protected $filter;
    protected $objectManager;
    protected $carouselFactory;
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Voicyou\Carousel\Model\ResourceModel\Carousel\Grid\CollectionFactory $carouselFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->objectManager     = $context->getObjectManager();
        $this->filter            = $filter;
        $this->carouselFactory = $carouselFactory;
    }
    public function execute()
    {
        $collection = $this->filter->getCollection($this->carouselFactory->create());
        $collectionSize = $collection->getSize();
        foreach ($collection as $item) {
            $item->delete();
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $collectionSize));
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }
}
?>