<?php

use app\modules\feedback\helpers\FeedbackHelper;
use app\modules\review\helpers\ReviewHelper;
use dmstr\widgets\Menu;

?>

<aside class="main-sidebar">
    <section class="sidebar">
        <?= Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => 'Главная',
                        'icon' => 'home',
                        'url' => Yii::$app->getHomeUrl(),
                    ],
                    [
                        'label' => 'Заявки ' . FeedbackHelper::badge(FeedbackHelper::newCount()),
                        'icon' => 'bell-o',
                        'url' => ['/admin/feedback/calculation/index'],
                    ],
                    [
                        'label' => 'Страницы',
                        'icon' => 'files-o',
                        'url' => ['/page/backend/default/index'],
                    ],
                    [
                        'label' => 'Товары',
                        'items' => [
                            [
                                'label' => 'Категории',
                                'url' => ['/admin/category/category/index'],
                                'active' => Yii::$app->controller->module->id == 'category' ,
                            ],
                            [
                                'label' => 'Товары',
                                'url' => ['/admin/product/product/index'],
                                'active' => (Yii::$app->controller->module->id == 'product'),
                            ],
                            [
                                'label' => 'Характеристики',
                                'url' => ['/admin/characteristic/characteristic/index'],
                                'active' => Yii::$app->controller->module->id == 'characteristic',
                            ],
                            [
                                'label' => 'Комплекты',
                                'url' => ['/admin/kit/kit/index'],
                                'active' => Yii::$app->controller->module->id == 'kit',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Услуги',
                        'items' => [
                            [
                                'label' => 'Категории',
                                'url' => ['/admin/service-category/service-category/index'],
                                'active' => Yii::$app->controller->module->id == 'service-category' ,
                            ],
                            [
                                'label' => 'Услуги',
                                'url' => ['/admin/service/service/index'],
                                'active' => (Yii::$app->controller->module->id == 'service'),
                            ],
                        ],
                    ],
                    [
                        'label' => 'Контент',
                        'icon' => 'newspaper-o',
                        'items' => [
                            [
                                'label' => 'Слайдер',
                                'url' => ['/admin/slider/slider/index'],
                                'active' => Yii::$app->controller->module->id == 'slider',
                            ],
                            [
                                'label' => 'Акции',
                                'url' => ['/admin/action/action/index'],
                                'active' => Yii::$app->controller->module->id == 'action',
                            ],
                            [
                                'label' => 'Отзывы' . ReviewHelper::badge(ReviewHelper::countNewReviews()),
                                'url' => ['/admin/review/review/index'],
                                'active' => Yii::$app->controller->module->id == 'review',
                            ],
                            [
                                'label' => 'Портфолио',
                                'url' => ['/admin/portfolio/portfolio/index'],
                                'active' => Yii::$app->controller->module->id == 'portfolio',
                            ],
                            [
                                'label' => 'FAQ',
                                'url' => ['/admin/faq/faq/index'],
                                'active' => Yii::$app->controller->module->id == 'faq',
                            ],
                            [
                                'label' => 'Регионы',
                                'url' => ['/admin/region/region/index'],
                                'active' => Yii::$app->controller->module->id == 'region',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Настройки',
                        'icon' => 'cogs',
                        'items' => [
                            [
                                'label' => 'Пользователи',
                                'icon' => 'users',
                                'url' => ['/user/backend/index'],
                                'active' => Yii::$app->controller->module->id == 'user',
                            ],
                            [
                                'label' => 'Настройки',
                                'icon' => 'cog',
                                'url' => ['/setting/backend/default/index'],
                                'active' => Yii::$app->controller->module->id == 'setting',
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>
    </section>
</aside>
