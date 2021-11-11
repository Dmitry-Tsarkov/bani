<?php

namespace app\modules\review\forms;

use app\modules\review\models\Review;
use himiklab\yii2\recaptcha\ReCaptchaValidator2;
use yii\base\Model;

class ReviewForm extends Model
{
    public $name;
    public $description;
    public $email;
    public $city;

    public $reCaptcha;

    public function attributeLabels()
    {
        return ([
            'name' => 'ФИО',
            'email' => 'E-mail',
            'city' => 'Город',
            'description' => 'Описание',
            'is_preview' => 'Показывть на главной',
        ]);
    }

    public function rules()
    {
        return [
            [['name', 'email'], 'required', 'message' => 'Укажите имя'],
//            [['reCaptcha'], 'required', 'message' => 'Подтвердите, что вы не робот'],
            [['description'], 'required', 'message' => 'Напишите отзыв'],
            [['name', 'email', 'city'], 'string', 'min' => 3, 'tooShort' => 'Минимум 3 символа'],
            [['description'], 'string', 'min' => 3, 'tooShort' => 'Минимум 3 символа'],
//            [['reCaptcha'], ReCaptchaValidator2::class,
//                'uncheckedMessage' => 'Подтвердите, что вы не робот', 'on' => Review::SCENARIO_DEFAULT],
        ];
    }
}