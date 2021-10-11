<?php

use app\modules\feedback\helpers\FeedbackHelper;
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
                        'label' => 'Каталог',
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
                        ],
                    ],
                    [
                        'label' => 'Контент',
                        'icon' => 'newspaper-o',
                        'items' => [
                            [
                                'label' => 'Меню',
                                'icon' => 'arrows-h',
                                'url' => ['/admin/menu/category/index'],
                                'active' => Yii::$app->controller->module->id == 'menu',
                            ],
                            [
                                'label' => 'Слайдер',
                                'url' => ['/admin/slider/slider/index'],
                                'active' => Yii::$app->controller->module->id == 'slider',
                            ],
                            [
                                'label' => 'Акции',
                                'icon' => 'star',
                                'url' => ['/admin/action/backend/index'],
                                'active' => Yii::$app->controller->module->id == 'action',
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
                                'url' => ['/user/category/index'],
                                'active' => Yii::$app->controller->module->id == 'user',
                            ],
                            [
                                'label' => 'Настройки',
                                'icon' => 'cog',
                                'url' => ['/setting/category/default/index'],
                                'active' => Yii::$app->controller->module->id == 'setting',
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>
    </section>
</aside>
