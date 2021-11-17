<?php

namespace app\modules\service\services;

use app\modules\characteristic\repositories\CharacteristicRepository;
use app\modules\service\forms\ServiceImagesForm;
use app\modules\service\forms\ServiceForm;
use app\modules\service\models\Service;
use app\modules\service\models\ServiceImage;
use app\modules\service\repositories\ServiceRepository;
use app\modules\seo\valueObjects\Seo;
use app\modules\serviceCategory\repositories\ServiceCategoryRepository;
use DomainException;

class ServiceService
{
    private $services;
    private $categories;
    private $characteristics;

    public function __construct(
        ServiceRepository $services,
        ServiceCategoryRepository $categories,
        CharacteristicRepository $characteristics)
    {
        $this->services = $services;
        $this->categories = $categories;
        $this->characteristics = $characteristics;
    }

    public function create(ServiceForm $form): Service
    {
        if (!empty($form->alias) && $this->services->hasByAlias($form->alias)) {
            throw new DomainException('Такой алиас уже есть');
        }

        $category = $this->categories->getById($form->categoryId);

        $service = Service::create(
            $category->id,
            $form->title,
            $form->price_type,
            $form->price,
            $form->description,
            new Seo(
                $form->seo->title,
                $form->seo->description,
                $form->seo->keywords,
                $form->seo->h1
            )
        );

        $this->services->save($service);

        return $service;
    }

    public function edit(int $id, ServiceForm $form)
    {
        $service = $this->services->getById($id);

        if (!empty($form->alias) && $this->services->hasByAliasExceptSelf($service->id, $form->alias)) {
            throw new DomainException('Такой алиас уже есть');
        }

        $service->edit(
            $form->categoryId,
            $form->price_type,
            $form->price,
            $form->title,
            $form->description,
            new Seo(
                $form->seo->title,
                $form->seo->description,
                $form->seo->keywords,
                $form->seo->h1
            )
        );

        $this->services->save($service);
    }

    public function delete(int $id): void
    {
        $service = $this->services->getById($id);

        if ($service->isActive()) {
            throw new DomainException('Нельзя удалить активную услугу');
        }
        $service->delete();
    }

    public function activate($id)
    {
        $service = $this->services->getById($id);
        $service->activate();
        $this->services->save($service);
    }

    public function deactivate($id)
    {
        $service = $this->services->getById($id);
        $service->deactivate();
        $this->services->save($service);
    }

    public function sortImages($id, $oldIndex, $newIndex)
    {
        $service = $this->services->getById($id);
        $service->sortImages($oldIndex, $newIndex);
        $this->services->save($service);
    }

    public function deleteImage($id, $photoId)
    {
        $service = $this->services->getById($id);
        $service->deleteImage($photoId);
        $this->services->save($service);
    }

    public function addImage($id, ServiceImagesForm $form)
    {
        $service = $this->services->getById($id);

        foreach ($form->images as $file) {
            $service->addImage(ServiceImage::create($file));
        }

        $this->services->save($service);
    }
}