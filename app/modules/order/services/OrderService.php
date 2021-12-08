<?php


namespace app\modules\order\services;


use app\modules\order\forms\ProductOrderForm;
use app\modules\order\models\Order;
use app\modules\order\repositories\OrderRepository;
use app\modules\order\forms\ServiceOrderForm;

class OrderService
{
    private $orders;
    private $mailer;

    public function __construct(OrderRepository $orders, MailerService $mailer)
    {
        $this->orders = $orders;
        $this->mailer = $mailer;
    }

    public function orderProductSend(ProductOrderForm $form)
    {
        $order = Order::product(
            $form->product_id,
            $form->name,
            $form->phone,
            $form->email,
            $form->comment,
            $form->additional_params
        );

        $this->orders->save($order);
        $this->mailer->productOrderSend($order);

        return $order;
    }

    public function orderServiceSend(ServiceOrderForm $form)
    {
        $order = Order::service(
            $form->service_id,
            $form->name,
            $form->phone,
            $form->email,
            $form->comment
        );

        $this->orders->save($order);
        $this->mailer->serviceOrderSend($order);

        return $order;
    }
}