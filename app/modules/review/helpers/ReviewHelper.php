<?php

namespace app\modules\review\helpers;

use app\modules\review\models\Review;

class ReviewHelper
{
    public static function statusDropDown()
    {
        return [
            Review::STATUS_DRAFT => 'Неактивный',
            Review::STATUS_ACTIVE => 'Активен',
        ];
    }

    public static function countNewReviews()
    {
        return Review::find()->andWhere(['status' => Review::STATUS_DRAFT])->count();
    }

    public static function badge($number)
    {
        if (empty($number)) {
            return '';
        }
        return '<span class="pull-right-container" style="margin-right: 20px"><span class="label label-primary pull-right">' . $number . '</span></span>';
    }
}