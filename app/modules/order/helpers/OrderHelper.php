<?php

namespace app\modules\order\helpers;

use app\modules\order\models\Order;
use app\modules\order\models\OrderStatus;

class OrderHelper
{
    public static function badge($number)
    {
        if (empty($number)) {
            return '';
        }
        return '<span class="pull-right-container" style="margin-right: 20px"><span class="label label-primary pull-right">' . $number . '</span></span>';
    }

    public static function newCount($type = null)
    {
        return Order::find()->andFilterWhere(['type' => $type])->andWhere(['status' => OrderStatus::NEW])->count('id');
    }

//    public static function getTypeLabel($type)
//    {
//        switch ($type) {
//            case Order::TYPE_CALCULATION: return 'Рассчитать';
//        }
//    }
}