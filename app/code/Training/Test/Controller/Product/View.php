<?php
namespace Training\Test\Controller\Product;

class View extends \Magento\Framework\App\Action\Action
{
  public function execute() {
    $helloooo = "<img src='https://media.tenor.com/images/44dbcd137f211757d0685e7d41d694aa/tenor.gif'>";
    echo $helloooo; exit;
  }
  public function beforeExecute() {
    //echo "BEFORE<BR>"; exit;
  }
  public function afterExecute(\Magento\Catalog\Controller\Product\View $controller,
  $result) {
    //echo "AFTER"; exit;
  }
}
