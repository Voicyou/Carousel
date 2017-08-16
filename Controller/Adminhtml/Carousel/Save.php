<?php


namespace Voicyou\Carousel\Controller\Adminhtml\Carousel;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    
    protected $carouselFactory;
    
    protected $messageManager;
    
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Voicyou\Carousel\Model\CarouselFactory $carouselFactory,
        \Voicyou\Carousel\Model\Carousel $carouselModel,
        \Magento\Framework\Message\ManagerInterface $messageManager
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->carouselFactory = $carouselFactory;
        $this->carouselModel = $carouselModel;
        $this->messageManager = $messageManager;
    }

    /**
     * Index action
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        //die('order::'.$this->_request->getParam('sort_order'));
        if (isset($_REQUEST['id']))
        {
            $carousel = $this->carouselFactory->create();
            $carousel = $carousel->load($this->_request->getParam('id'));
        }
        else
        {
            $carousel = $this->carouselFactory->create();
            //die('create');
        }
        //$carousel = $this->carouselFactory->create();
        $carousel->setData('sort_order',$this->_request->getParam('sort_order'));
        $carousel->setData('image_name',$this->_request->getParam('image')[0]['name']);
        $carousel->setData('image_description',$this->_request->getParam('image_description'));
        $carousel->save();
        $redirectPath = $this->_backendUrl->getUrl('carousel/carousel/index');
        $resultRedirect = $this->resultRedirectFactory->create();
        $this->messageManager->addSuccess('Added the record successfully.');
        $resultRedirect->setPath($redirectPath);
        return $resultRedirect;
    }
}
?>