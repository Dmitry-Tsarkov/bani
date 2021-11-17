<?php

namespace app\modules\kit\models;

use app\modules\admin\traits\QueryExceptions;
use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * @property int $id [int(11)]
 * @property string $text
 *
 * @mixin PositionBehavior
 */
class Kit extends ActiveRecord
{
    use QueryExceptions;

    public function behaviors()
    {
        return [
            ['class' => PositionBehavior::class,
//            'groupAttributes' => ['product_id']
            ]
        ];
    }

    public static function tableName()
    {
        return 'kit';
    }

    public static function create($text): self
    {
        $self = new self;
        $self->text = $text;
        return $self;
    }

    public function rules()
    {
        return [
            [['text'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'text' => 'Текст',
        ];
    }
}