<?php

namespace app\modules\product\presentator;

use app\modules\category\repositories\CategoryRepository;
use app\modules\characteristic\models\Value;
use app\modules\kit\models\Kit;
use app\modules\product\models\Product;
use app\modules\product\models\ProductImage;
use app\modules\product\repositories\ProductRepository;
use yii\helpers\Url;
use yii\helpers\VarDumper;

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
                    'alias' => $product->alias,
                    'title' => $product->title,
                    'price_type' => $product->getPriceType(),
                    'price' => $product->price,
                    'image' => $product->getFirstImage(),
                ];
            }, $products)
        ];
    }

    public function getProduct($alias)
    {
        $product = $this->products->getByAlias($alias);

        return [
            'meta' => $product->getMetaTags(),
            'product' => [
                'id' => $product->id,
                'category_alias' => $product->category->alias,
                'alias' => $product->alias,
                'title' => $product->title,
                'description' => $product->description,
                'bottom_description' => $product->bottom_description,
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
                }, $product->values),
                'kits' => array_map(function (Kit $kit) {
                    return [
                        'id' => $kit->id,
                        'title' => $kit->title,
                        'text' => $kit->text,
                        'bottom_text' => $kit->bottom_text,
                        'price_type' => $kit->getPriceType(),
                        'price' => $kit->price
                    ];
                }, $product->kits)
            ],
        ];
    }
}