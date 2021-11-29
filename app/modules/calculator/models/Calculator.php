<?php

namespace app\modules\calculator\models;

use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property string $title [varchar(255)]
 * @property string $description
 *
 */
class Calculator extends ActiveRecord
{
    public static function tableName()
    {
        return 'calculators';
    }

    public static function create($title, $description): self
    {
        $self = new self();

        $self->title = $title;
        $self->description = $description;

        return $self;
    }

    public function getCharacteristics()
    {
        return $this->hasMany(CalculationCharacteristc::class, ['calculator_id' => 'id']);
    }

}