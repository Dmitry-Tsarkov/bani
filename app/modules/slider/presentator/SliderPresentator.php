<?php

namespace app\modules\slider\presentator;

use app\modules\slider\models\Slide;
use app\modules\slider\readModels\SliderReader;
use yii\helpers\Url;

class SliderPresentator
{
    private $slides;

    public function __construct(SliderReader $slides)
    {
        $this->slides = $slides;
    }

    public function getSlides()
    {
        $slides = $this->slides->getSlides();

        return array_map(function (Slide $slide) {
            return [
                'id' => $slide->id,
                'title' => $slide->title,
                'description' => $slide->description,
                'image' => Url::to($slide->getImageFileUrl('image'), true),
            ];
        }, $slides);
    }
}