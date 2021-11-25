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
            'api/catalog' => '/api/category/category/catalog',
            'api/catalog/<alias>' => '/api/category/category/categories',
            'api/products/<alias>' => '/api/product/product/products',
            'api/product/<alias>' => '/api/product/product/product',
            'api/services-catalog' => '/api/service-category/service-category/services-catalog',
            'api/service-catalog/<alias>' => '/api/service-category/service-category/service-catalog',
            'api/services/<alias>' => '/api/service/service/services',
            'api/service/<alias>' => '/api/service/service/service',
            'api/calculation/send' => '/api/feedback/feedback/calculation-send',
            'api/faq/send' => '/api/feedback/feedback/faq-send',
            'api/swagger' => '/api/default/swagger',
            'api/layout' => '/api/default/layout',
            'api/contacts' => '/api/default/contacts',
            'api/actions' => 'api/action/action/actions',
            'api/actions/<alias>' => 'api/action/action/action',
            'api/reviews' => '/api/review/review/reviews',
            'api/reviews/send' => '/api/review/review/review-send',
            'api/portfolios' => 'api/portfolio/portfolio/portfolios',
            'api/portfolios/<alias>' => 'api/portfolio/portfolio/portfolio',
            'api/home' => 'api/default/home',
            'api/regions' => 'api/regions/region/regions',
            'api/regions/<alias>' => 'api/regions/region/region',
        ]);
    }
}
