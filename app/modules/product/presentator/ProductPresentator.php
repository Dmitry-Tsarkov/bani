<?php

namespace app\modules\product\presentator;

use app\modules\category\repositories\CategoryRepository;
use app\modules\product\models\Product;
use app\modules\product\repositories\ProductRepository;

class ProductPresentator
{
    private $categories;
    private $products;

    public function __construct(CategoryRepository $categories, ProductRepository $products)
    {
        $this->categories = $categories;
        $this->products = $products;
    }

    public function getProducts($alias)
    {
        $category = $this->categories->getByAlias($alias);
        $products = $category->products;

        return [
            'products' => array_map(function (Product $product) {
                return [
                    'meta' => $product->getMetaTags(),
                    'id' => $product->id,
                    'alias' => $product->alias,
                    'title' => $product->title,
                    'description' => $product->description,
                ];
            }, $products)
        ];
    }
}