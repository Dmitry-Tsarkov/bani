<?php

namespace app\modules\api\controllers;

use app\modules\api\services\ValidateException;
use Yii;
use yii\web\Controller;
use yii\web\Response;

abstract class ApiController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        Yii::$app->response->format = Response::FORMAT_JSON;
    }

    public $enableCsrfValidation = false;

    public function runAction($id, $params = [])
    {
        try {
            return parent::runAction($id, $params);
        } catch (ValidateException $e) {
            Yii::$app->response->statusCode = 422;
            return ['errors' => $e->getValidateErrors()];
        } catch (\DomainException $e) {
            Yii::$app->response->statusCode = 409;
            return ['message' => $e->getMessage()];
        }
    }
}