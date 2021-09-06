<?php

namespace app\modules\category\UI\admin;

use yii\base\Application;
use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->urlManager->addRules([
            'admin/categories' => '/admin/category/category/index',
        ]);
    }
}