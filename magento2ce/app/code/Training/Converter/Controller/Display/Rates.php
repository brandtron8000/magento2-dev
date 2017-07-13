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

        $resultJson = $this->jsonFactory->create();

        $amount = $this->getRequest()->getParam('amount');
        if (!$amount) {
            $result['error'] = __('Missing parameter');
            $resultJson->setData($result);

            return $resultJson;
        }

        $from = $this->getRequest()->getParam('from', 'USD');
        $to = $this->getRequest()->getParam('to', 'EUR');

        try {
            $converted = $this->converter->convert($amount, $from, $to);
        }
        catch (\Exception $e) {
            $converted['error'] = __('There was an error processing your request');
        }

        $resultJson->setData($converted);

        return $resultJson;
    }

}