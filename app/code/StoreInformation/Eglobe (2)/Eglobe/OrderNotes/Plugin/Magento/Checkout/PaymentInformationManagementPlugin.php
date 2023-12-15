<?php
namespace Eglobe\OrderNotes\Plugin\Magento\Checkout;

class PaymentInformationManagementPlugin
{
    protected $orderRepository;

    public function __construct(
    \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
    ) {
    $this->orderRepository = $orderRepository;
    }

    public function afterSavePaymentInformationAndPlaceOrder(
        \Magento\Checkout\Model\PaymentInformationManagement $subject,
        $result,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $billingAddress = null
        ) {
            if($result){

            $order = $this->orderRepository->get($result);
            $orderComment =$paymentMethod->getExtensionAttributes();
            if ($orderComment->getComment())
                $comment = trim($orderComment->getComment());

            else
                $comment = '';
            
            $history = $order->addStatusHistoryComment($comment);
            $history->setIsVisibleOnFront(1);
            $history->save();
            $order->setCustomerNote($comment);
            $order->save();
        }

    return $result;
    }
}