<?php
/**
 *********************************
 * @file: Process.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\Converter\Controller\Display;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Message\Manager;
use Training\Converter\Model\ConverterInterface;

class Process extends Action
{
    /**
     * @var RedirectFactory
     */
    private $redirectFactory;
    /**
     * @var Validator
     */
    private $validator;
    /**
     * @var Manager
     */
    private $msgManager;
    /**
     * @var ConverterInterface
     */
    private $converter;

    /**
     * Process constructor.
     * @param Context $context
     * @param RedirectFactory $redirectFactory
     */

    /**
     * Post constructor.
     * @param Context $context
     * @param RedirectFactory $redirectFactory
     * @param Validator $validator
     * @param Manager $msgManager
     * @param ConverterInterface $converter
     */
    public function __construct(Context $context,
                                RedirectFactory $redirectFactory,
                                Validator $validator,
                                Manager $msgManager,
                                ConverterInterface $converter
    )
    {
        parent::__construct($context);
        $this->redirectFactory = $redirectFactory;
        $this->validator = $validator;
        $this->msgManager = $msgManager;
        $this->converter = $converter;
    }


    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
//        $redirect = $this->redirectFactory->create();
//        $redirect->setPath('*/*/result');
//
//        return $redirect;
        $redirect = $this->redirectFactory->create();
        if (!$this->validator->validate($this->getRequest())) {
            $redirect->setPath('*/*/select');

            return $redirect;
        }

        $amount = $this->getRequest()->getParam('amount');
        $from = $this->getRequest()->getParam('from');
        $to = $this->getRequest()->getParam('to');
        if (!$amount || !$from || !$to) {
            $redirect->setPath('*/*/select');
            $this->msgManager->addErrorMessage(__('Missing parameters'));

            return $redirect;
        }

        try {
            $converterResult = $this->converter->convert($amount, $from, $to);
            $redirect->setPath('*/*/result', $converterResult);

            return $redirect;
        }
        catch (\Exception $e) {
            $redirect->setPath('*/*/select');
            $this->msgManager->addErrorMessage(__('Something went wrong'));

            return $redirect;

        }
    }
}