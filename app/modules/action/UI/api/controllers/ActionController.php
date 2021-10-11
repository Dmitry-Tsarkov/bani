<?php

namespace app\modules\action\UI\api\controllers;

use app\modules\action\presentators\ActionPresentator;
use app\modules\api\controllers\ApiController;

class ActionController extends ApiController
{
    /**
     * @var ActionPresentator
     */
    private $presentator;

    public function __construct($id, $module, ActionPresentator $presentator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->presentator = $presentator;
    }

    /**
     * @OA\Get(
     *     path="/api/actions",
     *     tags={"Actions"},
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function actionActions()
    {
        return $this->presentator->getActions();
    }

    /**
     * @OA\Get(
     *     path="/api/actions/{alias}",
     *     @OA\Parameter(name="alias",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="ya-uzhe"
     *      )
     *     ),
     *     tags={"Actions"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="An example resource")
     * )
     */
    public function actionAction($alias)
    {
        return $this->presentator->getAction($alias);
    }
}