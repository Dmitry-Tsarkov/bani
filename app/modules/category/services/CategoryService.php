<?php

namespace app\modules\category\services;

use app\modules\category\forms\CategoryForm;
use app\modules\category\models\Category;
use app\modules\category\repositories\CategoryRepository;
use app\modules\seo\valueObjects\Seo;
use DomainException;

class CategoryService
{
    private $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function create(CategoryForm $createForm): Category
    {
        $parent = $this->categories->getById($createForm->parentId);

        $category = Category::create(
            $parent->id,
            $createForm->title,
            $createForm->description,
            $createForm->alias,
            $createForm->image,
            new Seo(
                $createForm->seo->title,
                $createForm->seo->description,
                $createForm->seo->keywords,
                $createForm->seo->h1
            )
        );

        $this->categories->save($category);

        return $category;
    }

    public function edit(int $id, CategoryForm $editForm): void
    {
        $category = $this->categories->getById($id);
        $parent = $this->categories->getById($editForm->parentId);

        $category->edit(
            $parent->id,
            $editForm->title,
            $editForm->description,
            $editForm->bottom_description,
            $editForm->alias,
            $editForm->image,
            new Seo(
                $editForm->seo->title,
                $editForm->seo->description,
                $editForm->seo->keywords,
                $editForm->seo->h1
            )
        );

        $this->categories->save($category);
    }

    public function delete($id): void
    {
        $category = $this->categories->getById($id);

        if($this->categories->hasProducts($category)) {
            throw new DomainException('Нельзя удалять категорию с услугами');
        }

        $this->categories->delete($category);
    }

    public function deleteImage($id)
    {
        $category = $this->categories->getById($id);
        $category->deleteImage();
        $this->categories->save($category);
    }

}