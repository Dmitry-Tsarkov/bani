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
            'api/swagger' => '/api/default/swagger',
            'api/index' => 'api/default/index',
            'api/home' => 'api/default/home',

            'api/catalog' => '/api/category/category/catalog',
            'api/catalog/<alias>' => '/api/category/category/categories',

            'api/products/<alias>' => '/api/product/product/products',
            'api/product/<alias>' => '/api/product/product/product',
            'api/product-order/<alias>' => '/api/product/product/product-order',
            'api/order/send-product' => '/api/order/order/order-product-send',

//            'api/services-catalog' => '/api/service-category/service-category/services-catalog',
//            'api/service-catalog/<alias>' => '/api/service-category/service-category/service-catalog',
//            'api/services/<alias>' => '/api/service/service/services',
//            'api/service/<alias>' => '/api/service/service/service',

            'api/services' => '/api/service/service/services',
            'api/service/<alias>' => '/api/service/service/service',
            'api/service-order/<alias>' => '/api/service/service/service-order',
            'api/order/send-service' => '/api/order/order/order-service-send',

            'api/question/send' => '/api/feedback/feedback/question-send',

            'api/layout' => '/api/default/layout',
            'api/contacts' => '/api/default/contacts',
            'api/actions' => 'api/action/action/actions',
            'api/actions/<alias>' => 'api/action/action/action',

            'api/reviews' => '/api/review/review/reviews',
            'api/reviews/send' => '/api/review/review/review-send',

            'api/portfolios' => 'api/portfolio/portfolio/portfolios',
            'api/portfolios/<alias>' => 'api/portfolio/portfolio/portfolio',

            'api/regions' => 'api/regions/region/regions',
            'api/regions/<alias>' => 'api/regions/region/region',

            'api/calculators/<id>' => 'api/calculator/calculator/calculator',
            'api/calculators' => 'api/calculator/calculator/calculators',

            '/api/pages/<alias>' => '/api/page/pages/view',
        ]);
    }
}
