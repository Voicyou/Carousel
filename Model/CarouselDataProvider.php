<?php 
namespace Voicyou\Carousel\Model;

use Voicyou\Carousel\Model\ResourceModel\Carousel\Grid\CollectionFactory as CarouselCollectionFactory;

class CarouselDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    
    
    public function __construct($name, 
                                $primaryFieldName, 
                                $requestFieldName, 
                                CarouselCollectionFactory $carouselCollectionFactory, 
                                array $meta = [],
                                array $data = []
            ) {
        $this->collection = $carouselCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }


    /**
* Get data
*
* @return array
*/
public function getData()
{
    if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        //echo "<pre>";
        //die(print_r($items));
        foreach ($items as $employee) {
            $this->_loadedData[$employee->getId()] = $employee->getData();
        }
        /*$temp = array();
        $temp[1]['entity_id']  = 1;
        $temp[1]['image_name'] = 'image 1';
        $temp[2]['entity_id'] = 2;
        $temp[2]['image_name'] = 'image 2';
        //return $temp;
        //echo "<pre>";
        //die(print_r($this->_loadedData));*/
        
        if ( !isset($this->_loadedData) || empty($this->_loadedData))
        {
            return [];
        }
        return $this->_loadedData;
        //return [];
}
}