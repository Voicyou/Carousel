<?php
namespace Voicyou\Carousel\Block\Adminhtml\Carousel\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Catalog\Block\Adminhtml\Category\AbstractCategory;

/**
 * Class SaveButton
 */
class SaveButton extends AbstractCategory implements ButtonProviderInterface
{
    /**
     * Save button
     *
     * @return array
     */
    public function getButtonData()
    {
        $url = $this->getUrl('*/*/save');
        
            return [
                'label' => __('Save'),
                'class' => 'save primary',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'save']],
                    'form-role' => 'save'
                ],
                'sort_order' => 30,
                'url' => $url
            ];
    }
}

?>