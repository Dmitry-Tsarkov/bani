<?php

namespace app\modules\slider\readModels;

use app\modules\slider\models\Slide;

class SliderReader
{
    public function getSlides()
    {
        return Slide::find()
            ->andWhere(['status' => Slide::STATUS_ACTIVE])
            ->all();
    }
}