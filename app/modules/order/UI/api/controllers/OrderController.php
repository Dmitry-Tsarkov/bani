<?php

namespace app\modules\order\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\api\services\Validator;
use app\modules\order\forms\ProductOrderForm;
use app\modules\order\services\OrderService;
use app\modules\order\forms\ServiceOrderForm;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class OrderController extends ApiController
{
    private $service;
    private $validator;

    public function __construct($id, $module, OrderService $service, Validator $validator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->validator = $validator;
    }

    public function behaviors()
    {
        return [
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'calculation-send' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * @OA\Post(
     *     path="/api/order/send",
     *     tags={"Orders"},
     *      @OA\Parameter(
     *        name="name",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="Имя"
     *      )
     *     ),
     *     @OA\Parameter(
     *        name="phone",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="88005553535"
     *      )
     *     ),
     *     @OA\Response(response="201", description="Создано"),
     *     @OA\Response(response="422", description="Ошибка валидации"),
     *     @OA\Response(response="409", description="Конфликт"),
     * )
     */
    public function actionOrderProductSend()
    {
        $form = new ProductOrderForm();
        $form->load(Json::decode(Yii::$app->request->getRawBody()), '');
        $this->validator->validate($form);
        $this->service->orderProductSend($form);
        Yii::$app->response->statusCode = 201;
        return ['message' => 'Свяжемся с вами как можно скорее'];
    }

    /**
     * @OA\Post(
     *     path="/api/order-service/send",
     *     tags={"Orders"},
     *      @OA\Parameter(
     *        name="name",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="Имя"
     *      )
     *     ),
     *     @OA\Parameter(
     *        name="phone",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="88005553535"
     *      )
     *     ),
     *     @OA\Response(response="201", description="Создано"),
     *     @OA\Response(response="422", description="Ошибка валидации"),
     *     @OA\Response(response="409", description="Конфликт"),
     * )
     */
    public function actionOrderServiceSend()
    {
        $form = new ServiceOrderForm();
        $form->load(Json::decode(Yii::$app->request->getRawBody()), '');
        $this->validator->validate($form);
        $this->service->orderServiceSend($form);
        Yii::$app->response->statusCode = 201;
        return ['message' => 'Свяжемся с вами как можно скорее'];
    }
}