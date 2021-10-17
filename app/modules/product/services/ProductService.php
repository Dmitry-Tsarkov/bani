<?php

namespace app\modules\product\services;

use app\modules\category\repositories\CategoryRepository;
use app\modules\characteristic\repositories\CharacteristicRepository;
use app\modules\product\forms\ImagesForm;
use app\modules\product\forms\ProductForm;
use app\modules\product\forms\ValueForm;
use app\modules\product\models\Product;
use app\modules\product\models\ProductImage;
use app\modules\product\repositories\ProductRepository;
use app\modules\seo\valueObjects\Seo;
use DomainException;

class ProductService
{
    private $products;
    private $categories;
    private $characteristics;

    public function __construct(
        ProductRepository $products,
        CategoryRepository $categories,
        CharacteristicRepository $characteristics)
    {
        $this->products = $products;
        $this->categories = $categories;
        $this->characteristics = $characteristics;
    }

    public function create(ProductForm $form): Product
    {
        if (!empty($form->alias) && $this->products->hasByAlias($form->alias)) {
            throw new DomainException('Такой алиас уже есть');
        }

        $category = $this->categories->getById($form->categoryId);

        $service = Product::create(
            $category->id,
            $form->title,
            $form->price_type,
            $form->price,
            $form->description,
            $form->bottom_description,
            new Seo(
                $form->seo->title,
                $form->seo->description,
                $form->seo->keywords,
                $form->seo->h1
            )
        );

        $this->products->save($service);

        return $service;
    }

    public function edit(int $id, ProductForm $form)
    {
        $product = $this->products->getById($id);

        if (!empty($form->alias) && $this->products->hasByAliasExceptSelf($product->id, $form->alias)) {
            throw new DomainException('Такой алиас уже есть');
        }

        $product->edit(
            $form->categoryId,
            $form->price_type,
            $form->price,
            $form->title,
            $form->description,
            $form->bottom_description,
            new Seo(
                $form->seo->title,
                $form->seo->description,
                $form->seo->keywords,
                $form->seo->h1
            )
        );

        $this->products->save($product);
    }

    public function delete(int $id): void
    {
        $product = $this->products->getById($id);

        if ($product->isActive()) {
            throw new DomainException('Нельзя удалить активный товар');
        }
        $product->delete();
    }

    public function activate($id)
    {
        $product = $this->products->getById($id);
        $product->activate();
        $this->products->save($product);
    }

    public function deactivate($id)
    {
        $product = $this->products->getById($id);
        $product->deactivate();
        $this->products->save($product);
    }

    public function sortImages($id, $oldIndex, $newIndex)
    {
        $product = $this->products->getById($id);
        $product->sortImages($oldIndex, $newIndex);
        $this->products->save($product);
    }

    public function deleteImage($id, $photoId)
    {
        $product = $this->products->getById($id);
        $product->deleteImage($photoId);
        $this->products->save($product);
    }

    public function addImage($id, ImagesForm $form)
    {
        $product = $this->products->getById($id);

        foreach ($form->images as $file) {
            $product->addImage(ProductImage::create($file));
        }

        $this->products->save($product);
    }

    public function deleteValue($id, $valueId)
    {
        $product = $this->products->getById($id);
        $product->removeValue($valueId);
        $this->products->save($product);
    }

    public function setValue($id, $characteristicId, ValueForm $form)
    {
        $product = $this->products->getById($id);
        $characteristic = $this->characteristics->getById($characteristicId);

        $value = $characteristic->isDropDown()
            ? $characteristic->createValueVariant($form->value, $form->isMain)
            :  $characteristic->createValue($form->value, $form->isMain);

        $product->setValue($value);
        $this->products->save($product);
    }

}