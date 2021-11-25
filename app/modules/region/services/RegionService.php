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
        if (!empty($form->title_alias) && $this->regions->hasByCityAlias($form->title_alias)) {
            throw new DomainException('Такой алиас города уже есть');
        }

        if (!empty($form->district_alias) && $this->regions->hasByDistrictAlias($form->district_alias)) {
            throw new DomainException('Такой алиас региона уже есть');
        }

        $region = Region::create(
            $form->title,
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

    public function edit(int $id, RegionForm $form): void
    {
        $review = $this->regions->getById($id);

        $review->edit(
            $form->title,
            $form->district,
            $form->description,
            new Seo(
                $form->seo->title,
                $form->seo->description,
                $form->seo->keywords,
                $form->seo->h1
            )
        );

        $this->regions->save($review);
    }
}