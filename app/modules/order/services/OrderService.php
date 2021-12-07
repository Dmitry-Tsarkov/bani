<?php


namespace app\modules\order\services;


use app\modules\order\forms\OrderForm;
use app\modules\order\models\Order;
use app\modules\order\repositories\OrderRepository;

class OrderService
{
    private $orders;
    private $mailer;

    public function __construct(OrderRepository $orders, MailerService $mailer)
    {
        $this->orders = $orders;
        $this->mailer = $mailer;
    }

    public function orderSend(OrderForm $form)
    {
        $order = Order::create(
            $form->product_id,
            $form->name,
            $form->phone,
            $form->email,
            $form->comment,
            $form->additional_params
        );

        $this->orders->save($order);
        $this->mailer->orderSend($order);

        return $order;
    }
}