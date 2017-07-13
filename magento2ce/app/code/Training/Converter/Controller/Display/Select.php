<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/12/17
 * Time: 9:51 AM
 */

namespace Training\Converter\Controller\Display;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Select extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * Select constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }


    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $page = $this->pageFactory->create();

        return $page;
    }
}