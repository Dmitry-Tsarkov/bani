<?php

namespace app\helpers;

class LabelHelpers
{
    public static function label($value, bool $bool)
    {
        if ($bool) {
            return '<label class="label label-success">' . $value . '</label>';
        } else {
            return '<label class="label label-danger">' . $value . '</label>';
        }
    }

    public static function labelForPage($value, bool $bool)
    {
        if ($bool) {
            return '<label class="label label-danger">' . $value . '</label>';
        } else {
            return '<label class="label label-success">' . $value . '</label>';
        }
    }
}