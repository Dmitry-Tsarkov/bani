<?php

namespace app\modules\kit\models;

use app\modules\admin\traits\QueryExceptions;
use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * @property int $id [int(11)]
 * @property string $title
 * @property string $hint
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

    public static function create($title, $hint, $text): self
    {
        $self = new self;
        $self->title = $title;
        $self->hint = $hint;
        $self->text = $text;
        return $self;
    }

    public function rules()
    {
        return [
            [['text', 'title'], 'required'],
            [['title', 'hint'], 'string'],
            [['text'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'hint' => 'Подсказка',
            'text' => 'Текст',
        ];
    }
}