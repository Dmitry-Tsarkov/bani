<?php

namespace app\modules\calculator\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\calculator\presentators\CalculatorPresentator;

class CalculatorController extends ApiController
{
    private $presentator;

    public function __construct($id, $module, CalculatorPresentator $presentator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->presentator = $presentator;
    }

    public function actionCalculator($id)
    {
        return $this->presentator->getCalculator($id);
    }
}