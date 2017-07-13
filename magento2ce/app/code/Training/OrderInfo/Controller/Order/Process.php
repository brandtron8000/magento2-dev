<?php
/**
 *********************************
 * @file: Process.php
 * @author: Brandon Gonzales
 * @copyright: Copyright (c) 2017
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 *********************************
 */

namespace Training\OrderInfo\Controller\Order;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\Manager;
use Magento\Sales\Api\OrderRepositoryInterface;

class Process extends Action
{
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;
    /**
     * @var Manager
     */
    private $msgManager;
    /**
     * @var RedirectFactory
     */
    private $redirectFactory;

    /**
     * Process constructor.
     * @param Context $context
     * @param OrderRepositoryInterface $orderRepository
     * @param RedirectFactory $redirectFactory
     * @param Manager $msgManager
     */
    public function __construct(Context $context,
                                OrderRepositoryInterface $orderRepository,
                                RedirectFactory $redirectFactory,
                                Manager $msgManager
    )
    {
        parent::__construct($context);
        $this->orderRepository = $orderRepository;
        $this->msgManager = $msgManager;
        $this->redirectFactory = $redirectFactory;
    }


    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $redirect = $this->redirectFactory->create();

        $orderId = $this->getRequest()->getParam('order_id');
        if (!$orderId) {
            $redirect->setPath('*/*/index');
            $this->msgManager->addErrorMessage(__('Missing Order ID'));

            return $redirect;
        }

        try {
            $order = $this->orderRepository->get($orderId);
            $status = $order->getStatus();
            $details = [
                'order_id' => $orderId,
                'status' => $status
            ];
            //$ret['order_id'] = $order;
            //$ret['status'] = $order->getStatus();
            // $ret['grand_total'] = $order->getGrandTotal();
            // $ret['total_invoiced'] = $order->getTotalInvoiced();
            // $ret['items'] = $this->getOrderItems($order);
            // $resultJson->setData($ret);
        }
        catch (\Magento\Framework\Exception\NoSuchEntityException $noSuchEntityException) {
            $redirect->setPath('*/*/index');
            $this->msgManager->addErrorMessage(__('Order Not Found'));

            return $redirect;
        }

        $redirect->setPath('*/*/details', $details);

        return $redirect;
    }

    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @return array
     */
    private function getOrderItems($order)
    {
        $items = $order->getItems();
        $ret = [];
        foreach ($items as $item) {
            $retItem['sku'] = $item->getSku();
            $retItem['price'] = $item->getPrice();
            $retItem['item_id'] = $item->getItemId();
            $ret[] = $retItem;
        }
        return $ret;
    }
}