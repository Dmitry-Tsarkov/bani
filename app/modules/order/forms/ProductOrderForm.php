<?php

namespace app\modules\order\forms;

use app\validators\PhoneValidator;
use yii\base\Model;

class ProductOrderForm extends Model
{
    public $product_id;
    public $name;
    public $email;
    public $phone;
    public $comment;
    public $additional_params;
    public $type;

    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['name'], 'required', 'message'=> 'Введите имя'],
            [['email'], 'required', 'message'=> 'Введите почту'],
            [['phone'], 'required', 'message'=> 'Введите телефон'],
            [['product_id'], 'integer'],
            [['email'], 'email'],
            [['name', 'additional_params', 'comment', 'comment', 'type'], 'string'],
            ['phone', PhoneValidator::class],
        ];
    }
}