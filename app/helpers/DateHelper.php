<?php

namespace app\helpers;

use app\modules\action\models\Action;
use DateTime;
use yii\helpers\VarDumper;

class DateHelper
{
    public static function forHuman($timestamp, $format = 'd n Y')
    {
        $format = str_replace('n', self::getMonthName(date('n', $timestamp)), $format);
        return date($format, $timestamp);
    }

    public static function forHumanMounth($timestamp, $format = 'd n')
    {
        $format = str_replace('n', self::getMonthName(date('n', $timestamp)), $format);
        return date($format, $timestamp);
    }

    public static function forHumanShortMonth($timestamp)
    {
        return date('d', $timestamp) . ' ' . self::getShortMonthName(date('n', $timestamp)) . ' ' . date('Y', $timestamp);
    }

    public static function forHumanNumberMonth(int $timestamp)
    {
        return date('d', $timestamp) . '.' . self::getNumberMonthName(date('n', $timestamp)) . '.' . date('Y', $timestamp);
    }

    public static function forRobot($timestamp)
    {
        return date('Y-m-d', $timestamp);
    }

    public static function forRobotTime($timestamp)
    {
        return date('H:i:s', $timestamp);
    }

    private static function getMonthName($number)
    {
        $array = [
            1 => 'января',
            2 => 'февраля',
            3 => 'марта',
            4 => 'апреля',
            5 => 'мая',
            6 => 'июня',
            7 => 'июля',
            8 => 'августа',
            9 => 'сентября',
            10 => 'октября',
            11 => 'ноября',
            12 => 'декабря',
        ];

        return $array[$number];
    }

    private static function getShortMonthName($number)
    {
        $array = [
            1 => 'янв',
            2 => 'фев',
            3 => 'мар',
            4 => 'апр',
            5 => 'май',
            6 => 'июн',
            7 => 'июл',
            8 => 'авг',
            9 => 'сен',
            10 => 'окт',
            11 => 'ноя',
            12 => 'дек',
        ];

        return $array[$number];
    }

    private static function getNumberMonthName($number)
    {
        $array = [
            1 => '01',
            2 => '02',
            3 => '03',
            4 => '04',
            5 => '05',
            6 => '06',
            7 => '07',
            8 => '08',
            9 => '09',
            10 => '10',
            11 => '11',
            12 => '12',
        ];

        return $array[$number];
    }

    public static function current()
    {
        $now = new DateTime();

        return 'ГРЮН ' . $now->format('Y') . ' (с)';
    }

    public static function getActivityTime(Action $action)
    {
        if (!$action->active_to && $action->active_from) {
            return 'С ' . DateHelper::forHuman($action->active_to, 'd n Y');;
        } elseif ($action->active_to && !$action->active_from) {
            return 'До ' . DateHelper::forHuman($action->active_from, 'd n Y');;
        } elseif ($action->active_to - $action->active_from != 0) {
            return 'С ' . DateHelper::forHuman($action->active_from, 'd n Y') .
                ' по ' . DateHelper::forHuman($action->active_to, 'd n Y');
        }
        return 'бессрочная';
    }

    public static function getAmountOfYearsSince($since): string
    {
        return floor((time()-mktime(0, 0, 0, 0, 1, $since))/(60*60*24*365));
    }
}
