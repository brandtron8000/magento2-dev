<?php
/**
* Product controller.
*
* @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
*/

namespace Training\Test\Controller\Action;

class Config extends \Magento\Framework\App\Action\Action
{
  public function execute() {
    $helloooo = "<img src='https://media.tenor.com/images/44dbcd137f211757d0685e7d41d694aa/tenor.gif'>";
    $testConfig = $this->_objectManager->get('Training\Test\Model\Config\ConfigInterface');
    $myNodeInfo = $testConfig->getMyNodeInfo();
    if (is_array($myNodeInfo)) {
      foreach($myNodeInfo as $str) {
        $this->getResponse()->appendBody($str . "<BR>" . $helloooo . "<BR>");
      }
    }
  }
}
