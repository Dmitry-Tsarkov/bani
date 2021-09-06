<?php


namespace app\modules\product\helpers;


use app\modules\product\models\Product;

class DropDownHelper
{
    public static function statusDropDown()
    {
        return [
            Product::STATUS_DRAFT => 'Неактивный',
            Product::STATUS_ACTIVE => 'Активный',
        ];
    }

    public static function priceTypeDropDown()
    {
        return [
            Product::TYPE_STATIC => '-',
            Product::TYPE_RANGE => 'От',
        ];
    }
}