<?php
/**
* Product controller.
* Copyright © 2015 Magento. All rights reserved.
* See COPYING.txt for license details.
*/
namespace Training\Test\Controller\Adminhtml\Action;

class Index extends \Magento\Backend\App\Action
{
  /**
  * Test action index
  */
  public function execute() {
    $this->getResponse()->appendBody("HELLO WORLD");
  }
  /**
  * Check if admin has permissions to visit related pages
  *
  * @return bool
  */
  protected function _isAllowed() {
    $secret = $this->getRequest()->getParam('secret');
    return isset($secret) && (int)$secret==1;
  }
}
