<?php

namespace app\modules\product\presentator;

use app\modules\category\repositories\CategoryRepository;
use app\modules\characteristic\models\Value;
use app\modules\product\models\Product;
use app\modules\product\models\ProductImage;
use app\modules\product\repositories\ProductRepository;
use yii\helpers\Url;

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
            'prices' => array_map(function (Product $product) {
                return [
                    'title' => $product->title,
                    'price_type' => $product->getPriceType(),
                    'price' => $product->price
                ];
            }, $products),
            'products' => array_map(function (Product $product) {
                return [
                    'meta' => $product->getMetaTags(),
                    'id' => $product->id,
                    'alias' => $product->alias,
                    'title' => $product->title,
                    'description' => $product->description,
                    'images' => array_map(function (ProductImage $image) {
                        return [
                            'image' => Url::to($image->getImageFileUrl('image'), true),
                        ];
                    }, $product->images),
                    'characteristics' => array_map(function (Value $value) {
                        return [
                            'id' => $value->characteristic->id,
                            'characteristic' => $value->getLabel(),
                            'value' => $value->getText(),
                            'unit' => $value->getUnit(),
                        ];
                    }, $product->values)
                ];
            }, $products)
        ];
    }
}