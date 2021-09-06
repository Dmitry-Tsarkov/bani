<?php

namespace app\modules\page\seeders;

use app\modules\page\models\Page;
use app\modules\seeder\components\BaseSeeder;
use yii\helpers\Console;

class PageSeeder extends BaseSeeder
{
    public function seed()
    {
        Console::stdout(PHP_EOL . 'Pages');

        $root = Page::findOne(['depth' => 0]);

        Page::create(
            'index',
            'Главная страница',
            '/',
            false
        )->appendTo($root);
        Console::stdout('.');

        Page::create(
            'about',
            'О компании',
            'about'
        )->appendTo($root);
        Console::stdout('.');

        Page::create(
            'portfolio',
            'Портфолио',
            'portfolio'
        )->appendTo($root);
        Console::stdout('.');

        Page::create(
            'contacts',
            'Контакты',
            'contacts',
            true
        )->appendTo($root);
        Console::stdout('.');

        Page::create(
            'reviews',
            'Отзывы',
            'reviews',
            true
        )->appendTo($root);
        Console::stdout('.');

        Page::create(
            'policy',
            'Политика конфиденциальности',
            'policy',
            true
        )->appendTo($root);
        Console::stdout('.');
    }
}