<?php

namespace app\modules\feedback\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\api\services\Validator;
use app\modules\feedback\forms\FeedbackForm;
use app\modules\feedback\services\FeedbackService;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class FeedbackController extends ApiController
{
    private $service;
    private $validator;

    public function __construct($id, $module, FeedbackService $service, Validator $validator, $config = [])
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
     *     path="/api/calculation/send",
     *     tags={"Feedbacks"},
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
    public function actionCalculationSend()
    {
        $form = new FeedbackForm();
        $form->referer = Yii::$app->request->referrer;
        $form->load(Json::decode(Yii::$app->request->getRawBody()), '');
        $this->validator->validate($form);
        $this->service->calculationSend($form);
        Yii::$app->response->statusCode = 201;
        return ['message' => 'Свяжемся с вами как можно скорее'];
    }
}