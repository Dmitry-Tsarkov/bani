<?php

namespace app\modules\calculator\models;

use app\modules\admin\traits\QueryExceptions;
use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * @mixin PositionBehavior
 *
 * @property int $id [int(11)]
 * @property int $characteristic_id [int(11)]
 * @property int $position [int(11)]
 * @property string $value [varchar(255)]
 * @property string $price [decimal(10)]
 *
 *
 */
class CalculatorValue extends ActiveRecord
{
    use QueryExceptions;

    public static function tableName()
    {
        return 'calculator_characteristic_values';
    }

    public function behaviors()
    {
        return [
            [
                'class' => PositionBehavior::class,
                'groupAttributes' => ['characteristic_id']
            ]
        ];
    }

    public static function create($characteristic_id, $value, $price): self
    {
        $self = new self();
        $self->characteristic_id = $characteristic_id;
        $self->value = $value;
        $self->price = $price;

        return $self;
    }

    public function edit($value, $price)
    {
        $this->value = $value;
        $this->price = $price;
    }

}