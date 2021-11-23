<?php

namespace app\modules\region\services;

use app\modules\region\forms\RegionForm;
use app\modules\region\models\Region;
use app\modules\region\repositories\RegionRepository;
use app\modules\seo\valueObjects\Seo;
use DomainException;

class RegionService
{
    private $regions;

    public function __construct(RegionRepository $regions)
    {
        $this->regions = $regions;
    }

    public function create(RegionForm $form): Region
    {
        if (!empty($form->city_alias) && $this->regions->hasByCityAlias($form->city_alias)) {
            throw new DomainException('Такой алиас города уже есть');
        }

        if (!empty($form->district_alias) && $this->regions->hasByDistrictAlias($form->district_alias)) {
            throw new DomainException('Такой алиас региона уже есть');
        }

        $region = Region::create(
            $form->city,
            $form->district,
            $form->description,
            new Seo(
                $form->seo->title,
                $form->seo->description,
                $form->seo->keywords,
                $form->seo->h1
            )
        );

        $this->regions->save($region);

        return $region;
    }
}