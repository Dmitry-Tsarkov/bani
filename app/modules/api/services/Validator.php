<?php


namespace app\modules\api\services;


use yii\base\Model;

class Validator
{
    public function validate(Model $model)
    {
        if (!$model->validate()) {
            throw new ValidateException($model->getErrors());
        }
    }
}