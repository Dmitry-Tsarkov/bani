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

    /**
     * @OA\Get(
     *     path="/api/portfolios",
     *     tags={"Pages"},
     *     @OA\Response(
     *      response="200",
     *      description="An example resource",
     *     )
     * )
     */
    public function actionPortfolios()
    {
        return $this->portfolioPcresentator->getPortfolios();
    }

    /**
     * @OA\Get(
     *     path="/api/portfolios/{alias}",
     *     @OA\Parameter(name="alias",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="proekty-ban"
     *      )
     *     ),
     *     tags={"Pages"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="An example resource")
     * )
     */

    public function actionPortfolio($alias)
    {
        return $this->portfolioPcresentator->getPortfolio($alias);
    }
}