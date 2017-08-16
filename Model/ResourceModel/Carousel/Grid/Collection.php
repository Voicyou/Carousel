<?php
namespace Voicyou\Carousel\Model\ResourceModel\Carousel\Grid;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected function _construct()
    {
        $this->_init('Voicyou\Carousel\Model\Carousel', 'Voicyou\Carousel\Model\ResourceModel\Carousel');
    }
}