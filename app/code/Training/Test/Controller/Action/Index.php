<?php
/**
* Product controller.
* Copyright © 2015 Magento. All rights reserved.
* See COPYING.txt for license details.
*/
namespace Training\Test\Controller\Action;
class Index extends \Magento\Framework\App\Action\Action
{
  public function execute() {
    $helloooo = "<img src='https://media.tenor.com/images/44dbcd137f211757d0685e7d41d694aa/tenor.gif'>";
    $this->getResponse()->appendBody($helloooo);
  }
}
