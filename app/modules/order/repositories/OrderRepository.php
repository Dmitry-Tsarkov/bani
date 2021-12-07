<?php

namespace app\modules\order\repositories;

use app\modules\order\models\Order;
use DomainException;
use RuntimeException;

class OrderRepository
{
    public function save(Order $order)
    {
        if (!$order->save()) {
            throw new RuntimeException('Order saving error');
        }
    }

    public function delete(Order $order): void
    {
        if (!$order->delete()) {
            throw new RuntimeException('Order deleting error');
        }
    }

    public function getById($id): Order
    {
        $order = Order::find()->andWhere(['id' => $id])->limit(1)->one();

        if ($order === null) {
            throw new DomainException('Order not found');
        }

        return $order;
    }
}