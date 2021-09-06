<?php

namespace app\modules\page\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\page\models\Page;

class PagesController extends ApiController
{
    public function actionView($alias)
    {
        $page = Page::findOneOrException(['alias' => $alias, 'is_open_by_alias' => true]);

        return [
            'meta' => $page->getMetaTags(),
            'page' => [
                'title' => $page->title,
                'content' => $page->content
            ],
        ];
    }
}