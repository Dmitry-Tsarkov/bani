<?php

namespace app\modules\service\presentator;

use app\modules\service\models\Service;
use app\modules\service\models\ServiceImage;
use app\modules\service\repositories\ServiceRepository;
use yii\helpers\Url;

class ServicePresentator
{
    private $services;

    public function __construct(ServiceRepository $services)
    {
        $this->services = $services;
    }

    public function getAllServices()
    {
        $services = $this->services->getAllServices();

        return [
            'services' => array_map(function (Service $service) {
                return [
                    'id' => $service->id,
                    'alias' => $service->alias,
                    'title' => $service->title,
                    'image' => $service->getFirstImage(),
                ];
            }, $services)
        ];
    }

    public function getService($alias)
    {
        $service = $this->services->getByAlias($alias);

        return [
            'meta' => $service->getMetaTags(),
            'product' => [
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