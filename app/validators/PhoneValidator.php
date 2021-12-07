<?php


namespace app\validators;


use yii\validators\Validator;

class PhoneValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (empty($model->$attribute)) {
            return;
        }

        if (!Phone::isValidPhone($model->$attribute)) {
            $this->addError($model, $attribute, 'Некорректный телефон');
        }
    }
}