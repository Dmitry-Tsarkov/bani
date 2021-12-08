<?php

namespace app\modules\order\presentators;

use app\modules\product\models\Addition;
use app\modules\product\readModels\ProductReader;
use app\modules\service\readModels\ServiceReader;

class OrderPresentator
{
    private $products;
    private $services;

    public function __construct(ProductReader $products, ServiceReader $services)
    {
        $this->products = $products;
        $this->services = $services;
    }

    public function getProductOrder($alias)
    {
        $product = $this->products->getByAlias($alias);

        return [
            'product' => [
                'id' => $product->id,
                'title' => $product->title
            ],
            'additional_params' => array_map(function (Addition $addition){
                return [
                    'id' => $addition->id,
                    'title' => $addition->title,
                ];
            }, $product->additions)
        ];
    }

    public function getServiceOrder($alias)
    {
        $service = $this->services->getByAlias($alias);

        return [
            'service' => [
                'id' => $service->id,
                'title' => $service->title
            ],
        ];
    }
}