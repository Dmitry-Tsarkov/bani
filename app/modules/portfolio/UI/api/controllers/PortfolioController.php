<?php

namespace app\modules\portfolio\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\portfolio\presentators\PortfolioPresentator;
use yii\helpers\VarDumper;

class PortfolioController extends ApiController
{
    private $portfolioPcresentator;

    public function __construct($id, $module, PortfolioPresentator $portfolioPcresentator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->portfolioPcresentator = $portfolioPcresentator;
    }

    public function actionPortfolios()
    {
        return $this->portfolioPcresentator->getPortfolios();
    }

    public function actionPortfolio($alias)
    {
        return $this->portfolioPcresentator->getPortfolio($alias);
    }
}