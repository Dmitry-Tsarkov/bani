<?php

namespace app\modules\api\presentators;

use app\helpers\DateHelper;
use app\modules\menu\readModels\MenuItemReader;
use app\modules\page\models\Page;
use app\modules\setting\components\Settings;
use app\modules\slider\presentator\SliderPresentator;

class MainPresentator
{
    private $menuItems;
    /**
     * @var SliderPresentator
     */
    private $sliderPresentator;

    public function __construct(
        MenuItemReader $menuItems,
        SliderPresentator $sliderPresentator
    )
    {
        $this->menuItems = $menuItems;
        $this->sliderPresentator = $sliderPresentator;
    }


    public function getIndex()
    {
        $page = Page::getOrCreate('index');

        return [
            'meta' => $page->getMetaTags(),
            'slider' => $this->sliderPresentator->getSlides(),
        ];
    }

    public function getLayout()
    {
        return [
            'top_menu' => $this->menuItems->getMenuItems(),
            'header' => [
                'weekdays_worktime' => Settings::getValue('weekdays_worktime'),
                'weekend_worktime' => Settings::getValue('weekend_worktime'),
                'address' => Settings::getArray('header_address'),
                'socials' => [
                    'vk' => Settings::getValue('vk'),
                    'instagram' => Settings::getValue('instagram'),
                ],
                'phones' => Settings::getArray('header_phones'),
            ],
            'footer' => [
                'copyright' => Settings::getValue('copyright'),
            ],
        ];
    }
}