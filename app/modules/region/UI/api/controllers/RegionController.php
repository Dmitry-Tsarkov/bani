<?php

namespace app\modules\region\UI\api\controllers;

use app\modules\api\controllers\ApiController;

class RegionController extends ApiController
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }
}