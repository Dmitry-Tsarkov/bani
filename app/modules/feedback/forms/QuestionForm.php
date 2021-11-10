<?php

namespace app\modules\feedback\forms;

use yii\base\Model;

class QuestionForm extends Model
{
    public $name;
    public $phone;
    public $description;
    public $referer;

    public function rules()
    {
        return [
            [['name'], 'required', 'message'=> 'Введите имя'],
            [['phone'], 'required', 'message'=> 'Введите телефон'],
            [['description'], 'required', 'message'=> 'Введите комментарий'],
            [['name', 'description'], 'string'],
        ];
    }
}