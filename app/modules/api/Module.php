<?php

namespace app\modules\api;

use yii\base\BootstrapInterface;
use yii\filters\Cors;

/**
 * @OA\Info(title="My First API", version="0.1")
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    public function behaviors()
    {
        return [
            [
                'class' => Cors::className(),
            ]
        ];
    }

    public function bootstrap($app)
    {
        $app->urlManager->addRules([
            'api/index' => 'api/default/index',
            'api/categories' => '/api/category/category/categories',
//            'api/categories/<alias>' => '/api/category/category/category',
            'api/projects/<alias>' => '/api/category/category/projects',
            'api/products/<alias>' => '/api/product/product/products',

            'api/swagger' => '/api/default/swagger',
        ]);
    }
}
