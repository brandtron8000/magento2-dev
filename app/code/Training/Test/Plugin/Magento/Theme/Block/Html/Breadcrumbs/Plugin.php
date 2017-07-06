<?php

namespace Training\Test\Plugin\Magento\Theme\Block\Html\Breadcrumbs;

class Plugin
{
    public function beforeaddCrumb(\Magento\Theme\Block\Html\Breadcrumbs $subject, $crumbName, $crumbInfo)
    {
      if(is_string($crumbInfo['label']))
          $crumbInfo['label'] = $crumbInfo['label'].'\m/';

      return [$crumbName,$crumbInfo];
    }
}
