<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/12/17
 * Time: 11:00 AM
 */

namespace Training\Converter\Block;


use Magento\Framework\View\Element\Template;

class Result extends Template
{
    public function getAmount()
    {
        return $this->getRequest()->getParam('amount');
    }

    public function getFrom()
    {
        return $this->getRequest()->getParam('from');
    }

    public function getTo()
    {
        return $this->getRequest()->getParam('to');
    }

    public function getResult()
    {
        return $this->getRequest()->getParam('result');
    }

}