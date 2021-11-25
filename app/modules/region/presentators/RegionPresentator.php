<?php

namespace app\modules\region\presentators;

use app\modules\region\models\Region;
use app\modules\region\repositories\RegionRepository;

class RegionPresentator
{
    private $regions;

    public function __construct(RegionRepository $regions)
    {
        $this->regions = $regions;
    }

    public function getRegions()
    {
        $regions = $this->regions->getRegions();

        return [
            'regions' => array_map(function (Region $region) {
                return [
                    'title' => $region->title,
                    'title_alias' => $region->title_alias,
                    'district' => $region->title,
                    'district_alias' => $region->district_alias
                ];
            }, $regions)
        ];
    }

    public function getRegion($alias)
    {
        $region = $this->regions->getRegionByAlias($alias);

        return [
            'region' => [
                'meta' => $region->getMetaTags(),
                'id' => $region->id,
                'city' => $region->title,
                'content' => $region->description,
            ]
        ];
    }
}