<?php

namespace app\commands;

use yii\console\Controller;

class SwaggerController extends Controller
{
    public function actionGenerate()
    {
        $openapi = \OpenApi\scan(\Yii::getAlias('@app/modules'));
        file_put_contents(\Yii::getAlias('@app/web/docs/swagger.json'), $openapi->toJson());
    }
}