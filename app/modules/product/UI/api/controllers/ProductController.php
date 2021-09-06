<?php

namespace app\modules\product\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\product\presentator\ProductPresentator;

class ProductController extends ApiController
{
    private $productPresentator;

    public function __construct($id, $module, ProductPresentator $productPresentator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->productPresentator = $productPresentator;
    }

    public function actionProducts($alias)
    {
        return $this->productPresentator->getProducts($alias);
    }
}