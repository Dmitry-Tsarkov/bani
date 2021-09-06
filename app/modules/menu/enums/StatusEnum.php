<?php


namespace app\modules\menu\enums;


class StatusEnum
{
    public const NOT_ACTIVE = 0;
    public const IS_ACTIVE = 1;

    public static function list()
    {
        return [
            self::NOT_ACTIVE => 'Неактивный',
            self::IS_ACTIVE => 'Активный'
        ];
    }

    public static function getStatus($status)
    {
        switch ($status) {
            case self::IS_ACTIVE:
                return 'Активный';
            case self::NOT_ACTIVE:
                return 'Неактивный';
        }
        return '';
    }
}