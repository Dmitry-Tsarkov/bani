<?php


namespace app\modules\service\helpers;


use app\modules\service\models\Service;

class DropDownHelper
{
    public static function statusDropDown()
    {
        return [
            Service::STATUS_DRAFT => 'Неактивный',
            Service::STATUS_ACTIVE => 'Активный',
        ];
    }

    public static function priceTypeDropDown()
    {
        return [
            Service::TYPE_STATIC => '-',
            Service::TYPE_RANGE => 'От',
        ];
    }
}