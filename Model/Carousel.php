<?php

namespace Voicyou\Carousel\Model;

class Carousel extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Voicyou\Carousel\Model\ResourceModel\Carousel');
    }
}

?>