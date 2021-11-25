<?php

namespace app\modules\region\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\region\presentators\RegionPresentator;

class RegionController extends ApiController
{
    private $regionPresentator;

    public function __construct($id, $module, RegionPresentator $regionPresentator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->regionPresentator = $regionPresentator;
    }

    public function actionRegions()
    {
        return $this->regionPresentator->getRegions();
    }

    public function actionRegion($alias)
    {
        return $this->regionPresentator->getRegion($alias);
    }
}