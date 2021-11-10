<?php

namespace app\modules\api\presentators;

use app\helpers\DateHelper;
use app\modules\menu\readModels\MenuItemReader;
use app\modules\page\models\Page;
use app\modules\portfolio\models\Portfolio;
use app\modules\portfolio\readModels\PortfolioReadRepository;
use app\modules\setting\components\Settings;
use app\modules\slider\presentator\SliderPresentator;
use yii\helpers\Url;

class MainPresentator
{
    private $menuItems;
    /**
     * @var SliderPresentator
     */
    private $sliderPresentator;
    private $portfolios;

    public function __construct(
        MenuItemReader $menuItems,
        SliderPresentator $sliderPresentator,
        PortfolioReadRepository $portfolios
    )
    {
        $this->menuItems = $menuItems;
        $this->sliderPresentator = $sliderPresentator;
        $this->portfolios = $portfolios;
    }


    public function getIndex()
    {
        $page = Page::getOrCreate('index');

        return [
            'meta' => $page->getMetaTags(),
            'slider' => $this->sliderPresentator->getSlides(),
        ];
    }

//    public function getLayout()
//    {
//        return [
//            'top_menu' => $this->menuItems->getMenuItems(),
//            'header' => [
//                'weekdays_worktime' => Settings::getValue('weekdays_worktime'),
//                'weekend_worktime' => Settings::getValue('weekend_worktime'),
//                'address' => Settings::getArray('header_address'),
//                'socials' => [
//                    'vk' => Settings::getValue('vk'),
//                    'instagram' => Settings::getValue('instagram'),
//                ],
//                'phones' => Settings::getArray('header_phones'),
//            ],
//            'footer' => [
//                'copyright' => Settings::getValue('copyright'),
//            ],
//        ];
//    }

    public function getHome()
    {
        $page = Page::getOrCreate('index');

        return [
            'meta' => $page->getMetaTags(),
            'about' => [
                'image' => Settings::getValue('about_image'),
                'text' => Settings::getValue('about'),
            ],
            'portfolio' => array_map(function (Portfolio $portfolio){
                return [
                  'image' => Url::to($portfolio->getImageFileUrl('image'), true),
                  'alias' => $portfolio->alias,
                ];
            }, $this->portfolios->getPreviewPortfolio()),
            'advantages' => [
                'description' => Settings::getValue('advantages')
            ]
        ];

    }
}