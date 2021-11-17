<?php

namespace app\modules\serviceCategory\services;

use app\modules\serviceCategory\forms\ServiceCategoryForm;
use app\modules\serviceCategory\models\ServiceCategory;
use app\modules\serviceCategory\repositories\ServiceCategoryRepository;
use app\modules\seo\valueObjects\Seo;
use DomainException;

class ServiceCategoryService
{
    private $categories;

    public function __construct(ServiceCategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function create(ServiceCategoryForm $createForm): ServiceCategory
    {
        $parent = $this->categories->getById($createForm->parentId);

        $category = ServiceCategory::create(
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

    public function edit(int $id, ServiceCategoryForm $editForm): void
    {
        $category = $this->categories->getById($id);
        $parent = $this->categories->getById($editForm->parentId);

        $category->edit(
            $parent->id,
            $editForm->title,
            $editForm->description,
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

        if($this->categories->hasServices($category)) {
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