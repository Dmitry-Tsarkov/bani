<?php

namespace app\modules\order\services\services;

use app\modules\order\models\OrderStatus;
use app\modules\order\repositories\OrderRepository;

class OrderManageService
{
    private $orders;

    public function __construct(OrderRepository $orders)
    {
        $this->orders = $orders;
    }

    public function changeStatus($id, $status)
    {
        $order = $this->orders->getById($id);
        $order->changeStatus(
            new OrderStatus($status)
        );
        $this->orders->save($order);
    }
}