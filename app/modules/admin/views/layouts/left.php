<?php

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
                        'label' => 'Страницы',
                        'icon' => 'files-o',
                        'url' => ['/page/category/default/index'],
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
                            ]
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
