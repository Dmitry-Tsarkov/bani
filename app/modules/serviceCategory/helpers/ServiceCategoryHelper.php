<?php

namespace app\modules\serviceCategory\helpers;

use app\modules\serviceCategory\models\ServiceCategory;

class ServiceCategoryHelper
{
    public static function getServiceMinPrice(ServiceCategory $category):? int
    {
        $prices = [];
        foreach ($category->services as $service) {
            $prices[] = $service->price;
        }

        return !empty($prices) ? min($prices) : null;
    }
}