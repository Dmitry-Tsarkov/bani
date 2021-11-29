<?php

namespace app\modules\calculator\models;

use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * @property int $id [int(11)]
 * @property int $calculator_id [int(11)]
 * @property string $title [varchar(255)]
 * @property int $type [int(11)]
 * @property int $position [int(11)]
 *
 */
class CalculationCharacteristc extends ActiveRecord
{
    const TYPE_DROPDOWN = 1;
    const TYPE_RADIO = 2;

    public static function tableName()
    {
        return 'calculator_characteristics';
    }

    public function behaviors()
    {
        return [
            [
                'class' => PositionBehavior::class,
                'groupAttributes' => ['calculator_id']
            ]
        ];
    }

    public static function create($calculator_id, $title, $type): self
    {
        $self = new self();
        $self->calculator_id = $calculator_id;
        $self->title = $title;
        $self->type = $type;
        return $self;
    }
}