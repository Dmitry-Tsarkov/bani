<?php

namespace app\modules\service\presentator;

use app\modules\service\models\Service;
use app\modules\service\models\ServiceImage;
use app\modules\service\repositories\ServiceRepository;
use app\modules\serviceCategory\models\ServiceCategory;
use app\modules\serviceCategory\readModels\ServiceCategoryReader;
use yii\helpers\Url;

class ServicePresentator
{
    private $services;
    private $serviceCategoryReader;

    public function __construct(ServiceCategoryReader $serviceCategoryReader, ServiceRepository $services)
    {

        $this->services = $services;
        $this->serviceCategoryReader = $serviceCategoryReader;
    }

    public function getServices($alias)
    {
        $serviceCategory = $this->serviceCategoryReader->getByAlias($alias);
        $services = $serviceCategory->services;

        return [
            'services' => array_map(function (Service $service) {
                return [
                    'meta' => $service->getMetaTags(),
                    'id' => $service->id,
                    'alias' => $service->alias,
                    'title' => $service->title,
                    'description' => $service->description,
                ];
            }, $services)
        ];
    }

    public function getServicesCatalog()
    {
        $serviceCategories = $this->serviceCategoryReader->getServiceCategories();

        return [
            'services' => array_map(function (ServiceCategory $serviceCategory) {
                return [
                    'id' => $serviceCategory->id,
                    'alias' => $serviceCategory->alias,
                    'title' => $serviceCategory->title,
                    'description' => $serviceCategory->description,
                    'image' => Url::to($serviceCategory->getImageFileUrl('image'), true),
                ];
            }, $serviceCategories)
        ];
    }

    public function getService($alias)
    {
        $service = $this->services->getByAlias($alias);

        return [
            'product' => [
                'meta' => $service->getMetaTags(),
                'id' => $service->id,
                'alias' => $service->alias,
                'title' => $service->title,
                'description' => $service->description,
                'images' => array_map(function (ServiceImage $image) {
                    return [
                        'image' => Url::to($image->getImageFileUrl('image'), true),
                    ];
                }, $service->images),
            ],
        ];
    }
}