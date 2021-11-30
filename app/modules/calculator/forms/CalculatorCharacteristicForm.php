<?php

namespace app\modules\calculator\forms;

use app\modules\calculator\models\CalculatorCharacteristc;
use yii\base\Model;

class CalculatorCharacteristicForm extends Model
{
    public $title;
    public $type;

    public function __construct(?CalculatorCharacteristc $characteristic = null)
    {
        if (!empty($characteristic)) {
            $this->title = $characteristic->title;
            $this->type = $characteristic->type;
        }

        parent::__construct();
    }

    public function rules()
    {
        return [
            [['title', 'type'], 'required'],
            [['title'], 'string'],
            [['type'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Характеристика',
            'type'  => 'Как выводятся значения',
        ];
    }
}