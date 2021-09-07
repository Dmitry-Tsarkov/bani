<?php


namespace app\modules\slider\helpers;


use app\modules\slider\models\Slide;

class DropdownHelper
{
    public static function statusDropDown()
    {
        return [
            Slide::STATUS_DRAFT => 'Неактивный',
            Slide::STATUS_ACTIVE => 'Активный',
        ];
    }
}