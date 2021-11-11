<?php

namespace app\modules\faq\models;

use app\modules\admin\traits\QueryExceptions;
use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * @property int $id [int(11)]
 * @property string $question [varchar(255)]
 * @property string $answer
 * @property int $position [int(11)]
 * @property int $status [int(11)]
 *
 * @mixin PositionBehavior
 */
class Faq extends ActiveRecord
{
    use QueryExceptions;

    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public function behaviors()
    {
        return [
            PositionBehavior::class
        ];
    }

    public static function create($question, $answer): self
    {
        $self = new self();

        $self->question = $question;
        $self->answer = $answer;
        $self->status = self::STATUS_ACTIVE;
        return $self;
    }

    public static function tableName()
    {
        return 'faq';
    }

    public function rules()
    {
        return [
            [['question', 'answer'], 'required'],
            [['status'], 'in', 'range' => [0, 1], 'message' => 'Некорректный статус'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'question' => 'Вопрос',
            'answer'   => 'Ответ',
            'status'   => 'Статус',
        ];
    }
}