<?php

namespace app\modules\calculator\forms;

use app\modules\calculator\models\CalculatorValue;
use yii\base\Model;

class CalculatorValueForm extends Model
{
    public $value;
    public $price;

    public function __construct(?CalculatorValue $value = null)
    {
        if (!empty($value)) {
            $this->value = $value->value;
            $this->price = $value->price;
        }

        parent::__construct();
    }

    public function rules()
    {
        return [
            [['value', 'price'], 'required'],
            [['value'], 'string'],
            [['price'], 'double'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'value' => 'Знаечние',
            'price'  => 'Цена',
        ];
    }
}