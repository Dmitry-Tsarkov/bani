<?php

namespace app\modules\kit\helpers;

use app\modules\kit\models\Kit;

class DropDownHelper
{
    public static function priceTypeDropDown()
    {
        return [
            Kit::TYPE_STATIC => '-',
            Kit::TYPE_RANGE => 'От',
        ];
    }
}