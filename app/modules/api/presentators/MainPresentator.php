<?php

namespace app\modules\api\presentators;


use app\helpers\DateHelper;
use app\modules\menu\readModels\MenuItemReader;
use app\modules\page\models\Page;
use app\modules\setting\components\Settings;

class MainPresentator
{
    private $menuItems;


    public function __construct(
        MenuItemReader $menuItems
    )
    {
        $this->menuItems = $menuItems;
    }


    public function getIndex()
    {
        $page = Page::getOrCreate('index');
        return [
            'meta' => $page->getMetaTags(),
            'main_slider' => $this->mainSliderPresentator->getMainSlides(),
            'subcategories' => $this->categoryPresentator->getAllSubcategories(),
            'slider' => $this->sliderPresentator->getSlides(),
            'counters' => [
                'years' => DateHelper::getAmountOfYearsSince(Settings::getRealValue('years')),
            ],
            'doctors' => $this->doctorPresentator->getPreviewDoctors(),
            'reviews' => $this->reviewPresentator->getPreviewReviews(),
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