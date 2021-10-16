<?php

namespace app\modules\review\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\api\services\Validator;
use app\modules\review\forms\ReviewForm;
use app\modules\review\presentators\ReviewPresentator;
use app\modules\review\services\ReviewService;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class ReviewController extends ApiController
{
    private $presentator;
    private $validator;
    private $service;

    public function __construct(
        $id,
        $module,
        ReviewPresentator $presentator,
        Validator $validator,
        ReviewService $service,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->presentator = $presentator;
        $this->validator = $validator;
        $this->service = $service;
    }

    public function behaviors()
    {
        return [
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'review-send' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @OA\Get(
     *     path="/api/reviews",
     *     tags={"Reviews"},
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function actionReviews()
    {
        return $this->presentator->getReviews();
    }

    /**
     * @OA\Post(
     *     path="/api/reviews/send",
     *     tags={"Reviews"},
     *     @OA\Response(response="201", description="Создано"),
     *     @OA\Response(response="422", description="Ошибка валидации"),
     *     @OA\Response(response="409", description="Конфликт"),
     * )
     */
    public function actionReviewSend()
    {
        $form = new ReviewForm();
        $form->load(Json::decode(Yii::$app->request->getRawBody()), '');
        $this->validator->validate($form);
        $this->service->reviewSend($form);
        Yii::$app->response->statusCode = 201;
        return ['message' => 'Отзыв оставлен'];
    }

}