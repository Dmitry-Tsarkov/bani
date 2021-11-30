<?php

namespace app\modules\calculator\models;

use app\modules\admin\traits\QueryExceptions;
use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property string $title [varchar(255)]
 * @property string $description
 *
 */
class Calculator extends ActiveRecord
{
    use QueryExceptions;

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

    public function edit($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function getCharacteristics()
    {
        return $this->hasMany(CalculationCharacteristc::class, ['calculator_id' => 'id']);
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
        ];
    }

}