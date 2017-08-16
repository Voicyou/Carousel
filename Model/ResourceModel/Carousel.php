<?php

namespace Voicyou\Carousel\Model\ResourceModel;

class Carousel extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('voicyou_carousel_images', 'id');
    }
}

?>