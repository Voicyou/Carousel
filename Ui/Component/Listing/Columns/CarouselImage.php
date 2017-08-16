<?php

namespace Voicyou\Carousel\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class CarouselImage extends Column
{
    const NAME = 'thumbnail';

    const ALT_FIELD = 'name';

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    protected $storeManagerInterface;
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Catalog\Helper\Image $imageHelper,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface, 
        \Magento\Backend\Block\Store\Switcher\Interceptor $interceptor,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->imageHelper = $imageHelper;
        $this->urlBuilder = $urlBuilder;
        $this->storeManagerInterface = $storeManagerInterface;
        $this->interceptor = $interceptor;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $currentStore = $this->storeManagerInterface->getStore();
        $mediaUrl     = $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $imageUrl = $this->interceptor->getViewFileUrl('Voicyou_Carousel::images/placeholder.jpg');
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $product = new \Magento\Framework\DataObject($item);
                $imageName = $item['image_name'];
                
                if  ($imageName != '')
                {
                    $imageUrl  = $mediaUrl."carousel/".$imageName;
                }
                else
                {
                    $imageUrl = $this->interceptor->getViewFileUrl('Voicyou_Carousel::images/placeholder.jpg');
                }
                $imageHelper = $this->imageHelper->init($product, 'voicyou_carousel_listing');
                $item[$fieldName . '_src'] = $imageUrl;
                $item[$fieldName . '_alt'] = "No image";
                $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
                    'catalog/product/edit',
                    ['id' => 1, 'store' => 1]
                );
                $origImageHelper = $this->imageHelper->init($product, 'thumbnail_url');
                $item[$fieldName . '_orig_src'] = "";
            }
        }

        return $dataSource;
    }

    /**
     * @param array $row
     *
     * @return null|string
     */
    protected function getAlt($row)
    {
        $altField = $this->getData('config/altField') ?: self::ALT_FIELD;
        return isset($row[$altField]) ? $row[$altField] : null;
    }
}
?>