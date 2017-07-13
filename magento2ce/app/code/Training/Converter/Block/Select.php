<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/12/17
 * Time: 9:54 AM
 */

namespace Training\Converter\Block;


use Magento\Framework\View\Element\Template;

class Select extends Template
{
    /**
     * @return string
     */
    public function getFormAction()
    {
        // return $this->getUrl('converter/display/post');
//        return $this->getUrl('*/*/post');
        return $this->getUrl('*/*/process');
    }

    /**
     * Get convertible currencies
     *
     * @return array
     */
    public function getCurrencies()
    {
        return [
            'USD', 'EUR', 'INR'
        ];
    }
}