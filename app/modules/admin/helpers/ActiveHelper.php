<?php


namespace app\modules\admin\helpers;


class ActiveHelper
{
    public static function getActiveFromText($date)
    {
        $formatted = !empty($date)? date('d.m.Y H:i', $date) : '-';

        if (!empty($date) && $date > time()) {
            return '<span class="text-danger">' . $formatted . '</span>';
        } else {
            return '<span>' . $formatted . '</span>';
        }
    }

    public static function getActiveToText($date)
    {
        $formatted = !empty($date)? date('d.m.Y H:i', $date) : '-';

        if (!empty($date) && $date < time()) {
            return '<span class="text-danger">' . $formatted . '</span>';
        } else {
            return '<span>' . $formatted . '</span>';
        }
    }
}