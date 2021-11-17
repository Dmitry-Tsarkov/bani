<?php

namespace app\modules\service\presentator;

use app\modules\category\repositories\ServiceCategoryRepository;
use app\modules\service\models\Service;
use app\modules\service\repositories\ServiceRepository;

class ServicePresentator
{
    private $categories;
    private $services;

    public function __construct(ServiceCategoryRepository $categories, ServiceRepository $services)
    {
        $this->categories = $categories;
        $this->services = $services;
    }

    public function getServices($alias)
    {
        $category = $this->categories->getByAlias($alias);
        $services = $category->services;

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
}