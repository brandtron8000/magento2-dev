<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/11/17
 * Time: 3:57 PM
 */

namespace Training\Converter\Controller\Display;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Training\Converter\Model\ConverterInterface;

class Rates extends Action
{
    /**
     * @var Context
     */
    private $context;
    /**
     * @var JsonFactory
     */
    private $jsonFactory;
    /**
     * @var ConverterInterface
     */
    private $converter;

    /**
     * Rates constructor.
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param ConverterInterface $converter
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        ConverterInterface $converter
    )
    {
        parent::__construct($context);
        $this->context = $context;
        $this->jsonFactory = $jsonFactory;
        $this->converter = $converter;
    }


    /**
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute() {

        $URL_a = $this->getRequest()->getParam('amount');
        $URL_from = $this->getRequest()->getParam('from');
        $URL_to = $this->getRequest()->getParam('to');

        $resultJson = $this->jsonFactory->create();

        $converted = $this->converter->convert($URL_a, $URL_from, $URL_to);

        $resultJson->setData($converted);

        return $resultJson;
    }

}