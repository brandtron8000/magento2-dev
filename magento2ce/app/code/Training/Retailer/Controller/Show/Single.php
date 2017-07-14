<?php
/**
 *********************************
 * @file: Single.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\Retailer\Controller\Show;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Training\Retailer\Model\RetailerFactory;

class Single extends Action
{
    /**
     * @var JsonFactory
     */
    private $jsonFactory;
    /**
     * @var RetailerFactory
     */
    private $retailerFactory;

    /**
     * Single constructor.
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param RetailerFactory $retailerFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        RetailerFactory $retailerFactory
    )
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->retailerFactory = $retailerFactory;
    }


    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $json = $this->jsonFactory->create();
        $retailerId = $this->getRequest()->getParam('retailer_id');

        /** @var \Training\Retailer\Model\Retailer $retailer */
        $retailer = $this->retailerFactory->create();
        $retailer->load($retailerId);
        $ret = $retailer->getData();


        $json->setData($ret);

        return $json;
    }
}