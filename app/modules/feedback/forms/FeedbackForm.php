<?php

namespace app\modules\feedback\forms;

use yii\base\Model;

class FeedbackForm extends Model
{
    public $name;
    public $phone;
    public $referer;

    public function rules()
    {
        return [
            [['name'], 'required', 'message'=> 'Введите имя'],
            [['phone'], 'required', 'message'=> 'Введите телефон'],
            [['name'], 'string'],
        ];
    }
}