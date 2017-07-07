<?php
namespace Training\Test\Controller;

class NoRouteHandler implements \Magento\Framework\App\Router\NoRouteHandlerInterface {
  public function process(\Magento\Framework\App\RequestInterface $request) {
    $moduleName = 'test';
    $controllerName = 'action';
    $actionName = 'config';
    $request
    ->setModuleName($moduleName)
    ->setControllerName($controllerName)
    ->setActionName($actionName);
    return true;
  }
}
