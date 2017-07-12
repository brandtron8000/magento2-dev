<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/11/17
 * Time: 1:30 PM
 */

namespace Training\OrderInfo\Controller\View;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Sales\Api\OrderRepositoryInterface;

class Order extends Action
{
    /**
     * @var JsonFactory
     */
    private $jsonFactory;
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * Order constructor.
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        OrderRepositoryInterface $orderRepository
    )
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->orderRepository = $orderRepository;
    }


    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();

        $orderId = $this->getRequest()->getParam('order_id');
        if (!$orderId) {
            $msg = ['error' => __('Order ID Missing')];
            $resultJson->setData($msg);

            return $resultJson;
        }

        try {
            $order = $this->orderRepository->get($orderId);
            $ret['status'] = $order->getStatus();
            $ret['grand_total'] = $order->getGrandTotal();
            $ret['total_invoiced'] = $order->getTotalInvoiced();
            $ret['items'] = $this->getOrderItems($order);
            $resultJson->setData($ret);
        }
        catch (\Magento\Framework\Exception\NoSuchEntityException $noSuchEntityException) {
            $msg = ['error' => __('Order Not Found')];
            $resultJson->setData($msg);
        }

        return $resultJson;
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